<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WasteGuardian - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body>

    <div class="header">
        WasteGuardian Admin Dashboard
    </div>

    <div class="container">
        <div class="sidebar">
            <h2>WasteGuardian</h2>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.users.index') }}">Manage Users</a>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>

</body>
</html>
