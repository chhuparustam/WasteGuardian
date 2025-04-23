<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\Admin\AdminloginController;
use App\Http\Controllers\Admin\UserController;
use APp\Http\Controllers\Admin\AdminDashboardController;

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




// for user signup and login
Route::get('login', [UserAuthController::class, 'login'])->name('login');
Route::post('login', [UserAuthController::class, 'checkLogin'])->name('auth.login');
Route::get('register', [UserAuthController::class, 'register'])->name('register');
Route::post('register', [UserAuthController::class, 'create'])->name('auth.create');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');


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


// for user managemant
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});





// Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
//     Route::get('users', [UserController::class, 'index'])->name('users.index');
//     Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
//     Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
//     Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
// });




