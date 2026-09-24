@if (!session()->has('admin_logged_in') || !session('admin_logged_in'))
    <script>window.location = "{{ route('admin.login') }}";</script>
@endif
    
@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Welcome Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome back! Here's what's happening with your system today.</p>
    </div>

    <!-- Top Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Dynamic user count preserved --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $userCount ?? '120' }}</p>
                   
                </div>
                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Dynamic driver count preserved --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Drivers</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $driverCount ?? '25' }}</p>
                   
                </div>
                <div class="w-12 h-12 bg-teal-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-truck text-white text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Dynamic worker count preserved --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Complaints</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $complaintCount ?? '10' }}</p>
                    
                </div>
                <div class="w-12 h-12 bg-indigo-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-hard-hat text-white text-xl"></i>
                </div>
            </div>
        </div>


        {{-- Dynamic request count preserved --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Requests</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $requestCount ?? '75' }}</p>
                  
                </div>
                <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clipboard-list text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- User Profile Card (Left) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-r from-teal-500 to-blue-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-user-shield text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Chhuparustam Kushwaha</h3>
                <p class="text-gray-600 mb-4">@administrator</p>
                
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <div class="flex items-center justify-center space-x-2 text-gray-700">
                        <i class="fas fa-envelope text-teal-500"></i>
                        <span class="text-sm">admin@wasteguardian.com</span>
                    </div>
                </div>
                
                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-500 to-blue-500 text-white rounded-lg text-sm font-medium">
                    <i class="fas fa-crown mr-2"></i>
                    Admin
                </div>
            </div>
        </div>

        <!-- Financial Overview Card (Right) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900">
                    <i class="fas fa-dollar-sign text-green-500 mr-2"></i>
                    Financial Overview
                </h3>
                <button class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-chart-line"></i>
                </button>
            </div>
            
            <!-- Revenue Stats -->
            <div class="space-y-4 mb-6">
                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border border-green-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-arrow-up text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Monthly Revenue</p>
                            <p class="text-xl font-bold text-gray-900">₹{{ number_format($monthlyRevenue ?? 0) }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-green-600 font-medium">This Month</p>
                        <p class="text-xs text-gray-500">paid bookings</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-wallet text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Earnings</p>
                            <p class="text-xl font-bold text-gray-900">₹{{ number_format($totalEarnings ?? 0) }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-blue-600 font-medium">All Time</p>
                        <p class="text-xs text-gray-500">paid bookings</p>
                    </div>
                </div>
            </div>
            
            <!-- Financial Breakdown -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">Service Fees</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">₹{{ number_format($serviceFees ?? 0) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">Paid Bookings</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">₹{{ number_format($earning ?? 0) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">Total Booked Value</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">₹{{ number_format($balance ?? 0) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Analytics -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="mb-6">
            <h3 class="text-xl font-bold text-gray-900">Today's Analytics</h3>
            <p class="text-gray-600">Statistics for {{ date('d-m-Y') }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">New Bookings</p>
                        <p class="text-3xl font-bold">{{ $todayBookings ?? 0 }}</p>
                    </div>
                    <i class="fas fa-money-bill text-2xl text-blue-200"></i>
                </div>
                <div class="mt-4 bg-blue-400/30 rounded-full h-1">
                    <div class="bg-white h-1 rounded-full" style="width: 75%"></div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm">New Requests</p>
                        <p class="text-3xl font-bold">{{ $todayRequests ?? 0 }}</p>
                    </div>
                    <i class="fas fa-clipboard-list text-2xl text-purple-200"></i>
                </div>
                <div class="mt-4 bg-purple-400/30 rounded-full h-1">
                    <div class="bg-white h-1 rounded-full" style="width: 60%"></div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm">New Users</p>
                        <p class="text-3xl font-bold">{{ $todayUsers ?? 0 }}</p>
                    </div>
                    <i class="fas fa-user-plus text-2xl text-emerald-200"></i>
                </div>
                <div class="mt-4 bg-emerald-400/30 rounded-full h-1">
                    <div class="bg-white h-1 rounded-full" style="width: 40%"></div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-rose-500 to-rose-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-rose-100 text-sm">Complaints</p>
                        <p class="text-3xl font-bold">{{ $todayComplaints ?? 0 }}</p>
                    </div>
                    <i class="fas fa-heart text-2xl text-rose-200"></i>
                </div>
                <div class="mt-4 bg-rose-400/30 rounded-full h-1">
                    <div class="bg-white h-1 rounded-full" style="width: 20%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Charts -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">
                <i class="fas fa-chart-area text-teal-500 mr-2"></i>
                Analytics
            </h3>
            <div class="flex items-center space-x-2" id="chartPeriodFilters">
                <button class="chart-period px-4 py-2 rounded-lg text-sm bg-teal-500 text-white" data-period="week">Week</button>
                <button class="chart-period px-4 py-2 rounded-lg text-sm bg-white border border-gray-200 text-gray-600 hover:bg-gray-50" data-period="month">Month</button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm font-semibold text-gray-700 mb-3">
                    <i class="fas fa-truck-loading text-teal-500 mr-2"></i>Requests Trend
                </p>
                <div class="relative" style="height: 260px;">
                    <canvas id="requestsChart"></canvas>
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm font-semibold text-gray-700 mb-3">
                    <i class="fas fa-chart-pie text-teal-500 mr-2"></i>Requests by Status
                </p>
                <div class="relative" style="height: 260px;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-xl p-4 mt-6">
            <p class="text-sm font-semibold text-gray-700 mb-3">
                <i class="fas fa-dollar-sign text-teal-500 mr-2"></i>Revenue Flow
            </p>
            <div class="relative" style="height: 240px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var seed = @json($chartData ?? null) || { labels: [], datasets: [], statusBreakdown: {} };
    var requestsChart = null;
    var statusChart = null;
    var revenueChart = null;

    function lineData(data, datasetIndex, colors) {
        return {
            labels: data.labels || [],
            datasets: (data.datasets || []).map(function(ds, i) {
                var palette = colors[i % colors.length];
                return {
                    label: ds.label,
                    data: ds.data,
                    backgroundColor: palette.bg,
                    borderColor: palette.border,
                    tension: 0.4,
                    fill: true
                };
            })
        };
    }

    var palettes = [
        { bg: 'rgba(76, 175, 80, 0.1)', border: '#4CAF50' },
        { bg: 'rgba(33, 150, 243, 0.1)', border: '#2196F3' },
        { bg: 'rgba(156, 39, 176, 0.1)', border: '#9C27B0' }
    ];

    if (window.Chart) {
        requestsChart = new Chart(document.getElementById('requestsChart'), {
            type: 'line',
            data: lineData(seed, 0, palettes),
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { usePointStyle: true, padding: 20, font: { size: 12 } } }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });

        statusChart = new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(seed.statusBreakdown || {}),
                datasets: [{
                    data: Object.values(seed.statusBreakdown || {}),
                    backgroundColor: ['#f59e0b', '#3b82f6', '#8b5cf6', '#14b8a6', '#4CAF50', '#ef4444', '#64748b']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'right', labels: { usePointStyle: true, padding: 15, font: { size: 12 } } } }
            }
        });

        revenueChart = new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: (seed.labels || []),
                datasets: [{
                    label: 'Revenue',
                    data: (seed.datasets && seed.datasets[2] ? seed.datasets[2].data : []),
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderColor: '#10B981',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });

        document.querySelectorAll('.chart-period').forEach(function(button) {
            button.addEventListener('click', function() {
                document.querySelectorAll('.chart-period').forEach(function(b) {
                    b.className = 'chart-period px-4 py-2 rounded-lg text-sm bg-white border border-gray-200 text-gray-600 hover:bg-gray-50';
                });
                this.className = 'chart-period px-4 py-2 rounded-lg text-sm bg-teal-500 text-white';

                fetch("{{ route('admin.dashboard.chart-data') }}?period=" + this.dataset.period)
                    .then(function(response) { return response.json(); })
                    .then(function(data) {
                        requestsChart.data = lineData(data, 0, palettes);
                        requestsChart.update();

                        statusChart.data.labels = Object.keys(data.statusBreakdown || {});
                        statusChart.data.datasets[0].data = Object.values(data.statusBreakdown || {});
                        statusChart.update();

                        revenueChart.data.labels = data.labels || [];
                        revenueChart.data.datasets[0].data = (data.datasets && data.datasets[2] ? data.datasets[2].data : []);
                        revenueChart.update();
                    });
            });
        });
        });
    }
});
</script>
@endsection