<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WasteGuardian - User Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link your user CSS file -->
    <link rel="stylesheet" href="{{ asset('css/user-dashboard.css') }}">
</head>
<body>

    <div class="header">
        WasteGuardian - User Panel
    </div>

    <div class="container">
        <div class="sidebar">
            <a href="#">Dashboard Home</a>
            <a href="#">Request Waste Pickup</a>
            <a href="#">My Pickup History</a>
            <a href="#">Submit Complaint</a>
            <a href="{{ url('/logout') }}">Logout</a>
        </div>

        <div class="content">
            <div class="card">
                <h2>Welcome, {{ Auth::user()->fullName }}</h2>
                <p>Manage your waste pickup requests and track history from your dashboard.</p>
            </div>

            <div class="card">
                <h3>Quick Stats</h3>
                <ul>
                    <li>Pickup Requests Made: {{ $pickupCount ?? 0 }}</li>
                    <li>Pending Requests: {{ $pendingCount ?? 0 }}</li>
                    <li>Complaints Submitted: {{ $complaintCount ?? 0 }}</li>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>
