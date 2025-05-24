@if (!session()->has('driver_logged_in') || !session('driver_logged_in'))
    <script>window.location = "{{ route('driver.login') }}";</script>
@endif

@extends('driver.layout')

@section('content')
    <div class="dashboard-container">
        <!-- Statistics Overview -->
        <div class="stats-overview">
            <div class="stat-card routes">
                <div class="stat-icon">
                    <i class="fas fa-route"></i>
                </div>
                <div class="stat-details">
                    <h3>Assigned Routes</h3>
                    <p>{{ $assignedRoutes ?? '5' }}</p>
                </div>
            </div>

            <div class="stat-card pending">
                <div class="stat-icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-details">
                    <h3>Pending Pickups</h3>
                    <p>{{ $pendingPickups ?? '4' }}</p>
                </div>
            </div>

            <div class="stat-card completed">
                <div class="stat-icon">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="stat-details">
                    <h3>Completed Today</h3>
                    <p>{{ $completedPickups ?? '5' }}</p>
                </div>
            </div>

            <div class="stat-card rating">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-details">
                    <h3>Rating</h3>
                    <p>{{ number_format($rating ?? 4.8, 1) }}<span>/5</span></p>
                </div>
            </div>
        </div>

        <!-- Performance Chart -->
        <div class="chart-section">
            <div class="chart-card">
                <div class="card-header">
                    <h2><i class="fas fa-chart-line"></i> Weekly Performance</h2>
                    <div class="chart-filters">
                        <button class="chart-filter active" data-period="week">Week</button>
                        <button class="chart-filter" data-period="month">Month</button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="quick-actions">
            <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
            <div class="action-buttons">
                <a href="" class="action-btn routes-btn">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>View Routes</span>
                </a>
                <a href="" class="action-btn pickup-btn">
                    <i class="fas fa-truck"></i>
                    <span>Manage Pickups</span>
                </a>
                <a href="" class="action-btn profile-btn">
                    <i class="fas fa-user-edit"></i>
                    <span>Update Profile</span>
                </a>
            </div>
        </div>

        <div class="dashboard-grid">
            <!-- Today's Schedule -->
            <div class="schedule-card">
                <div class="card-header">
                    <h2><i class="fas fa-calendar-day"></i> Today's Schedule</h2>
                    <a href="" class="view-all">View All</a>
                </div>
                <div class="schedule-list">
                    @forelse($todayRoutes ?? [] as $route)
                        <div class="schedule-item">
                            <div class="time-badge">{{'' }}</div>
                            <div class="schedule-content">
                                <h4>{{'Location' }}</h4>
                                <p><i class="fas fa-map-marker-alt"></i> {{ '....' }}</p>
                                <span class="status {{ '' }}">
                                    {{ ucfirst( 'pending') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-calendar-day"></i>
                            <p>No routes scheduled for today</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="activity-card">
                <div class="card-header">
                    <h2><i class="fas fa-history"></i> Recent Activity</h2>
                </div>
                <div class="activity-list">
                    @forelse($recentActivities ?? [] as $activity)
                        <div class="activity-item">
                            <div class="activity-icon {{ '' }}">
                                <i class="fas {{ 'fa-info-circle' }}"></i>
                            </div>
                            <div class="activity-details">
                                <p>{{ 'Descriptoin' }}</p>
                                <span class="activity-time">
                                    <i class="far fa-clock"></i> 
                                    {{ '' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-history"></i>
                            <p>No recent activities</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('performanceChart').getContext('2d');
        
        // Create gradient for the chart
        const pickupsGradient = ctx.createLinearGradient(0, 0, 0, 400);
        pickupsGradient.addColorStop(0, 'rgba(76, 175, 80, 0.1)');
        pickupsGradient.addColorStop(1, 'rgba(76, 175, 80, 0.02)');
        
        const hoursGradient = ctx.createLinearGradient(0, 0, 0, 400);
        hoursGradient.addColorStop(0, 'rgba(33, 150, 243, 0.1)');
        hoursGradient.addColorStop(1, 'rgba(33, 150, 243, 0.02)');

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Pickups Completed',
                    data: [12, 15, 13, 14, 16, 11, 13],
                    backgroundColor: pickupsGradient,
                    borderColor: '#4CAF50',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#4CAF50',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }, {
                    label: 'Hours Worked',
                    data: [8, 7, 8, 6, 8, 7, 8],
                    backgroundColor: hoursGradient,
                    borderColor: '#2196F3',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2196F3',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
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
                                size: 12
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5],
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Handle chart filter buttons
        document.querySelectorAll('.chart-filter').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelector('.chart-filter.active').classList.remove('active');
                this.classList.add('active');
                // Add your filter logic here
            });
        });
    });
</script>
@endpush