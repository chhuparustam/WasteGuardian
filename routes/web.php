<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\Admin\AdminloginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Driver\LoginController;
use App\Http\Controllers\PickupRequestController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\WorkerAuthController;
use App\Http\Controllers\UserDashboardController;
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


// for user signup and login
Route::get('login', [UserAuthController::class, 'login'])->name('login');
Route::post('login', [UserAuthController::class, 'checkLogin'])->name('auth.login');

Route::get('register', [UserAuthController::class, 'register'])->name('register');
Route::post('register', [UserAuthController::class, 'create'])->name('auth.create');
Route::get('/', function () {
    return view('index'); 
});



// main dashboard(template)
Route::get('/dashboard', function () {
    return view('auth.dashboard');
});



// for admin login
Route::get('admin-login', [AdminLoginController::class, 'adminLoginPage'])->name('admin.login');
Route::post('admin-login', [AdminLoginController::class, 'adminLogin'])->name('admin.login.submit');

Route::get('/adminlogin', function () {
    return view('auth.admin-login');
});


//  redirect to admin dashboard

Route::get('/admin.dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


// for maange user
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

//  User Dashboard Routes

Route::prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    // Add other user routes here
});




//for manage drivers

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Route to add a new driver
    Route::get('drivers/create', [DriverController::class, 'create'])->name('drivers.create');
    Route::post('drivers', [DriverController::class, 'store'])->name('drivers.store');
    

    Route::get('drivers', [DriverController::class, 'index'])->name('drivers.index');
    Route::get('drivers/{id}/edit', [DriverController::class, 'edit'])->name('drivers.edit');
    Route::put('drivers/{id}', [DriverController::class, 'update'])->name('drivers.update');
    Route::delete('drivers/{id}', [DriverController::class, 'destroy'])->name('drivers.destroy');
});



// for driverr login

Route::get('/driver/login', [LoginController::class, 'showLoginForm'])->name('driver.login');
Route::post('/driver/login', [LoginController::class, 'login'])->name('driver.login.submit');




// pickup request
Route::post('/pickup-request', [PickupRequestController::class, 'store'])->name('pickup.store');

Route::prefix('admin')->group(function () {
    Route::get('/requests', [AdminRequestController::class, 'index'])->name('admin.requests.index');
});


// for select login type

Route::get('/select-login', function () {
    return view('auth.select-login');
})->name('select-login');


// Registration selection route
Route::get('/select-register', function () {
    return view('auth.select-register');
})->name('select-register');




// for worker signup and login
Route::get('/worker/register', [WorkerAuthController::class, 'showRegistrationForm'])->name('worker.register');
Route::post('/worker/register', [WorkerAuthController::class, 'register'])->name('worker.register.submit');
Route::get('/worker/login', [WorkerAuthController::class, 'showLoginForm'])->name('worker.login');
Route::post('/worker/login', [WorkerAuthController::class, 'login'])->name('worker.login.submit');
