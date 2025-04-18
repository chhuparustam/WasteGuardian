<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;

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




// Show and handle login form
Route::get('login', [UserAuthController::class, 'login'])->name('login');
Route::post('login', [UserAuthController::class, 'checkLogin'])->name('auth.login');
Route::get('register', [UserAuthController::class, 'register'])->name('register');
Route::post('register', [UserAuthController::class, 'create'])->name('auth.create');


// Route::get('/dashboard', function () {
//     return view('dashboard'); // Create dashboard.blade.php
// })->middleware('auth');

