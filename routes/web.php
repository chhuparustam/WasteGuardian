<?php

use Illuminate\Support\Facades\Route;

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




Route::get('login', [Userauth_controller::class, 'login']);
Route::get('register', [Userauth_controller::class, 'register']);
Route::post('create', [Userauth_controller::class, 'create'])->name('auth.create');