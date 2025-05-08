<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WasteGuardian - Worker Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/worker-dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <i class="fas fa-hard-hat"></i>
            <span>{{ session('worker_name', 'Worker') }}</span>
        </div>
        <div class="header-title">
            WasteGuardian Worker Dashboard
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <a href="{{ url('/') }}" target="_blank"><h2><i class="fas fa-leaf"></i> WasteGuardian</h2></a>
            <a href="{{ route('worker.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            <a href=""><i class="fas fa-tasks"></i> My Tasks</a>
            <a href=""><i class="fas fa-calendar-alt"></i> Schedule</a>
            <a href=""><i class="fas fa-user-circle"></i> My Profile</a>
            
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