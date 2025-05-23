@extends('worker.layout')

@section('content')
<div class="dashboard-container">
    <h2>Update Profile</h2>
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('worker.edit-profile.update') }}" enctype="multipart/form-data" class="profile-form">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $worker->name) }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $worker->email) }}" required>
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phone" value="{{ old('phone', $worker->phone) }}">
        </div>
        <div class="form-group">
            <label>Profile Picture</label>
            @if($worker->profile_picture)
                <img src="{{ asset($worker->profile_picture) }}" alt="Profile Picture" style="width:80px;height:80px;border-radius:50%;margin-bottom:10px;">
            @endif
            <input type="file" name="profile_picture" accept="image/*">
        </div>
        <button type="submit" class="action-btn profile-btn">
            <i class="fas fa-save"></i> Save Changes
        </button>
    </form>
</div>
@endsection