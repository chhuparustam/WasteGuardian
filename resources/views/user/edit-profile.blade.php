@extends('user.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/edit-profile.css') }}">

<div class="profile-container">
    <div class="profile-form-wrapper">
        <div class="form-header">
            <h2><i class="fas fa-user-edit"></i> Edit Profile</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('user.update-profile') }}" method="POST" class="edit-profile-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" id="fullName" name="fullName" class="form-control" 
                    value="{{ old('fullName', $user->fullName) }}" required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" 
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control" 
                    rows="3" required>{{ old('address', $user->address) }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-submit">
                    <i class="fas fa-save"></i> Update Profile
                </button>
                <a href="{{ route('user.dashboard') }}" class="btn btn-cancel">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
