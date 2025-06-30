@if(!auth()->check())
    <script>window.location = "{{ route('login') }}";</script>
@endif

@extends('user.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user-dashboard.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/dashboard-charts.js') }}"></script>

<div class="dashboard-container">
    <!-- Welcome Section -->
                @if(session('success'))
    <div class="custom-alert custom-alert-success" role="alert">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
        <button type="button" class="close-alert" onclick="this.parentElement.style.display='none';" aria-label="Close">
            &times;
        </button>
    </div>
@endif

    <!-- Stats Cards -->
    <div class="stats-overview">
        <div class="stat-card">
            <div class="stat-icon requests">
                <i class="fas fa-truck-loading"></i>
            </div>
            <div class="stat-details">
                <h3>Total Requests</h3>
                <p>{{ $totalRequests ?? 0 }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-details">
                <h3>Pending</h3>
                <p>{{ $pendingRequests ?? 0 }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon completed">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-details">
                <h3>Completed</h3>
                <p>{{ $completedRequests ?? 0 }}</p>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="chart-section">
        <h2>Activity Overview</h2>
        <div class="chart-container">
            <canvas id="statsAreaChart"></canvas>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="action-buttons">
            <a href="{{ route('user.requests') }}" class="action-btn request-btn">
                <i class="fas fa-trash-restore"></i>
                <span>New Request</span>
            </a>

            <a href="{{ route('user.complaints.create') }}" class="action-btn complaint-btn">
                <i class="fas fa-comment-alt"></i>
                <span>File Complaint</span>
            </a>
                <a href="{{ route('user.edit-profile') }}" class="action-btn profile-btn">
                    <i class="fas fa-user-edit"></i>
                    <span>Update Profile</span>
                </a>

        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <h2>Recent Activity</h2>
        <div class="activity-list">
                @php
            $demoActivities = [
                [
                    'description' => 'New waste collection request submitted',
                    'created_at' => now()->subHours(2),
                    'icon' => 'fa-trash-restore',
                    'color' => 'blue'
                ],
                [
                    'description' => 'Complaint filed regarding missed collection',
                    'created_at' => now()->subDays(1),
                    'icon' => 'fa-comment-alt',
                    'color' => 'orange'
                ],
                [
                    'description' => 'Request #123 has been completed',
                    'created_at' => now()->subDays(2),
                    'icon' => 'fa-check-circle',
                    'color' => 'green'
                ],
                [
                    'description' => 'Profile information updated',
                    'created_at' => now()->subDays(3),
                    'icon' => 'fa-user-edit',
                    'color' => 'purple'
                ]
            ];
            @endphp

            @foreach($recentActivities as $activity)
                <div class="activity-item">
                    @php
                        $iconMap = [
                            'request_created' => ['icon' => 'fa-trash-restore', 'color' => 'blue'],
                            'complaint_filed' => ['icon' => 'fa-comment-alt', 'color' => 'orange'],
                            'request_completed' => ['icon' => 'fa-check-circle', 'color' => 'green'],
                            'profile_updated' => ['icon' => 'fa-user-edit', 'color' => 'purple'],
                        ];

                        $icon = $iconMap[$activity['type']]['icon'] ?? 'fa-info-circle';
                        $color = $iconMap[$activity['type']]['color'] ?? 'gray';
                    @endphp
                    <div class="activity-icon" style="color: {{ $color }}">
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    <div class="activity-details">
                        <p>{{ $activity['description'] }}</p>
                        <span>{{ $activity['created_at']->diffForHumans() }}</span>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get last 7 days
    const days = [...Array(7)].map((_, i) => {
        const d = new Date();
        d.setDate(d.getDate() - i);
        return d.toLocaleDateString('en-US', { weekday: 'short' });
    }).reverse();

    var ctx = document.getElementById('statsAreaChart').getContext('2d');
    
    var statsAreaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: days,
            datasets: [{
                label: 'Total Requests',
                data: [4, 6, 3, 5, 2, 4, 3],
                backgroundColor: 'rgba(76, 175, 80, 0.1)',
                borderColor: '#4CAF50',
                tension: 0.4,
                fill: true
            }, {
                label: 'Completed',
                data: [2, 4, 2, 3, 1, 3, 2],
                backgroundColor: 'rgba(33, 150, 243, 0.1)',
                borderColor: '#2196F3',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            family: "'Poppins', sans-serif",
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        family: "'Poppins', sans-serif"
                    },
                    bodyFont: {
                        size: 13,
                        family: "'Poppins', sans-serif"
                    },
                    callbacks: {
                        title: function(context) {
                            return context[0].label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            family: "'Poppins', sans-serif",
                            size: 12
                        },
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: "'Poppins', sans-serif",
                            size: 12
                        }
                    }
                }
            }
        }
    });
});
</script>