<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function login_form()
    {
        return view('login');
    }

    public function login_post(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // return redirect()->intended('sql.dashboard');
            return redirect()->route('sql.dashboard')->with('msg', "Login successful!");
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function signup_form()
    {
        return view('signup');
    }

    public function signup_post(Request $request)
    {
        // Validate the data
        $credentials = $request->validate([
            'email' => ['bail', 'required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:6']
        ]);

        // Hash password, Create new user
        User::create([
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password'])
        ]);

        // Redirect to login and show success message
        return redirect()->route('sqllogin.get')->with('msg', "Signup successful!");
    }

    public function sqlLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('sqllogin.get')->with('msg', "Logout successful!");
    }
}
