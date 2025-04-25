<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
        public function showDashboard()
    {
        $userCount = User::count();
        return view('admin.dashboard', compact('userCount'));
    }
}
