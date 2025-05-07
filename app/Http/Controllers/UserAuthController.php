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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Store user data in session
            session([
                'user_logged_in' => true,
                'user_id' => $user->id,
                'user_name' => $user->fullName
            ]);

            return redirect()->route('user.dashboard');
        }

        return back()->with('failed', 'Invalid email or password.');
    }
}
