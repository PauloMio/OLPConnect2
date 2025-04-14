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
}