<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Research;

class ResearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Research::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search by title or author
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        $researches = $query->latest()->paginate(10);

        return view('admin.research.index', [
            'researches' => $researches,
            'selectedCategory' => $request->category,
            'searchTerm' => $request->search,
        ]);
    }


    public function store(Request $request)
    {
        Research::create($request->all());
        return redirect()->back()->with('success', 'Research added.');
    }

    public function update(Request $request, Research $research)
    {
        $research->update($request->all());
        return redirect()->back()->with('success', 'Research updated.');
    }

    public function destroy(Research $research)
    {
        $research->delete();
        return redirect()->back()->with('success', 'Research deleted.');
    }
}
