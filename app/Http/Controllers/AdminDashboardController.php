<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index() {
        $userCount = \App\Models\User::count();
        // $driverCount = \App\Models\Driver::count();
        // $requestCount = \App\Models\Request::count();
    
        return view('admin.dashboard', compact('userCount'));
        //, 'driverCount', 'requestCount
    }
    
}
