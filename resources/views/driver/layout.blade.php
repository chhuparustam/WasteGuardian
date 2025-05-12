<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WasteGuardian - Driver Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/driver-dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('head')
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <i class="fas fa-truck"></i>
            <span>{{ session('driver_name', 'Driver') }}</span>
        </div>
        <div class="header-title">
            WasteGuardian Driver Dashboard
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <a href="{{ url('/') }}" target="_blank"><h2><i class="fas fa-leaf"></i> WasteGuardian</h2></a>
            <a href="{{ route('driver.dashboard') }}" class="{{ request()->routeIs('driver.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="#"><i class="fas fa-route"></i> My Routes</a>
            <a href="#"><i class="fas fa-calendar-day"></i> Schedule</a>
            <a href="#"><i class="fas fa-user"></i> My Profile</a>
            
            <div class="sidebar-footer">
               <form action="" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>