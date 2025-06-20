<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Research;
use App\Models\Department;
use App\Models\Account;

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
        $departments = \App\Models\Department::all(); // ← Add this

        return view('admin.research.index', [
            'researches' => $researches,
            'departments' => $departments, // ← Pass it to the view
            'selectedCategory' => $request->category,
            'searchTerm' => $request->search,
        ]);
    }


    public function create()
    {
        $departments = Department::all(); // or orderBy('department')->get()

        return view('admin.research.index', [ // or whatever view
            'departments' => $departments,
        ]);
    }

    public function store(Request $request)
    {
        Research::create($request->all());
       return redirect()->back()->with('success', 'Research added.');

    }

    public function edit()
    {
        $departments = Department::all(); // or orderBy('department')->get()

        return view('admin.research.index', [ // or whatever view
            'departments' => $departments,
        ]);
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

    public function userView(Request $request)
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

        return view('user.research_table', [
            'researches' => $researches,
            'selectedCategory' => $request->category,
            'searchTerm' => $request->search,
        ]);
    }

    public function guestView(Request $request)
    {
        $query = Research::query();

        // Filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        $researches = $query->latest()->paginate(10);

        return view('guest.research_table', [
            'researches' => $researches,
        ]);
    }


}
