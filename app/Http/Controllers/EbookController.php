<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:100',
            'coverage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'pdf' => 'nullable|file|mimes:pdf|max:51200',
            'status' => 'nullable|in:active,inactive',
            'category' => 'nullable|in:Filipiniana,Fiction,General Reference,Encyclopedia,Senior High School,Undergraduate,Graduate School',
            'edition' => 'nullable|string|max:50',
            'publisher' => 'nullable|string|max:100',
            'copyrightyear' => 'nullable|integer',
            'location' => 'nullable|string|max:100',
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
            'status' => $request->status,
            'category' => $request->category,
            'edition' => $request->edition,
            'publisher' => $request->publisher,
            'copyrightyear' => $request->copyrightyear,
            'location' => $request->location,
        ]);

        return redirect()->route('admin.ebook.list')->with('success', 'eBook updated successfully!');
    }

    public function index()
    {
        $ebooks = Ebook::all(); // get all ebooks
        return view('admin.eBookTable', compact('ebooks'));
    }

    
    public function edit($id)
    {
        $ebook = Ebook::findOrFail($id);
        return view('admin.edit', compact('ebook'));
    }

    public function update(Request $request, $id)
    {
        $ebook = Ebook::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:100',
            'coverage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'pdf' => 'nullable|file|mimes:pdf|max:51200',
            'status' => 'nullable|in:active,inactive',
            'category' => 'nullable|in:Filipiniana,Fiction,General Reference,Encyclopedia,Senior High School,Undergraduate,Graduate School',
            'edition' => 'nullable|string|max:50',
            'publisher' => 'nullable|string|max:100',
            'copyrightyear' => 'nullable|integer',
            'location' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('pdf')) {
            // Delete old PDF if exists
            if ($ebook->pdf) {
                Storage::disk('public')->delete($ebook->pdf);
            }
            $ebook->pdf = $request->file('pdf')->store('ebooks', 'public');
        }

        if ($request->hasFile('coverage')) {
            // Delete old coverage if exists
            if ($ebook->coverage) {
                Storage::disk('public')->delete($ebook->coverage);
            }
            $ebook->coverage = $request->file('coverage')->store('coverage', 'public');
        }

        // Update the other fields
        $ebook->update([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'status' => $request->status,
            'category' => $request->category,
            'edition' => $request->edition,
            'publisher' => $request->publisher,
            'copyrightyear' => $request->copyrightyear,
            'location' => $request->location,
        ]);

        return redirect()->route('admin.ebook.list')->with('success', 'eBook updated successfully!');
    }

    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);

        // Delete associated files from the storage
        if ($ebook->pdf) {
            Storage::delete('public/' . $ebook->pdf);
        }

        if ($ebook->coverage) {
            Storage::delete('public/' . $ebook->coverage);
        }

        // Delete the ebook record
        $ebook->delete();

        return redirect()->route('admin.ebook.list')->with('success', 'eBook deleted successfully!');
    }



}