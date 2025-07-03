<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PickupRequest;
use App\Models\Complaint;


class AdminLoginController extends Controller
{

    public function adminLoginPage() {
        return view('auth.admin-login');
    }



    public function adminLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $adminEmail = 'admin@wasteguardian.com';
        $adminPassword = 'admin123';

        if ($request->email === $adminEmail && $request->password === $adminPassword) {

        
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with('failed', 'Invalid admin credentials');
        }
    }

   public function dashboard() {
        $data['driverCount'] = User::where('type','driver')->count();
        $data['complaintCount'] = Complaint::count();
        $data['requestCount'] = PickupRequest::count();
        $data['userCount'] = User::count();

        return view('admin.dashboard', $data);
    }

}