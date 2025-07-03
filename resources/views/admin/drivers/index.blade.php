@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-drivers.css') }}">

<div class="manage-drivers-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="fas fa-truck"></i>
            Manage Drivers
        </h1>
        <div class="header-actions">
            <a href="{{ route('admin.drivers.create') }}" class="btn-primary">
                <i class="fas fa-plus"></i>
                Add Driver
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="close-alert">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Drivers Table Card -->
    <div class="card">
        <div class="card-header">
            <div class="header-content">
                <h2>Driver List</h2>
                <div class="header-actions">
                    <!-- Search Bar -->
                    <div class="search-wrapper">
                        <form action="{{ route('admin.drivers.index') }}" method="GET" class="search-form">
                            <input type="text" 
                                   name="search" 
                                   placeholder="Search drivers..."
                                   value="{{ request('search') }}"
                                   class="search-input">
                            <button type="submit" class="search-btn" title="Search">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.drivers.index') }}" class="clear-search" title="Clear">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Driver Name</th>
                        <th>Email</th>
                        <th>Phone No.</th>
                        <th>Address</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($drivers as $driver)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <span>{{ $driver->fullName }}</span>
                                </div>
                            </td>
                            <td>{{ $driver->email }}</td>
                            <td>{{ $driver->phone }}</td>
                            <td>{{ $driver->address }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.drivers.edit', $driver->id) }}" 
                                       class="btn-update" 
                                       title="Edit Driver">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                    <form action="{{ route('admin.drivers.destroy', $driver->id) }}" 
                                          method="POST" 
                                          class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn-delete" 
                                                onclick="return confirm('Are you sure you want to delete this driver?')"
                                                title="Delete Driver">
                                            <i class="fas fa-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="empty-state">
                                    <i class="fas fa-truck"></i>
                                    <p>
                                        @if(request('search'))
                                            No drivers found matching "{{ request('search') }}"
                                        @else
                                            No drivers available
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($drivers->hasPages())
                <div class="pagination-wrapper">
                    {{ $drivers->appends(request()->all())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Close alert message
    const alertClose = document.querySelector('.close-alert');
    if (alertClose) {
        alertClose.addEventListener('click', function() {
            this.closest('.alert').remove();
        });
    }
});
</script>
@endpush
@endsection
