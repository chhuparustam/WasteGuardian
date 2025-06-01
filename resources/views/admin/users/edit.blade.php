@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/edit-user.css') }}">

<div class="edit-user-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="fas fa-user-edit"></i>
            Update User
        </h1>
        <a href="{{ route('admin.users.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Back to Users
        </a>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                <h4>Please fix the following errors:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Edit Form Card -->
    <div class="card">
        <div class="card-header">
            <h2>User Information</h2>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="fullName">
                        <i class="fas fa-user"></i>
                        Full Name
                    </label>
                    <input type="text" name="fullName" id="fullName" value="{{ $user->fullName }}" required>
                    @error('fullName')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email Address
                    </label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">
                        <i class="fas fa-map-marker-alt"></i>
                        Address
                    </label>
                    <input type="text" name="address" id="address" value="{{ $user->address }}" required>
                    @error('address')
                        <span class="error-message">{{ $message }}</span>
                    @enderror  
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i>
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection