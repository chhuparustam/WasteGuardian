@if (!session()->has('worker_logged_in') || !session('worker_logged_in'))
    <script>window.location = "{{ route('worker.login') }}";</script>
@endif

@extends('worker.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/worker-dashboard.css') }}">
<div class="dashboard-container">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="close-alert" onclick="this.parentElement.style.display='none';">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-overview">
        <div class="stat-card">
            <div class="stat-icon tasks">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="stat-details">
                <h3>Assigned Tasks</h3>
                <p>{{ $assignedTasks ?? '5' }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-details">
                <h3>Pending Tasks</h3>
                <p>{{ $pendingTasks ?? '2' }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon completed">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-details">
                <h3>Completed Tasks</h3>
                <p>{{ $completedTasks ?? '3' }}</p>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="chart-section">
        <div class="chart-header">
            <h2><i class="fas fa-chart-line"></i> Performance Overview</h2>
            <div class="chart-filters">
                <button class="filter-btn active" data-period="week">Week</button>
                <button class="filter-btn" data-period="month">Month</button>
                <button class="filter-btn" data-period="year">Year</button>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="workerStatsChart" height="280"></canvas>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
        <div class="action-buttons">
            <a href="" class="action-btn task-btn">
                <i class="fas fa-clipboard-list"></i>
                <span>View Tasks</span>
            </a>
            <a href="" class="action-btn schedule-btn">
                <i class="fas fa-calendar-check"></i>
                <span>Today's Schedule</span>
            </a>
            <a href="{{ route('worker.edit-profile') }}" class="action-btn profile-btn">
                <i class="fas fa-user-edit"></i>
                <span>Update Profile</span>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <h2><i class="fas fa-history"></i> Recent Activity</h2>
        <div class="activity-list">
            @php
            $demoActivities = [
                [
                    'description' => 'Completed waste collection at Location A',
                    'created_at' => now()->subHours(2),
                    'icon' => 'fa-check-circle',
                    'color' => '#4CAF50'
                ],
                [
                    'description' => 'Started new task assignment',
                    'created_at' => now()->subHours(4),
                    'icon' => 'fa-play',
                    'color' => '#2196F3'
                ],
                [
                    'description' => 'Updated task status for Request #456',
                    'created_at' => now()->subDays(1),
                    'icon' => 'fa-sync',
                    'color' => '#FF9800'
                ]
            ];
            @endphp

            @forelse($activities ?? $demoActivities as $activity)
                <div class="activity-item">
                    <div class="activity-icon" style="color: {{ $activity['color'] }}">
                        <i class="fas {{ $activity['icon'] }}"></i>
                    </div>
                    <div class="activity-details">
                        <p>{{ $activity['description'] }}</p>
                        <span>{{ $activity['created_at']->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-info-circle"></i>
                    <p>No recent activities</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const seed = @json($chartData ?? null);
    const ctx = document.getElementById('workerStatsChart').getContext('2d');

    function buildData(data) {
        const tasks = (data.datasets && data.datasets[0]) || { label: 'Tasks Completed', data: [] };

        const taskGradient = ctx.createLinearGradient(0, 0, 0, 400);
        taskGradient.addColorStop(0, 'rgba(76, 175, 80, 0.2)');
        taskGradient.addColorStop(1, 'rgba(76, 175, 80, 0.0)');

        return {
            labels: data.labels || [],
            datasets: [{
                label: tasks.label || 'Tasks Completed',
                data: tasks.data || [],
                backgroundColor: taskGradient,
                borderColor: '#4CAF50',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#4CAF50',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        };
    }

    const chart = new Chart(ctx, {
        type: 'line',
        data: buildData(seed || { labels: [], datasets: [] }),
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            family: "'Poppins', sans-serif",
                            size: 12,
                            weight: '500'
                        },
                        color: '#64748b'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#1e293b',
                    bodyColor: '#64748b',
                    borderColor: 'rgba(0, 0, 0, 0.05)',
                    borderWidth: 1,
                    padding: 12,
                    titleFont: {
                        size: 14,
                        family: "'Poppins', sans-serif",
                        weight: '600'
                    },
                    bodyFont: {
                        size: 13,
                        family: "'Poppins', sans-serif"
                    },
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            family: "'Poppins', sans-serif",
                            size: 12
                        },
                        color: '#64748b',
                        padding: 10
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
                        },
                        color: '#64748b',
                        padding: 10
                    }
                }
            }
        }
    });

    // Handle period filter clicks
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            fetch("{{ route('worker.dashboard.chart-data') }}?period=" + this.dataset.period)
                .then(response => response.json())
                .then(data => {
                    chart.data = buildData(data);
                    chart.update();
                });
        });
    });
});
</script>
@endpush
@endsection