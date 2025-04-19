<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\DriverController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




// for user
Route::get('login', [UserAuthController::class, 'login'])->name('login');
Route::post('login', [UserAuthController::class, 'checkLogin'])->name('auth.login');
Route::get('register', [UserAuthController::class, 'register'])->name('register');
Route::post('register', [UserAuthController::class, 'create'])->name('auth.create');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// for admin

Route::get('admin-login', [AdminAuthController::class, 'adminLoginPage'])->name('admin.login');
Route::post('admin-login', [AdminAuthController::class, 'adminLogin'])->name('admin.login.submit');


Route::get('admin/dashboard', function () {
    return view('admin.dashboard'); 
})->name('admin.dashboard');

// for admin dashboard
Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

//for driver

Route::prefix('admin')->group(function () {
    Route::get('drivers', [DriverController::class, 'index'])->name('admin.drivers.index');
    Route::get('drivers/create', [DriverController::class, 'create'])->name('admin.drivers.create');
    Route::post('drivers', [DriverController::class, 'store'])->name('admin.drivers.store');
});

