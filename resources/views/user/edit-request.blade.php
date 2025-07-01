@extends('user.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/request-form.css') }}">
<div class="request-container">
    <div class="request-form-wrapper">
        <div class="form-header">
            <h2><i class="fas fa-trash-restore"></i> Edit Request</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('user.my-requests-update', $request->id) }}" method="POST" enctype="multipart/form-data" class="request-form">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" 
                    value='{{ auth()->user()->fullName ?? "" }}'  readonly>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Pickup Address</label>
                <input type="text" id="address" name="address" class="form-control" 
                    placeholder="Enter complete address" value="{{ auth()->user()->address ?? ''}}" required>
            </div>

            <div class="form-group">
                <label for="landmark" class="form-label">Nearest Landmark</label>
                <input type="text" id="landmark" name="landmark" class="form-control" 
                    placeholder="Enter a nearby landmark" required value="{{ $request->landmark ?? '' }}">
            </div>

            <div class="form-group">
                <label for="photo" class="form-label">Waste Photo</label>
                @if ($request->photo)
                    <div class="current-photo-preview">
                        <p>Current Photo:</p>
                        <img src="{{ asset('storage/' . $request->photo) }}" alt="Current Waste Photo" style="max-width: 200px; height: auto; margin-bottom: 10px;">
                    </div>
                @endif
                <div class="file-input-wrapper">
                    <input type="file" id="photo" name="photo" class="form-control" 
                        accept="image/*" >
                    <small class="form-text">Upload a clear photo of the waste (Max: 5MB)</small>
                </div>
            </div>

            <div class="form-group">
                <label for="message" class="form-label optional">Additional Notes</label>
                <textarea id="message" name="message" class="form-control" 
                    rows="3" placeholder="Any special instructions...">{{ $request->message ?? '' }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-submit">
                    <i class="fas fa-paper-plane"></i> Submit Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection