@extends('user.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user-profile.css') }}">
<div class="profile-section">
    <div class="profile-card">
        <div class="profile-sidebar">
            <div class="profile-image">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="profile-actions">
                <a href="{{ route('user.edit-profile') }}" class="btn btn-edit">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>
            </div>
        </div>

        <div class="profile-details">
            <div class="profile-header">
                <h2>{{ $user->fullName }}</h2>
                <span class="profile-status active">
                    <i class="fas fa-circle"></i> Active
                </span>
            </div>

            <div class="profile-stats">
                <div class="stat-card">
                    <i class="fas fa-recycle"></i>
                    <div class="stat-info">
                        <span class="stat-label">Total Requests</span>
                        <span class="stat-value">{{ $totalRequests ?? 9 }}</span>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-check-circle"></i>
                    <div class="stat-info">
                        <span class="stat-label">Completed</span>
                        <span class="stat-value">{{ $completedRequests ?? 6 }}</span>
                    </div>
                </div>
            </div>

            <div class="profile-info">
                <div class="info-group">
                    <span class="info-label"><i class="fas fa-envelope"></i> Email</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>

                <div class="info-group">
                    <span class="info-label"><i class="fas fa-phone"></i> Phone</span>
                    <span class="info-value {{ !$user->phone ? 'not-provided' : '' }}">{{ $user->phone ?? 'Not provided' }}</span>
                </div>

                <div class="info-group">
                    <span class="info-label"><i class="fas fa-map-marker-alt"></i> Address</span>
                    <span class="info-value {{ !$user->address ? 'not-provided' : '' }}">{{ $user->address ?? 'Not provided' }}</span>
                </div>

                <div class="info-group">
                    <span class="info-label"><i class="fas fa-clock"></i> Member Since</span>
                    <span class="info-value">{{ $user->created_at->format('D F Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection