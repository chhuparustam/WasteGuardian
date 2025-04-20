<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function create(Request $request)
    {
        // Validate request
        $request->validate([
            'fullName' => 'required|string|min:2|max:50',
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[a-zA-Z][a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'address' => 'required|string|min:5',
            'password' => 'required|min:6|confirmed',
        ]);
    
        // Create user
        $user = User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'address' => $request->address,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully. Please login.');
    
    }

    public function checkLogin(Request $request)
    {
        // Validate login input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Login successful
            Auth::login($user);
            return redirect('/dashboard')->with('success', 'Login successful!');
        } else {
            // Login failed
            return back()->with('failed', 'Invalid email or password.');
        }
    }
}
