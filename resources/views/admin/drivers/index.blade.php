@extends('admin.layout')
<link rel="stylesheet" href="{{ asset('css/manage-drivers.css') }}">

@section('content')
<div class="manage-drivers-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="fas fa-truck"></i>
            Manage Drivers
        </h1>
        <a href="{{ route('admin.drivers.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            Add Driver
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="close-alert">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Drivers Table Card -->
    <div class="card">
        <div class="card-header">
            <h2>List of Drivers</h2>
            <div class="card-tools">
                <input type="text" class="search-input" placeholder="Search drivers...">
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
                            <td>{{ $driver->id }}</td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>{{ $driver->name }}</span>
                                </div>
                            </td>
                            <td>{{ $driver->email }}</td>
                            <td>{{ $driver->phone }}</td>
                            <td>{{ $driver->address }}</td>
                            <td>
                                <div class="action-buttons"></div>
                                    <a href="{{ route('admin.drivers.edit', $driver->id) }}" 
                                       class="btn-update" 
                                       title="Edit Driver">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.drivers.destroy', $driver->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirmDelete()" 
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Delete Driver">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8">
                                <div class="empty-state">
                                    <i class="fas fa-truck text-gray-400 text-5xl mb-4"></i>
                                    <p class="text-gray-500">No drivers found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this driver?');
}

// Close alert message
document.addEventListener('DOMContentLoaded', function() {
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
