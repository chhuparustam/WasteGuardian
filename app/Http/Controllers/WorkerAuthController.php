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
            $imagePath = $request->file('profile_picture')->store('profile-pictures', 'public');

            Worker::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'specialization' => $request->specialization,
                'profile_picture' => $imagePath,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('worker.login')
                           ->with('success', 'Registration successful! Please login.');
        } catch (\Exception $e) {
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
}