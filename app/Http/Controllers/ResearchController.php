<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Research;
use App\Models\Department;
use App\Models\ResearchCategory;
use App\Models\ProgramUser;
use App\Models\Account;

class ResearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Research::query();

        // Filter by selected category
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
        $departments = Department::all();
        $categories = ResearchCategory::all();
        $programs = ProgramUser::all();

        return view('admin.research.index', [
            'researches' => $researches,
            'departments' => $departments,
            'categories' => $categories,
            'programs' => $programs,
            'selectedCategory' => $request->category,
            'searchTerm' => $request->search,
        ]);
    }

    public function create()
    {
        $departments = Department::all();
        $categories = ResearchCategory::all();
        $programs = ProgramUser::all();

        return view('admin.research.create', [
            'departments' => $departments,
            'categories' => $categories,
            'programs' => $programs,
        ]);
    }

    public function store(Request $request)
    {
        Research::create($request->all());
        return redirect()->back()->with('success', 'Research added.');
    }

    public function edit($id)
    {
        $research = Research::findOrFail($id);
        $departments = Department::all();
        $categories = ResearchCategory::all();
        $programs = ProgramUser::all();

        return view('admin.research.edit', [
            'research' => $research,
            'departments' => $departments,
            'categories' => $categories,
            'programs' => $programs,
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

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        $researches = $query->latest()->paginate(10);
        $categories = ResearchCategory::all();

        // ✅ Load account (Assuming you're using session to store the user ID)
        $account = null;
        if (session()->has('account_id')) {
            $account = Account::find(session('account_id'));
        }

        return view('user.research_table', [
            'researches' => $researches,
            'categories' => $categories,
            'selectedCategory' => $request->category,
            'searchTerm' => $request->search,
            'account' => $account, // ✅ Pass the account to the view
        ]);
    }


    public function guestView(Request $request)
    {
        $query = Research::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        $researches = $query->latest()->paginate(10);
        $categories = ResearchCategory::all(); // ✅ Add this

        return view('guest.research_table', [
            'researches' => $researches,
            'categories' => $categories, // ✅ Pass to the view
            'selectedCategory' => $request->category,
            'searchTerm' => $request->search,
        ]);
    }

}
