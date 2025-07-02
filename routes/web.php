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
use App\Http\Controllers\Admin\WorkerController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\User\ServiceController;
use App\Http\Controllers\Admin\CleaningServiceController;



// for user signup and login
Route::get('login', [UserAuthController::class, 'login'])->name('login');
Route::post('/login-submit', [UserAuthController::class, 'checkLogin'])->name('auth.login');

Route::get('register', [UserAuthController::class, 'register'])->name('register');
Route::post('register', [UserAuthController::class, 'create'])->name('auth.create');
Route::get('/', function () {
    return view('index'); 
});
Route::get('/user/edit-profile', [UserAuthController::class, 'editProfile'])->name('user.edit-profile');
Route::put('/user/update-profile', [UserAuthController::class, 'updateProfile'])->name('user.update-profile');
Route::get('/user/profile', [UserAuthController::class, 'profile'])->name('user.profile');

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
// Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('auth.admin-login');
Route::get('/admin.dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


// for manage user
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
    Route::get('/requests', function () {
        return view('user.requests');
    })->name('user.requests');
    Route::get('/my-requests', [PickupRequestController::class, 'userRequests'])->name('user.my-requests');
    Route::get('/my-requests-delete/{id}', [PickupRequestController::class, 'deleteRequest'])->name('user.my-requests-delete');
    Route::get('/my-requests-edit/{id}', [PickupRequestController::class, 'editRequest'])->name('user.my-requests-edit');
    Route::post('/my-requests-update/{id}', [PickupRequestController::class, 'updateRequest'])->name('user.my-requests-update');
    // Profile edit/update routes
    Route::get('/edit-profile', [UserAuthController::class, 'editProfile'])->name('user.edit-profile');
    Route::put('/update-profile', [UserAuthController::class, 'updateProfile'])->name('user.update-profile');
});



//for admin/manage drivers

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Route to add a new driver
    Route::get('drivers/create', [DriverController::class, 'create'])->name('drivers.create');
    Route::post('drivers', [DriverController::class, 'store'])->name('drivers.store');
    

    Route::get('drivers', [DriverController::class, 'index'])->name('drivers.index');
    Route::get('drivers/{id}/edit', [DriverController::class, 'edit'])->name('drivers.edit');
    Route::put('drivers/{id}', [DriverController::class, 'update'])->name('drivers.update');
    Route::delete('drivers/{id}', [DriverController::class, 'destroy'])->name('drivers.destroy');
});
// route to manage workers
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('workers', [WorkerController::class, 'index'])->name('workers.index');
    });




// Route for waste pickup request
Route::delete('admin/requests/{request}', [AdminRequestController::class, 'destroy'])->name('admin.requests.destroy');
Route::post('/pickup-request', [PickupRequestController::class, 'store'])->name('pickup.store');
Route::get('admin/requests/{request}', [AdminRequestController::class, 'show'])->name('admin.requests.show');
Route::post('admin/requests/{request}/assign', [AdminRequestController::class, 'assignDriver'])->name('admin.requests.assignDriver');
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

// Worker dashboard 
Route::get('/worker/dashboard', function () {
    return view('worker.dashboard');
})->name('worker.dashboard');
Route::get('/worker/edit/profile', [WorkerAuthController::class, 'editProfile'])->name('worker.edit-profile');
Route::post('/worker/edit/profile', [WorkerAuthController::class, 'updateProfile'])->name('worker.edit-profile.update');




// route for driverr login

Route::get('/driver/login', [LoginController::class, 'showLoginForm'])->name('driver.login');
Route::post('/driver/login', [LoginController::class, 'login'])->name('driver.login.submit');

// route for driver dashboard
Route::get('/driver/dashboard', function () {
    return view('driver.dashboard');
})->name('driver.dashboard');




Route::get('/user/complaints/create', [ComplaintController::class, 'create'])->name('user.complaints.create');
Route::post('/user/complaints', [ComplaintController::class, 'store'])->name('user.complaints.store');

// My Complaints Page
Route::get('/user/complaints', [ComplaintController::class, 'index'])->name('user.complaints.index');



// Route for claening services
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('admin/cleaning-services', CleaningServiceController::class);
    Route::resource('cleaning-services', CleaningServiceController::class);
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
    // Add booking route if needed
    // Route::post('/services/{service}/book', [ServiceBookingController::class, 'store'])->name('services.book');
});