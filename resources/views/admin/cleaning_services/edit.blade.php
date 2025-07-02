@extends('admin.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/edit-service.css') }}">
@endsection

@section('content')
<div class="main-content">
    <!-- Header Section -->
    <div class="content-header">
        <div class="header-left">
            <h1><i class="fas fa-brush"></i> Edit Cleaning Service</h1>
            <ul class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.cleaning-services.index') }}">Cleaning Services</a></li>
                <li class="active">Edit Service</li>
            </ul>
        </div>
        <div class="header-right">
            <a href="{{ route('admin.cleaning-services.index') }}" class="btn-add">
                <i class="fas fa-arrow-left"></i> Back to Services
            </a>
        </div>
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
    <div class="service-card" style="max-width:500px;margin:auto;">
        <div class="card-image">
            <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('images/services/default-service.jpg') }}" 
                 alt="{{ $service->title }}" 
                 class="service-image">
            <div class="price-tag">
                <span>Rs. {{ number_format($service->price, 2) }}</span>
            </div>
        </div>
        <div class="card-content">
            <form action="{{ route('admin.cleaning-services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title"><i class="fas fa-tag"></i> Service Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required>
                </div>

                <div class="form-group">
                    <label for="price"><i class="fas fa-money-bill"></i> Price (Rs.)</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $service->price) }}" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="duration"><i class="fas fa-clock"></i> Duration</label>
                    <input type="text" id="duration" name="duration" value="{{ old('duration', $service->duration) }}" required>
                </div>

                <div class="form-group">
                    <label for="frequency"><i class="fas fa-redo"></i> Frequency</label>
                    <select id="frequency" name="frequency" required>
                        <option value="">Select frequency</option>
                        <option value="One-time" {{ old('frequency', $service->frequency) == 'One-time' ? 'selected' : '' }}>One-time</option>
                        <option value="Daily" {{ old('frequency', $service->frequency) == 'Daily' ? 'selected' : '' }}>Daily</option>
                        <option value="Weekly" {{ old('frequency', $service->frequency) == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="Monthly" {{ old('frequency', $service->frequency) == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description"><i class="fas fa-align-left"></i> Description</label>
                    <textarea id="description" name="description" rows="3" required>{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image"><i class="fas fa-image"></i> Change Image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>

                <div class="card-actions" style="border:none;padding-top:1rem;">
                    <button type="submit" class="btn-edit">
                        <i class="fas fa-save"></i> Update Service
                    </button>
                    <a href="{{ route('admin.cleaning-services.index') }}" class="btn-delete" style="text-decoration:none;">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection