<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use Illuminate\Support\Facades\Hash;

class WorkerAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('worker.register');
    }

    public function register(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:workers',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'specialization' => 'required|string|max:100',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Store the profile picture
            $imagePath = $request->file('profile_picture')->store('profile-pictures', 'public');

            // Create the worker
            Worker::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'specialization' => $request->specialization,
                'photo' => $imagePath, // Ensure the 'photo' column exists in the workers table
                'password' => Hash::make($request->password),
            ]);

            // Redirect to the login page with a success message
            return redirect()->route('worker.login')->with('success', 'Registration successful! Please login.');
        } catch (\Exception $e) {
            // Log the error and redirect back with a failure message
            \Log::error('Worker Registration Error: ' . $e->getMessage());
            return back()->with('failed', 'Registration failed! Please try again.');
        }
    }

    public function showLoginForm()
    {
        return view('worker.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $worker = Worker::where('email', $request->email)->first();

        if ($worker && Hash::check($request->password, $worker->password)) {
            session([
                'worker_logged_in' => true,
                'worker_id' => $worker->id,
                'worker_name' => $worker->name
            ]);
            return redirect()->route('worker.dashboard');
        }

        return back()->with('failed', 'Invalid credentials');
    }

    public function showResetForm()
    {
        return view('worker.passwords.reset');
    }


    
    // update the worker profile
    public function editProfile()
    {
       $worker = Worker::find(session('worker_id'));
        return view('worker.edit-profile', compact('worker'));
    }

    public function updateProfile(Request $request)
    {
        $worker = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $filename = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('uploads/profile_pictures'), $filename);
            $worker->profile_picture = 'uploads/profile_pictures/' . $filename;
        }

        $worker->name = $request->name;
        $worker->email = $request->email;
        $worker->phone = $request->phone;
        $worker->save();

        return redirect()->route('worker.edit-profile')->with('success', 'Profile updated successfully!');
    }
}