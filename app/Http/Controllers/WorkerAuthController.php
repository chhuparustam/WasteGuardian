<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\AuthenticatesUsers;
use App\Http\Traits\HandlesFileUploads;

class WorkerAuthController extends Controller
{
    use AuthenticatesUsers, HandlesFileUploads;
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
            $imagePath = $this->storeFile($request->file('profile_picture'), 'profile-pictures');

            Worker::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'specialization' => $request->specialization,
                'photo' => $imagePath,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('worker.login')->with('success', 'Registration successful! Please login.');
        } catch (\Exception $e) {
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
        $worker = $this->attemptLogin($request, Worker::class);

        if ($worker) {
            session([
                'worker_logged_in' => true,
                'worker_id' => $worker->id,
                'worker_name' => $worker->name
            ]);
            return redirect()->route('worker.dashboard');
        }

        return $this->failedLoginResponse('Invalid credentials');
    }

    public function showResetForm()
    {
        return view('worker.passwords.reset');
    }


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