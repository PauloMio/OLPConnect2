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

            // ✅ Set status to active
            $account->update([
                'status' => 'active',
                'loggedin' => now()
            ]);

            return redirect()->route('user.ebooks')->with('success', 'Logged in successfully!');
        } else {
            return back()->withErrors(['login' => 'Invalid School ID or Birthdate.']);
        }
    }


    public function logout(Request $request)
    {
        $accountId = session('account_id');
    
        if ($accountId) {
            $account = Account::find($accountId);
    
            if ($account) {
                $account->update([
                    'status' => 'inactive',
                    'loggedout' => now()
                ]);
            }
        }
    
        $request->session()->forget('account_id');
        $request->session()->flush();
    
        return redirect()->route('account.showLogin')->with('success', 'Logged out successfully.');
    }
    
}
