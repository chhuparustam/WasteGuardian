<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteGuardian - Worker Portal</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/worker-dashboard.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Top Navigation -->
    <div class="header">
        <div class="header-left">
            <a href="{{ url('/') }}" class="logo-link">
                <i class="fas fa-leaf"></i> WasteGuardian
            </a>
            
        </div>
        <div class="header-center">
            <div class="worker-info">
                <span>Welcome Back, {{ session('worker_name', 'Worker') }}!</span>
                <small>{{ session('worker_role', 'Field Staff') }}</small>
            </div>
        </div>
        <div class="header-right">
            <div class="notifications">
                <a href="#" class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="badge">3</span>
                </a>
            </div>
            <form action="" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <div class="worker-profile">
                <div class="profile-photo">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="info">
                    <h3>{{ session('worker_name', 'Worker') }}</h3>
                    <span class="status online">
                        <i class="fas fa-circle"></i> Online
                    </span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('worker.dashboard') }}" 
                   class="{{ request()->routeIs('worker.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> 
                    <span>Dashboard</span>
                </a>
                
                <a href="" 
                   class="{{ request()->routeIs('worker.tasks') ? 'active' : '' }}">
                    <i class="fas fa-tasks"></i>
                    <span>My Tasks</span>
                    
                </a>
                
                <a href=""
                   class="{{ request()->routeIs('worker.schedule') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Schedule</span>
                </a>

                <a href=""
                   class="{{ request()->routeIs('worker.history') ? 'active' : '' }}">
                    <i class="fas fa-history"></i>
                    <span>Work History</span>
                </a>
                
                <a href="" 
                   class="{{ request()->routeIs('worker.profile') ? 'active' : '' }}">
                    <i class="fas fa-user-circle"></i>
                    <span>My Profile</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="quick-stats">
                    <div class="stat">
                        <span>Today's Tasks</span>
                        <strong>{{ session('today_tasks', 6) }}</strong>
                    </div>
                    <div class="stat">
                        <span>Completed</span>
                        <strong>{{ session('completed_tasks', 4) }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/worker-dashboard.js') }}"></script>
    @stack('scripts')
</body>
</html>