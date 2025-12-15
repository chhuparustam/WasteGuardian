<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\PickupRequest;
use App\Http\Traits\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function showLoginForm()
    {
        return view('driver.login');
        
    }
    

    public function login(Request $request)
    {
        $driver = $this->attemptLogin($request, User::class);

        if ($driver) {
            Auth::login($driver);
            session([
                'driver_id' => $driver->id,
                'driver_name' => $driver->name,
                'driver_logged_in' => true
            ]);
            
            return redirect()->route('driver.dashboard');
        }

        return $this->failedLoginResponse('Invalid credentials.');
    }

    public function dashboard()
    {
        if (!Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this complaint.');
        }
        
        $data['assignedRoutes'] = PickupRequest::where('user_id', Auth::id())->count();
        $data['pendingPickups'] = PickupRequest::where('user_id', Auth::id())->where('status', 'pending')->count();
        
        return view('driver.dashboard', $data);
    }
}