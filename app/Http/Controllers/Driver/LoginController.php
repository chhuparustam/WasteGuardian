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
        'password' => 'required',
    ]);

    $driver = DriverModel::where('email', $request->email)->first();

    if ($driver && Hash::check($request->password, $driver->password)) {
        session([
            'driver_id' => $driver->id,
            'driver_name' => $driver->name,
            'driver_logged_in' => true
        ]);
        
        return redirect()->route('driver.dashboard');

    } else {
        return redirect()->back()->with('failed', 'Invalid credentials.');
    }
}


}
