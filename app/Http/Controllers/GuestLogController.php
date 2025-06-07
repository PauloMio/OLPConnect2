<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuestLog;


class GuestLogController extends Controller
{
    public function showForm()
    {
        return view('guest.login'); // Blade file for guest login
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school' => 'nullable|string|max:255',
            'id_num' => 'nullable|string|max:255',
            'course' => 'nullable|string|max:255',
            'purpose' => 'required|string|max:255',
        ]);

        GuestLog::create($validated);

        // Redirect to ebook view for guests
        return redirect()->route('guest.ebooks');
    }

    public function viewEbooks()
    {
        $ebooks = \App\Models\Ebook::all(); // Adjust if you're using a different model name
        return view('guest.view_ebooks', compact('ebooks'));
    }

    public function showEbook($id)
    {
        $ebook = \App\Models\Ebook::findOrFail($id); // Adjust the model name if needed
        return view('guest.open_ebook', compact('ebook'));
    }
}
