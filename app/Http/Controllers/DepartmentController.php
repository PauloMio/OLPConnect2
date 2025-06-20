<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::all();
        return view('admin.department_index', compact('department'));
    }

    public function create()
    {
        return view('admin.department_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required|string|max:255',
        ]);

        Department::create([
            'department' => $request->department,
        ]);

        return redirect()->route('admin.department.index')->with('success','Department added successfully.');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('admin.department.index')->with('success','Department deleted successfully.');

    }
}
