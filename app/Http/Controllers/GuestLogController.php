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

    public function viewEbooks(Request $request)
    {
        $query = \App\Models\Ebook::query();

        // Filter by search (title or author)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                ->orWhere('author', 'like', "%$search%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // You can also add pagination here if needed
        $ebooks = $query->get();

        return view('guest.view_ebooks', compact('ebooks'));
    }


    public function showEbook($id)
    {
        $ebook = \App\Models\Ebook::findOrFail($id); // Adjust the model name if needed
        return view('guest.open_ebook', compact('ebook'));
    }

    public function viewGuestLogs()
    {
        $guestLogs = \App\Models\GuestLog::latest()->get();
        return view('admin.view_guestlogs', compact('guestLogs'));
    }

}
