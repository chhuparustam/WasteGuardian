<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\DriverModel;
use Illuminate\Support\Facades\Hash;
use App\Models\PickupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    $driver = User::where('email', $request->email)->first();

    if ($driver && Hash::check($request->password, $driver->password)) {
        Auth::login($driver);
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

public function dashboard(){
    if ( !Auth::id()) {
        return redirect()->back()->with('error', 'You are not authorized to delete this complaint.');
    }
    $data ['assignedRoutes'] = PickupRequest::where('user_id',Auth::id())->count();
    $data ['pendingPickups'] = PickupRequest::where('user_id',Auth::id())->where('status','pending')->count();
    return view('driver.dashboard',$data);


}


}
