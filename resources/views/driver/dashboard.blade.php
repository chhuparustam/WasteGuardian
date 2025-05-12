@if (!session()->has('driver_logged_in') || !session('driver_logged_in'))
    <script>window.location = "{{ route('driver.login') }}";</script>
@endif

@extends('driver.layout')

@section('content')
    <div class="dashboard-header">
        <h1>Driver Dashboard</h1>
        <div class="date-time">
            <i class="fas fa-calendar-alt"></i>
            <span>{{ now()->format('l, F j, Y') }}</span>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="stats-cards">
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-route"></i>
            </div>
            <div class="card-info">
                <h3>Assigned Routes</h3>
                <p>{{ $assignedRoutes ?? '3' }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="card-info">
                <h3>Pending Pickups</h3>
                <p>{{ $pendingPickups ?? '2' }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-check-double"></i>
            </div>
            <div class="card-info">
                <h3>Completed Pickups</h3>
                <p>{{ $completedPickups ?? '5' }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="card-info">
                <h3>Performance Rating</h3>
                <p>{{ $rating ?? '4.7' }}/5</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
        <div class="action-buttons">
            <a href="" class="action-btn">
                <i class="fas fa-map-marked-alt"></i>
                View Routes
            </a>
            <a href="" class="action-btn">
                <i class="fas fa-truck"></i>
                Update Pickup Status
            </a>
            <a href="" class="action-btn">
                <i class="fas fa-user-edit"></i>
                Update Profile
            </a>
        </div>
    </div>

    <div class="dashboard-cards">
        <!-- Today's Schedule -->
        <div class="card schedule-card">
            <h3><i class="fas fa-calendar-day"></i> Today's Schedule</h3>
            <div class="schedule-list">
                @if(isset($todayRoutes) && count($todayRoutes) > 0)
                    @foreach($todayRoutes as $route)
                        <div class="schedule-item">
                            <div class="schedule-time">
                                <i class="fas fa-clock"></i>
                                <span>{{ $route->time }}</span>
                            </div>
                            <div class="schedule-details">
                                <h4>{{ $route->title }}</h4>
                                <p>{{ $route->location }}</p>
                                <span class="status status-{{ $route->status }}">{{ ucfirst($route->status) }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="no-schedule">No routes scheduled for today</p>
                @endif
            </div>
        </div>

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