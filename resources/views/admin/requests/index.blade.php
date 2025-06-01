@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-requests.css') }}">

<div class="manage-requests-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="fas fa-clipboard-list"></i>
            Manage Requests
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

    <!-- Requests Table Card -->
    <div class="card">
        <div class="card-header">
            <div class="header-content">
                <h2>Request List</h2>
                <div class="header-actions">
                    <!-- Search Bar -->
                    <div class="search-wrapper">
                        <form action="{{ route('admin.requests.index') }}" method="GET" class="search-form">
                            <input type="text" 
                                   name="search" 
                                   placeholder="Search requests..."
                                   value="{{ request('search') }}"
                                   class="search-input">
                            <button type="submit" class="search-btn" title="Search">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.requests.index') }}" class="clear-search" title="Clear">
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
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Nearest Landmark</th>
                        <th>Photo</th>
                        <th>Message</th>
                        <th>Requested At</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->address }}</td>
                            <td>{{ $request->landmark }}</td>
                            <td class="photo-cell">
                                @if($request->photo)
                                    <img src="{{ asset('storage/' . $request->photo) }}" 
                                         alt="Request Photo"
                                         class="request-photo">
                                @else
                                    <span class="no-photo">No Photo</span>
                                @endif
                            </td>
                            <td>{{ $request->message }}</td>
                            <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" 
                                       class="btn-view" 
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" 
                                       class="btn-update" 
                                       title="Edit Request">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.requests.destroy', $request->id) }}" 
                                          method="POST" 
                                          class="delete-form"
                                          onsubmit="return confirm('Are you sure you want to delete this request?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Delete Request">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-clipboard-list"></i>
                                    <p>
                                        @if(request('search'))
                                            No requests found matching "{{ request('search') }}"
                                        @else
                                            No requests available
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($requests->hasPages())
                <div class="pagination-wrapper">
                    {{ $requests->appends(request()->all())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
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
