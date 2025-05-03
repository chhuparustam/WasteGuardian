<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\DriverModel;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('driver.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $driver = DriverModel::where('email', $request->email)->first();

        if (!$driver || !Hash::check($request->password, $driver->password)) {
            return back()->with('error', 'Invalid email or password')->withInput();
        }

        session(['driver_id' => $driver->id]);
        return redirect()->route('driver.dashboard');
    }
}
