<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    /**
     * Handle admin logout
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_email']);
        return redirect()->route('admin.login')
                        ->with('success', 'Logged out successfully');
    }
}

