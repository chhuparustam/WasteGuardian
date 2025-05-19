<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WasteGuardian - User Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/user-dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="header">
    <div class="header-left">
        <a href="{{ url('/') }}" target="_blank" class="logo-link">
            <i class="fas fa-leaf"></i> WasteGuardian
        </a>
    </div>
    <div class="header-center">
        <span>Welcome Back, {{ session('user_name', 'User') }}!</span>
    </div>
    <div class="header-right">
        <form action="" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</div>


    <div class="container">
        <div class="sidebar">
            <h2><i class="fas fa-home"></i>Home</h2>
            
            <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            
            <a href="{{ route('user.requests') }}" class="{{ request()->routeIs('user.requests') ? 'active' : '' }}">
                <i class="fas fa-trash-restore"></i> New Request
            </a>
            
            <a href="{{ route('user.my-requests') }}" class="{{ request()->routeIs('user.my-requests') ? 'active' : '' }}">
                <i class="fas fa-recycle"></i> My Requests
            </a>
            
            <a href="" class="{{ request()->routeIs('user.complaints') ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle"></i> My Complaints
            </a>
                        
            <a href="{{ route('user.profile') }}" class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i> My Profile
            </a>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>