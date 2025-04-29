<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\Admin\AdminloginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminDashboardController;
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
    return view('index');
});




// for user signup and login
Route::get('login', [UserAuthController::class, 'login'])->name('login');
Route::post('login', [UserAuthController::class, 'checkLogin'])->name('auth.login');
Route::get('register', [UserAuthController::class, 'register'])->name('register');
Route::post('register', [UserAuthController::class, 'create'])->name('auth.create');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');


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




// user dashboard

Route::get('/user/dashboard', function () {
    return view('frontend.dashboard');
})->name('user.dashboard')->middleware('auth');
