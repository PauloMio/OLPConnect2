<?php

namespace App\Http\Controllers;

use App\Models\ProgramUser;
use Illuminate\Http\Request;

class ProgramUserController extends Controller
{
    public function index() 
    {
        $programs = ProgramUser::all();
        return view('admin.program_index', compact('programs'));
    }

    public function create()
    {
        return view('admin.program_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'program' => 'required|string|max:255',
        ]);

        ProgramUser::create([
            'program' => $request->program,
        ]);

        return redirect()->route('admin.program_user.index')->with('success', 'Program added successfully.');
    }

    public function destroy($id)
    {
        $location = ProgramUser::findOrFail($id);
        $location->delete();

        return redirect()->route('admin.program_user.index')->with('success', 'Program deleted successfully.');
    }
}
