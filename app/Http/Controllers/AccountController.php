<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function showLoginForm()
    {
        return view('user.logIn'); // your login.blade.php or whatever you named it
    }

    public function login(Request $request)
    {
        $request->validate([
            'schoolid' => 'required|string',
            'birthdate' => 'required|date',
        ]);

        $account = Account::where('schoolid', $request->schoolid)
                          ->where('birthdate', $request->birthdate)
                          ->first();

        if ($account) {
            session(['account_id' => $account->id]);

            // Redirect to user ebooks page after login
            return redirect()->route('user.ebooks')->with('success', 'Logged in successfully!');
        } else {
            return back()->withErrors(['login' => 'Invalid School ID or Birthdate.']);
        }
    }
}
