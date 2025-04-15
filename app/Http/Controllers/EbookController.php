<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;

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

        return redirect()->back()->with('success', 'eBook uploaded successfully!');
    }

    public function edit()
    {
        $ebooks = Ebook::all(); 
        return view('admin.edit', compact('ebooks')); 
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
            $pdfPath = $request->file('pdf')->store('ebooks', 'public');
            $ebook->pdf = $pdfPath;
        }

        if ($request->hasFile('coverage')) {
            $coverPath = $request->file('coverage')->store('coverage', 'public');
            $ebook->coverage = $coverPath;
        }

        $ebook->update($request->only([
            'title', 'description', 'author', 'status', 'category', 'edition', 'publisher', 'copyrightyear', 'location'
        ]));

        return redirect()->route('admin.edit')->with('success', 'eBook updated successfully!');
    }


}