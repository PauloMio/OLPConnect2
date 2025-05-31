<?php

namespace App\Http\Controllers;

use App\Models\EbookLocation;
use Illuminate\Http\Request;

class EbookLocationController extends Controller
{
    public function index()
    {
        $locations = EbookLocation::all();
        return view('admin.location_index', compact('locations'));
    }

    public function create()
    {
        return view('admin.location_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
        ]);

        EbookLocation::create([
            'location' => $request->location,
        ]);

        return redirect()->route('admin.ebook_locations.index')->with('success', 'Location added successfully.');
    }

    public function destroy($id)
    {
        $location = EbookLocation::findOrFail($id);
        $location->delete();

        return redirect()->route('admin.ebook_locations.index')->with('success', 'Location deleted successfully.');
    }

}
