<!-- resources/views/admin/drivers/edit.blade.php -->
@extends('admin.layout')
<link rel="stylesheet" href="{{ asset('css/edit-drivers.css') }}">

@section('content')
<div class="edit-driver-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="fas fa-user-edit"></i>
            Update Driver Information
        </h1>
        <a href="{{ route('admin.drivers.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Back to Drivers
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
            <h2>Driver Details</h2>
        </div>
        
        <div class="card-body">
            <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="fullName">
                            <i class="fas fa-user"></i>
                            Driver's Name
                        </label>
                        <input type="text" 
                               id="fullName"
                               name="fullName" 
                               value="{{ old('fullName', $driver->fullName) }}" 
                               placeholder="Enter driver's full name"
                               required>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            Email Address
                        </label>
                        <input type="email" 
                               id="email"
                               name="email" 
                               value="{{ old('email', $driver->email) }}"
                               placeholder="Enter email address"
                               required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">
                            <i class="fas fa-phone"></i>
                            Phone Number
                        </label>
                        <input type="tel" 
                               id="phone"
                               name="phone" 
                               value="{{ old('phone', $driver->phone) }}"
                               placeholder="Enter phone number"
                               required>
                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">
                            <i class="fas fa-location-dot"></i>
                            Address
                        </label>
                        <input type="text" 
                               id="address"
                               name="address" 
                               value="{{ old('address', $driver->address) }}"
                               placeholder="Enter complete address"
                               required>
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i>
                        Update Driver
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
