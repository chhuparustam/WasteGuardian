<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WasteGuardian - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="header">
    <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>
    <div class="header-title">
        WasteGuardian Admin Dashboard
    </div>
</div>

    <div class="container">
        <div class="sidebar">
           <a href ='{{ url('/') }}' target="_blank"> <h2>WasteGuardian</h2></a>
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            <a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i> Manage Users</a>
            <a href="{{ route('admin.drivers.index') }}"><i class="fas fa-truck"></i> Manage Drivers</a>
            <a href=""><i class="fas fa-hard-hat"></i> Manage Workers</a>
            <a href="{{ route('admin.requests.index') }}"><i class="fas fa-clipboard-list"></i> Manage Requests</a>
            <a href=""><i class="fas fa-exclamation-circle"></i> Complaints</a>
            <a href=""><i class="fas fa-sign-out-alt"></i> Logout</a>
            
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>

</body>
</html>
