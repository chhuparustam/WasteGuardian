<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    // app/Http/Controllers/Admin/WorkerController.php

    public function index()
    {
        $workers = Worker::all();
        return view('admin.workers.index', compact('workers'));
    }

}
