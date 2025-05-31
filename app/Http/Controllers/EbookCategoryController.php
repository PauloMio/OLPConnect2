<?php

namespace App\Http\Controllers;

use App\Models\EbookCategory;
use Illuminate\Http\Request;

class EbookCategoryController extends Controller
{
    public function index()
    {
        $categories = EbookCategory::all();
        return view('admin.category_index', compact('categories'));
    }


    public function create()
    {
        return view('admin.category_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        EbookCategory::create([
            'category' => $request->category,
        ]);

        return redirect()->route('admin.ebook_categories.index')->with('success', 'Category added successfully.');
    }

    public function destroy($id)
    {
        $category = EbookCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.ebook_categories.index')->with('success', 'Category deleted successfully.');
    }

    
}
