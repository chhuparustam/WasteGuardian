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
        <div class="logo-container">
            <i class="fas fa-user-circle"></i>
            <span>{{ session('user_name', 'User') }}</span>
        </div>
        <div class="header-title">
            WasteGuardian User Dashboard
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <a href="{{ url('/') }}" target="_blank"><h2><i class="fas fa-leaf"></i> WasteGuardian</h2></a>
            <a href="{{ route('user.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            <a href=""><i class="fas fa-dumpster"></i> My Requests</a>
            <a href=""><i class="fas fa-exclamation-triangle"></i> My Complaints</a>
            <a href=""><i class="fas fa-user-circle"></i> My Profile</a>
            
            <div class="sidebar-footer">
    
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