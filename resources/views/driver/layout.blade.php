<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteGuardian - Driver Portal</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/driver-dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Head Content -->
    @yield('head')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <div class="logo-container">
                <i class="fas fa-truck"></i>
                <span>{{ session('driver_name', 'Driver') }}</span>
            </div>
        </div>
        <div class="header-center">
            <h1>WasteGuardian Driver Portal</h1>
        </div>
        <div class="header-right">
            <div class="nav-actions">
                <a href="#" class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="badge">0</span>
                </a>
                <form action="" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="nav-logout-btn">
                        <i class="fas fa-sign-out-alt"></i>logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="driver-profile">
                <div class="profile-photo">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="info">
                    <h3>{{ session('driver_name', 'Driver') }}</h3>
                    <span class="status online">
                        <i class="fas fa-circle"></i> Online
                    </span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('driver.dashboard') }}" 
                   class="{{ request()->routeIs('driver.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> 
                    <span>Dashboard</span>
                </a>
                
                <a href="" 
                   class="{{ request()->routeIs('driver.routes') ? 'active' : '' }}">
                    <i class="fas fa-route"></i>
                    <span>My Routes</span>
                </a>

                <a href=""
                   class="{{ request()->routeIs('driver.schedule') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Schedule</span>
                </a>

                <a href=""
                   class="{{ request()->routeIs('driver.collections') ? 'active' : '' }}">
                    <i class="fas fa-truck-loading"></i>
                    <span>Collections</span>
                </a>
                
                <a href="" 
                   class="{{ request()->routeIs('driver.profile') ? 'active' : '' }}">
                    <i class="fas fa-user-circle"></i>
                    <span>My Profile</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="quick-stats">
                    <div class="stat">
                        <span>Today's Routes</span>
                        <strong>{{ session('today_routes', 9) }}</strong>
                    </div>
                    <div class="stat">
                        <span>Collections</span>
                        <strong>{{ session('today_collections', 8) }}</strong>
                    </div>
                </div>
                
                
            </div>
        </aside>

        <!-- Main Content -->
        <main class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                    <button type="button" class="close-alert">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                    <button type="button" class="close-alert">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/driver-dashboard.js') }}"></script>
    @stack('scripts')
</body>
</html>