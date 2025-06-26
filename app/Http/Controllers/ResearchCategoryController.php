<?php

namespace App\Http\Controllers;

use App\Models\ResearchCategory;
use Illuminate\Http\Request;

class ResearchCategoryController extends Controller
{
    public function index() 
    {
        $categories = ResearchCategory::all();
        return view('admin.researchCategory_index', compact('categories'));
    }

    public function create()
    {
        return view('admin.researchCategory_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        ResearchCategory::create([
            'category' => $request->category,
        ]);

        return redirect()->route('admin.research-category.index')->with('success', 'Category added successfully.');
    }

    public function destroy($id)
    {
        $location = ResearchCategory::findOrFail($id);
        $location->delete();

        return redirect()->route('admin.research-category.index')->with('success', 'Category deleted successfully.');
    }

}
