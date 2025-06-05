<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
     public function index()
    {
        $announcements = Announcement::all();
        return view('admin.announcementSetup', compact('announcements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $path = $request->file('image')->store('announcements', 'public');

        Announcement::create(['image_path' => $path]);

        return redirect()->back()->with('success', 'Image uploaded successfully!');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        Storage::disk('public')->delete($announcement->image_path);
        $announcement->delete();

        return redirect()->back()->with('success', 'Image deleted successfully!');
    }
}
