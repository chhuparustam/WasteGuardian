<!-- resources/views/admin/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WasteGuardian - Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">

</head>
<body>

    <div class="header">
        WasteGuardian Admin Dashboard
    </div>

    <div class="container"> 
        <div class="sidebar">
            <a href="#">Dashboard Home</a>
            <a href="#">Manage Users</a>
            <a href="{{ route('admin.drivers.index') }}">Manage Drivers</a>
            <a href="#">Complaints & Requests</a>
            <a href="{{ url('admin/logout') }}">Logout</a>
        </div>

        <div class="content">
            <div class="card">
                <h2>Welcome Admin!</h2>
                <p>Use the sidebar to manage all roles and handle system operations effectively.</p>
            </div>

            <div class="card">
                <h3>Quick Stauts</h3>
                <ul>
                    <li>Total Users: {{ $userCount ?? 'N/A' }}</li>
                    <li>Total Drivers: {{ $driverCount ?? 'N/A' }}</li>
                    <li>Total Requests: {{ $requestCount ?? 'N/A' }}</li>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>
