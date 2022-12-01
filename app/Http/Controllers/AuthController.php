<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function sqllogin_form()
    {
        return view('login');
    }

    public function sqllogin_post(Request $request)
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

    public function sqlsignup_form()
    {
        return view('signup');
    }

    public function sqlsignup_post(Request $request)
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

    //
    public function login_form()
    {
        return view('node.login');
    }

    public function login_post(Request $request)
    {
        // Validate incoming form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Consume login endpoint
        $response = Http::post('https://todo-api-assessment-production.up.railway.app/login', [
            "email" => $request->email,
            "password" => $request->password,
        ]);

        if($response->failed()){
            // Return back with error
            return back()->withErrors([
                'email' => $response['message']
            ]);
        }

        // Create a session
        session(['token' => $response['token'], 'user' => $response['user']]);

        // Get all the tasks
        $data = Http::withToken($response['token'])->get('https://todo-api-assessment-production.up.railway.app/todo');
        $todos = $data['todos'];

        // Redirect to dashboard
        // return redirect()->route('dashboard');
        return view('layouts.main', compact('todos'));
    }

    public function signup_form()
    {
        return view('node.signup');
    }

    public function signup_post(Request $request)
    {
        // Validate incoming form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        // Consume login endpoint
        $response = Http::post('https://todo-api-assessment-production.up.railway.app/register', [
            "email" => $request->email,
            "password" => $request->password,
        ]);

        if($response->failed()){
            // Return back with error
            return back()->withErrors([
                'email' => $response['error']
            ]);
        }

        // Redirect to login and show success message
        return redirect()->route('login.get')->with('msg', "Signup successful!");
    }

    public function logout(Request $request)
    {
        // Delete Session
        $request->session()->flush();

        return redirect()->route('login.get');
    }

}
