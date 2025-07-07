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

        $pdfPath = null;
        $coverPath = null;

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('ebooks', 'public');
        }

        if ($request->hasFile('coverage')) {
            $coverPath = $request->file('coverage')->store('coverage', 'public');
        }

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


        return redirect()->route('admin.ebook.list')->with('success', 'eBook updated successfully!');
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
        // Gather the data same as dashboard or reuse logic as needed
        $overallCount = Ebook::count();

        $addedYearCounts = Ebook::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('count', 'year');

        $updatedYearCounts = Ebook::selectRaw('YEAR(updated_at) as year, COUNT(*) as count')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('count', 'year');

        $categoryCounts = Ebook::select('category')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->pluck('count', 'category');

        $locationCounts = Ebook::select('location')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('location')
            ->orderBy('location')
            ->pluck('count', 'location');

        $data = compact('overallCount', 'addedYearCounts', 'updatedYearCounts', 'categoryCounts', 'locationCounts');

        // Load a Blade view for PDF output, pass $data
        $pdf = PDF::loadView('admin.ebookOverviewPdf', $data);

        // Return the generated PDF for download
        return $pdf->download('ebook-overview.pdf');
    }

    


    
}