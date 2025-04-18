<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
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
        $adminPassword = 'admin123'; // You can hash this too for security
    
        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with('failed', 'Invalid admin credentials');
        }
    }
    
}
