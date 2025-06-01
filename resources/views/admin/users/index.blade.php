@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">

<div class="manage-users-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="fas fa-users"></i>
            Manage Users
        </h1>
        <div class="header-actions">
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

    <!-- Users Table Card -->
    <div class="card">
        <div class="card-header">
            <div class="header-content">
                <h2>User List</h2>
                <div class="header-actions">
                    <!-- Search Bar -->
                    <div class="search-wrapper">
                        <form action="{{ route('admin.users.index') }}" method="GET" class="search-form">
                            <input type="text" 
                                   name="search" 
                                   placeholder="Search users..."
                                   value="{{ request('search') }}"
                                   class="search-input">
                            <button type="submit" class="search-button">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.users.index') }}" class="clear-search">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th> 
                    </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->fullName }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-update">
                                    <i class="fas fa-edit"></i>
                                    <span>Update</span>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" 
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            @if(request('search'))
                                No users found matching "{{ request('search') }}"
                            @else
                                No users found
                            @endif
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            @if($users->hasPages())
                <div class="pagination-wrapper">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Close alert message
    document.querySelectorAll('.close-alert').forEach(button => {
        button.addEventListener('click', () => {
            button.closest('.alert').remove();
        });
    });
</script>
@endsection