@extends('admin.layout')

@section('content')
    <h1>Admin Dashboard</h1>

    <!-- Stat Cards -->
    <div class="stats-cards">
        <div class="card">
            <h3>Total Users</h3>
            <p>{{ $userCount ?? '120' }}</p>
        </div>
        <div class="card">
            <h3>Total Drivers</h3>
            <p>{{ $driverCount ?? '25' }}</p>
        </div>
        <div class="card">
            <h3>Pending Complaints</h3>
            <p>{{ $complaintCount ?? '10' }}</p>
        </div>
        <div class="card">
            <h3>Total Requests</h3>
            <p>{{ $requestCount ?? '75' }}</p>
        </div>
    </div>

    <div class="card welcome-card">
        <h2>Welcome Admin!</h2>
        <p>Use the sidebar to manage users, drivers, complaints and requests efficiently.</p>
    </div>
@endsection
