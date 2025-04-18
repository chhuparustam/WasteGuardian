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

    public function register(){

        return view('auth.register');
    }

    public function create(Request $request){

       // validate request

       $request->validate([
        'fullName'=>'required|String|min:2|max:50',
        'email' => ['required', 'email', 'unique:users,email', 'regex:/^[a-zA-Z][a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
        'password' => ['required','min:6'],
       ]);

       // creating user

       $user = User::create([
        'fullName' => $request->fullName,
        'email'=> $request->email,
        'password'=>bcrypt($request->password),
       ]);
       return redirect()->route('login')->with('success', 'Your account has been created successfully. Please login.');

       Auth::login($user);
       //return redirect()->route('login');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12' 
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Verify password
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect('/dashboard')->with('success', 'Login successful!');
            } else {
                return back()->with('failed', 'Incorrect password.');
            }
        } else {
            // User not found
            return back()->with('failed', 'Account not found. Please register first.');
        }
    }
}
