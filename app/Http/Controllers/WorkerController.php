<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Activity;

class WorkerController extends Controller
{
    public function dashboard()
    {
        if (!session('worker_logged_in')) {
            return redirect()->route('worker.login');
        }

        $workerId = session('worker_id');
        
       

        return view('worker.dashboard');
    }
}