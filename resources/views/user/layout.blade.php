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
        <span>Welcome Back, {{ auth()->user()->fullName ?? 'Guest' }}!</span>
    </div>
    <div class="header-right">
       
            <a href="{{ route('user.logout') }}" class="profile-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>    
            
        
    </div>
</div>


    <div class="container">
        <!-- Sidebar -->
     <div class="sidebar">
            <!-- User Profile -->
            <div class="user-profile">
                <div class="profile-photo">
                    <i class="fas fa-user"></i>
                </div>
                <div class="info">
                    <h3>{{ auth()->user()->fullName ?? 'Guest' }}</h3>
                    <span class="status online">
                        <i class="fas fa-circle"></i> Online
                    </span>
                </div>
            </div>
            
            <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            
            <a href="{{ route('user.requests') }}" class="{{ request()->routeIs('user.requests') ? 'active' : '' }}">
                <i class="fas fa-trash-restore"></i> New Request
            </a>
            
                <a href="{{ route('user.my-requests') }}" class="{{ request()->routeIs('user.my-requests') ? 'active' : '' }}">
                <i class="fas fa-recycle"></i> My Requests
            </a>
            <a href="{{ route('user.services.booked') }}" class="{{ request()->routeIs('user.cleaning-services') ? 'active' : '' }}">
                <i class="fas fa-broom"></i> Cleaning Services
            </a>

                <a href="{{ route('user.complaints.create') }}" class="{{ request()->routeIs('user.complaints.create') ? 'active' : '' }}">
                <i class="fas fa-comment-alt"></i> File Complaint
            </a>
            
            <a href="{{ route('user.complaints.index') }}" class="{{ request()->routeIs('user.complaints.index') ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle"></i> My Complaints
            </a>
                        
            <a href="{{ route('user.profile') }}" class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i> My Profile
            </a>

            <div class="sidebar-footer">
        <!-- <div class="quick-stats">
            <div class="stat">
                <span>Active Requests</span>
                <strong>{{ session('active_requests', 2) }}</strong>
            </div>
            <div class="stat">
                <span>Total Pickups</span>
                <strong>{{ session('total_pickups', 15) }}</strong>
            </div>
        </div> -->
    </div>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>