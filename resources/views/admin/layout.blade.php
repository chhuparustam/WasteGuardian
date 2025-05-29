<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WasteGuardian - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'custom-teal': '#14b8a6',
                        'custom-blue': '#3b82f6',
                        'custom-indigo': '#6366f1',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">

<!-- Header -->
<div class="bg-gradient-to-r from-teal-500 to-blue-600 shadow-lg">
    <div class="px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                </div>
                <div>
                    <h1 class="text-white text-xl font-bold">Admin Panel</h1>
                    <p class="text-teal-100 text-sm">WasteGuardian Dashboard</p>
                </div>
            </div>
        </div>
        
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3 bg-white/10 rounded-lg px-4 py-2">
                <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-teal-600 text-sm"></i>
                </div>
                <div class="text-white">
                    <p class="font-semibold text-sm">Chhuparustam kushwaha</p>
                    <p class="text-teal-100 text-xs">Administrator</p>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-gradient-to-b from-slate-800 to-slate-900 shadow-xl">
        <div class="p-6">
            <a href="{{ url('/') }}" target="_blank" class="flex items-center space-x-3 text-white hover:text-teal-300 transition-colors">
                <div class="w-8 h-8 bg-gradient-to-r from-teal-500 to-blue-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-leaf text-white text-sm"></i>
                </div>
                <h2 class="text-lg font-bold">WasteGuardian</h2>
            </a>
        </div>

        <div class="px-4 pb-6">
            <div class="space-y-2">
                <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider px-3 mb-3">MAIN MENU</p>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-3 text-white bg-gradient-to-r from-teal-500 to-blue-500 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200">
                    <i class="fas fa-home w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider px-3 mt-6 mb-3">MANAGEMENT</p>
                
                <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-3 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-users w-5"></i>
                    <span class="font-medium">Manage Users</span>
                </a>
                
                <a href="{{ route('admin.drivers.index') }}" class="flex items-center space-x-3 px-3 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-truck w-5"></i>
                    <span class="font-medium">Manage Drivers</span>
                </a>
                
                <a href="{{ route('admin.workers.index') }}" class="flex items-center space-x-3 px-3 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-hard-hat w-5"></i>
                    <span class="font-medium">Manage Workers</span>
                </a>
                
                <a href="{{ route('admin.requests.index') }}" class="flex items-center space-x-3 px-3 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-clipboard-list w-5"></i>
                    <span class="font-medium">Manage Requests</span>
                </a>
                 <a href="" class="flex items-center space-x-3 px-3 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                     <i class="fas fa-money-check-dollar w-5"></i>
                        <span class="font-medium">Payments</span>
                </a>
                                    
                <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider px-3 mt-6 mb-3">SUPPORT</p>
                
                <a href="" class="flex items-center space-x-3 px-3 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-exclamation-circle w-5"></i>
                    <span class="font-medium">Complaints</span>
                </a>
                
                <a href="" class="flex items-center space-x-3 px-3 py-3 text-slate-300 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-all duration-200 mt-4">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="font-medium">Logout</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 bg-gray-50">
        @yield('content') {{-- Blade section preserved --}}
    </div>
</div>

</body>
</html>