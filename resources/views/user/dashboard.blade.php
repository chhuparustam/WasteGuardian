@if (!session()->has('user_logged_in') || !session('user_logged_in'))
    <script>window.location = "{{ route('login') }}";</script>
@endif

@extends('user.layout')

@section('content')
    <div class="dashboard-header">
        <h1>My Dashboard</h1>
        <div class="date-time">
            <i class="fas fa-calendar-alt"></i>
            <span>{{ now()->format('l, F j, Y') }}</span>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="stats-cards">
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-recycle"></i>
            </div>
            <div class="card-info">
                <h3>Total Requests</h3>
                <p>{{ $requestCount ?? '4' }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="card-info">
                <h3>Pending Requests</h3>
                <p>{{ $pendingCount ?? '3' }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="card-info">
                <h3>Completed Requests</h3>
                <p>{{ $completedCount ?? '2' }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="card-info">
                <h3>Active Complaints</h3>
                <p>{{ $complaintCount ?? '9' }}</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
        <div class="action-buttons">
            <a href="" class="action-btn">
                <i class="fas fa-trash-restore"></i>
                New Request
            </a>
            <a href="" class="action-btn">
                <i class="fas fa-comment-alt"></i>
                File Complaint
            </a>
            <a href="" class="action-btn">
                <i class="fas fa-user-edit"></i>
                Update Profile
            </a>
        </div>
    </div>

    <div class="dashboard-cards">
        <!-- Welcome Card -->
       

        <!-- Recent Activity -->
        <div class="card activity-card">
            <h3><i class="fas fa-history"></i> Recent Activity</h3>
            <div class="activity-list">
                @if(isset($recentActivities) && count($recentActivities) > 0)
                    @foreach($recentActivities as $activity)
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="activity-details">
                                <p>{{ $activity->description }}</p>
                                <span>{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="no-activity">No recent activities</p>
                @endif
            </div>
        </div>
    </div>
@endsection