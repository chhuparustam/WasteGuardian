<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Complaint;
use App\Models\PickupRequest;
use App\Models\Activity;


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
            Auth::login($user);
            
            // Store user data in session
            // session([
            //     'user_logged_in' => true,
            //     'user_id' => $user->id,
            //     'user_name' => $user->fullName
            // ]);

            return redirect()->route('user.dashboard');
        }

        return back()->with('failed', 'Invalid email or password.');
    }

    // Display edit profile form
public function editProfile()
{
    $user = User::find(Auth::id());
    return view('user.edit-profile', compact('user'));
}

public function updateProfile(Request $request)
{
   
    $request->validate([
        'fullName' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . Auth::id(),
        'address' => 'required|string',
    ]);

    $user = User::find(Auth::id());

    if ($user) {
        $user->fullName = $request->fullName;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->save();

        session(['user_name' => $user->fullName]); // update session
        return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully.');
    }

    return redirect()->back()->with('error', 'User not found.');
}

public function profile()
{
    $userId = AUth::id();
    $data['user'] = \App\Models\User::find($userId);
    $data['totalRequests'] = PickupRequest::where('user_id', Auth::id())->count(); 
       $data['pendingRequests'] = PickupRequest::where('user_id', Auth::id())->where('status','pending')->count(); 
       $data['completedRequests'] = PickupRequest::where('user_id', Auth::id())->where('status','complete')->count(); 

    return view('user.profile', $data);
}

public function logout()
{
    Auth::logout();
    session()->flush(); // Clear all session data
    return redirect()->route('login')->with('success', 'Logged out successfully');
}
}