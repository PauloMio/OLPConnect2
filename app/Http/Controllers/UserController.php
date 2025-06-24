<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    // Show login page
    public function showLogin()
    {
        return view('admin.adminLogIn');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->update(['status' => 'active']);
            return redirect()->route('admin.dashboard');
        }
        

        return back()->withErrors(['email' => 'Invalid login credentials']);
    }


    // Show registration page
    public function showRegister()
    {
        return view('admin.adminRegister');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'active',
        ]);

        return redirect()->route('admin.accounts')->with('success', 'Registration successful. Please log in.');
    }

    // Show crud page
    public function showCrud()
    {
        return view('admin.edit');
    }

    // Log out
    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $user->update(['status' => 'inactive']);
        }

        Auth::logout();
        return redirect()->route('login');
    }

    



    // Show all admin accounts
    public function indexAdmins(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            });
        }

        $users = $query->get();

        return view('admin.AdminAcct', compact('users'));
    }


    // Show edit form for a specific admin
    public function editAdmin($id)
    {
        $user = User::findOrFail($id);
        return view('admin.editAcct', compact('user'));
    }

    // Update admin
    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.accounts')->with('success', 'Account updated successfully.');
    }

    // Delete admin
    public function deleteAdmin($id)
    {
        User::destroy($id);
        return redirect()->route('admin.accounts')->with('success', 'Account deleted.');
    }


}
