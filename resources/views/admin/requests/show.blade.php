@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Admin-view-requests.css') }}">

<div class="manage-requests-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="fas fa-clipboard-list"></i>
            Request Details
        </h1>
        <div class="header-actions">
            <a href="{{ route('admin.requests.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to Requests
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

    <!-- Request Details Card -->
    <div class="card">
        <div class="card-header">
            <h2>Request #{{ $request->id }}</h2>
            <span class="request-status {{ $request->driver_id ? 'assigned' : 'pending' }}">
                {{ $request->driver_id ? 'Assigned' : 'Pending Assignment' }}
            </span>
        </div>
        
        <div class="card-body">
            <div class="details-grid">
                <div class="detail-item">
                    <label>User Name</label>
                    <span>{{ $request->name }}</span>
                </div>
                
                <div class="detail-item">
                    <label>Address</label>
                    <span>{{ $request->address }}</span>
                </div>
                
                <div class="detail-item">
                    <label>Nearest Landmark</label>
                    <span>{{ $request->landmark }}</span>
                </div>
                
                <div class="detail-item">
                    <label>Requested At</label>
                    <span>{{ $request->created_at->format('Y-m-d H:i') }}</span>
                </div>
                
                <div class="detail-item full-width">
                    <label>Message</label>
                    <span>{{ $request->message }}</span>
                </div>
                
                @if($request->photo)
                <div class="detail-item full-width">
                    <label>Photo of Waste</label>
                    <div class="photo-wrapper">
                        <img src="{{ asset('storage/' . $request->photo) }}"
                             alt="Request Photo"
                             class="request-photo"
                             id="request-photo"
                             style="cursor:pointer; max-width: 120px; max-height: 120px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    </div>
                </div>

                <!-- Modal for fullscreen photo -->
                <div id="photo-modal" class="photo-modal">
                    <span class="close-modal" id="close-modal">&times;</span>
                    <img class="modal-content" id="modal-img">
                </div>
                @endif
            </div>

            <!-- Driver Assignment Section -->
            <div class="assignment-section">
                <h3>Driver Assignment</h3>
                <form action="{{ route('admin.requests.assignDriver', $request->id) }}" 
                      method="POST" 
                      class="assignment-form">
                    @csrf
                    <div class="form-group">
                        <label for="driver_id">Select Driver</label>
                        <select name="driver_id" 
                                id="driver_id" 
                                class="form-select" 
                                required>
                            <option value="">Choose a driver...</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" 
                                        {{ $request->driver_id == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-user-check"></i>
                        Assign Driver
                    </button>
                </form>
            </div>
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

    // Photo modal functionality
    const photoLink = document.getElementById('photo-link');
    const photoModal = document.getElementById('photo-modal');
    const modalImg = document.getElementById('modal-img');
    const closeModal = document.getElementById('close-modal');

    if (photoLink) {
        photoLink.addEventListener('click', function(e) {
            e.preventDefault();
            const imgSrc = this.querySelector('img').src;
            modalImg.src = imgSrc;
            photoModal.style.display = 'flex';
        });
    }

    if (closeModal) {
        closeModal.addEventListener('click', function() {
            photoModal.style.display = 'none';
        });
    }

    // Close modal when clicking outside of the image
    window.addEventListener('click', function(event) {
        if (event.target == photoModal) {
            photoModal.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection