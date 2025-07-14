<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Models\EbookCategory;
use App\Models\EbookLocation;
use App\Models\Research;
use App\Models\GuestLog;



class EbookController extends Controller
{
    public function create()
    {
        return view('admin.eBookTable');
    }

public function store(Request $request)
{
    $validLocations = EbookLocation::pluck('location')->toArray();

    $request->validate([
        'title' => 'nullable|string|max:200',
        'description' => 'nullable|string',
        'author' => 'nullable|string|max:100',
        'coverage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048000',
        // No direct validation for 'pdf' if chunked
        'pdf_chunked_filename' => 'nullable|string',
        'category' => 'nullable|string|max:100',
        'edition' => 'nullable|string|max:50',
        'publisher' => 'nullable|string|max:100',
        'copyrightyear' => 'nullable|integer',
        'location' => 'nullable|string|max:100',
        'class' => 'nullable|string|max:255',
        'subject' => 'nullable|string|max:255',
        'doi' => 'nullable|string|max:255',
    ]);

    $pdfPath = null;
    $coverPath = null;

    // ✅ 1. Handle PDF if uploaded via chunked upload
    if ($request->filled('pdf_chunked_filename')) {
        $filename = $request->input('pdf_chunked_filename');
        $sourcePath = storage_path("app/public/ebooks/{$filename}"); // Final assembled path
        $destinationPath = "ebooks/{$filename}";

        if (file_exists($sourcePath)) {
            // Store path as relative for DB
            $pdfPath = $destinationPath;
        }
    }

    // ✅ 2. Handle normal (non-chunked) upload as fallback
    elseif ($request->hasFile('pdf')) {
        $pdfPath = $request->file('pdf')->store('ebooks', 'public');
    }

    // ✅ 3. Handle coverage image
    if ($request->hasFile('coverage')) {
        $coverPath = $request->file('coverage')->store('coverage', 'public');
    }

    // ✅ 4. Save eBook
    Ebook::create([
        'title' => $request->title,
        'description' => $request->description,
        'author' => $request->author,
        'coverage' => $coverPath,
        'pdf' => $pdfPath,
        'category' => $request->category,
        'edition' => $request->edition,
        'publisher' => $request->publisher,
        'copyrightyear' => $request->copyrightyear,
        'location' => $request->location,
        'class' => $request->class,
        'subject' => $request->subject,
        'doi' => $request->doi,
    ]);

    return redirect()->route('admin.ebook.list')->with('success', 'eBook uploaded successfully!');
}



    public function index(Request $request)
    {
        $categories = EbookCategory::all();
        $locations = EbookLocation::all();

        $query = Ebook::query();

        if ($request->filled('search')) {
            // $query->where('title', 'like', '%' . $request->search . '%');
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                ->orWhere('author', 'like', "%$search%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sorting
        $sortOrder = $request->input('sortOrder', 'desc');
        $query->orderBy('created_at', $sortOrder);


        $ebooks = $query->get();
        $user = Auth::user();

        return view('admin.eBookTable', compact('ebooks', 'user', 'categories', 'locations'));
    }




    
    public function edit($id)
    {
        $ebook = Ebook::findOrFail($id);
        $categories = EbookCategory::all();
        $locations = EbookLocation::all();

        return view('admin.edit', compact('ebook', 'categories', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $ebook = Ebook::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:100',
            'coverage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'pdf' => 'nullable|file|mimes:pdf|max:2048000',
            'category' => 'nullable|string|max:100',
            'edition' => 'nullable|string|max:50',
            'publisher' => 'nullable|string|max:100',
            'copyrightyear' => 'nullable|integer',
            'location' => 'nullable|string|max:100',
            'class' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'doi' => 'nullable|string|max:255',

        ]);

        // Handle file updates
        if ($request->hasFile('pdf')) {
            if ($ebook->pdf) {
                Storage::disk('public')->delete($ebook->pdf);
            }
            $ebook->pdf = $request->file('pdf')->store('ebooks', 'public');
        }

        if ($request->hasFile('coverage')) {
            if ($ebook->coverage) {
                Storage::disk('public')->delete($ebook->coverage);
            }
            $ebook->coverage = $request->file('coverage')->store('coverage', 'public');
        }

        // Fill all other fields
        $ebook->fill([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'category' => $request->category,
            'edition' => $request->edition,
            'publisher' => $request->publisher,
            'copyrightyear' => $request->copyrightyear,
            'location' => $request->location,
            'class' => $request->class,
            'subject' => $request->subject,
            'doi' => $request->doi,
        ]);

        $ebook->save();

        return redirect()->route('admin.ebook.list')->with('success', 'eBook updated successfully!');
    }


    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);

        // Delete associated files from the storage
        if ($ebook->pdf) {
            Storage::disk('public')->delete($ebook->pdf);
        }

        if ($ebook->coverage) {
            Storage::disk('public')->delete($ebook->coverage);
        }

        // Delete the ebook record
        $ebook->delete();

        return redirect()->route('admin.ebook.list')->with('success', 'eBook deleted successfully!');
    }

    public function handleChunkUpload(Request $request)
    {
        $chunk = $request->file('chunk');
        $fileName = $request->input('file_name');
        $chunkIndex = $request->input('chunk_index');
        $totalChunks = $request->input('total_chunks');

        $tempDir = storage_path('app/chunks/' . $fileName);

        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $chunk->move($tempDir, 'chunk_' . $chunkIndex);

        // If last chunk received
        if ((int)$chunkIndex + 1 == (int)$totalChunks) {
            $finalPath = storage_path('app/public/ebooks/' . $fileName);
            $output = fopen($finalPath, 'w');

            for ($i = 0; $i < $totalChunks; $i++) {
                $chunkPath = $tempDir . '/chunk_' . $i;
                $data = file_get_contents($chunkPath);
                fwrite($output, $data);
                unlink($chunkPath);
            }

            fclose($output);
            rmdir($tempDir);
        }

        return response()->json(['status' => 'chunk received']);
    }




    // User side functions for viewing books----------------------------------------------------------------------------------------------------------

    public function userView(Request $request)
    {
        // Load account with favorites if session has account_id
        $account = session()->has('account_id') 
            ? Account::with('favorites')->find(session('account_id')) 
            : null;

        $query = Ebook::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                ->orWhere('author', 'like', "%$search%");
            });
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $ebooks = $query->get();

        return view('user.viewEbook', compact('ebooks', 'account'));
    }


    public function show($id)
    {
        $ebook = Ebook::findOrFail($id);

        return view('user.showEbook', compact('ebook'));
    }

    public function toggleFavorite($id)
    {
        if (!session()->has('account_id')) {
            return redirect()->route('account.showLogin')->with('error', 'You must be logged in to favorite.');
        }

        $account = Account::find(session('account_id'));
        $ebook = Ebook::findOrFail($id);

        if ($account->favorites()->where('ebook_id', $id)->exists()) {
            $account->favorites()->detach($id);
            return back()->with('success', 'Removed from favorites.');
        } else {
            $account->favorites()->attach($id);
            return back()->with('success', 'Added to favorites.');
        }
    }

    public function viewFavorites()
    {
        if (!session()->has('account_id')) {
            return redirect()->route('account.showLogin')->with('error', 'You must be logged in to view favorites.');
        }

        $account = Account::find(session('account_id'));
        $favorites = $account->favorites()->get();

        return view('user.favorites', compact('favorites', 'account'));
    }
    

// Dashboard------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function dashboard(Request $request)
    {
        // Validate input dates or set defaults
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date') ? $request->input('start_date') . ' 00:00:00' : null;
        $endDate = $request->input('end_date') ? $request->input('end_date') . ' 23:59:59' : null;

        // Base queries
        $ebookQuery = \App\Models\Ebook::query();
        $accountQuery = \App\Models\Account::query();
        $guestlogQuery = \App\Models\GuestLog::query();
        $researchQuery = \App\Models\Research::query();

        if ($startDate && $endDate) {
            $ebookQuery->whereBetween('created_at', [$startDate, $endDate]);
            $accountQuery->whereBetween('created_at', [$startDate, $endDate]);
            $guestlogQuery->whereBetween('created_at', [$startDate, $endDate]);
            $researchQuery->whereBetween('created_at', [$startDate, $endDate]); // ✅ Filter Research too
        }

        // Counts
        $overallCount = $ebookQuery->count();
        $usersCount = $accountQuery->count();
        $guestsCount = $guestlogQuery->count();

        // Category counts (filtered)
        $categoryCounts = $ebookQuery->select('category')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->pluck('count', 'category')->toArray();

        // Location counts (unfiltered — all-time)
        $locationCounts = \App\Models\Ebook::select('location')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('location')
            ->orderBy('location')
            ->pluck('count', 'location')->toArray();

        // Department counts (now filtered ✅)
        $departmentCounts = $researchQuery->select('Department')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('Department')
            ->orderBy('Department')
            ->pluck('count', 'Department')
            ->toArray();

        $researchCategoryCounts = $researchQuery->select('category')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->pluck('count', 'category')
            ->toArray();


        return view('admin.eBookOverview', compact(
            'startDate', 'endDate',
            'overallCount', 'usersCount', 'guestsCount',
            'categoryCounts', 'locationCounts',
            'departmentCounts', 'researchCategoryCounts'
        ));
    }




    public function downloadPdf(Request $request)
    {
        // Validate date inputs
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date') ? $request->input('start_date') . ' 00:00:00' : null;
        $endDate = $request->input('end_date') ? $request->input('end_date') . ' 23:59:59' : null;

        $ebookQuery = Ebook::query();
        $accountQuery = Account::query();
        $guestlogQuery = GuestLog::query();
        $researchQuery = Research::query();

        if ($startDate && $endDate) {
            $ebookQuery->whereBetween('created_at', [$startDate, $endDate]);
            $accountQuery->whereBetween('created_at', [$startDate, $endDate]);
            $guestlogQuery->whereBetween('created_at', [$startDate, $endDate]);
            $researchQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $overallCount = $ebookQuery->count();
        $usersCount = $accountQuery->count();
        $guestsCount = $guestlogQuery->count();

        $categoryCounts = $ebookQuery->select('category')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->pluck('count', 'category')->toArray();

        $locationCounts = Ebook::select('location')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('location')
            ->orderBy('location')
            ->pluck('count', 'location')->toArray();

        $departmentCounts = $researchQuery->select('Department')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('Department')
            ->orderBy('Department')
            ->pluck('count', 'Department')->toArray();

        $researchCategoryCounts = $researchQuery->select('category')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->pluck('count', 'category')->toArray();

        $data = compact(
            'startDate', 'endDate',
            'overallCount', 'usersCount', 'guestsCount',
            'categoryCounts', 'locationCounts',
            'departmentCounts', 'researchCategoryCounts'
        );

        $pdf = PDF::loadView('admin.ebookOverviewPdf', $data);
        return $pdf->download('ebook-overview.pdf');
    }


    


    
}