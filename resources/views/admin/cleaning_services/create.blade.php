@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/create-service.css') }}">
<div class="create-service-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="fas fa-brush"></i>
            Add New Service
        </h1>
        <a href="{{ route('admin.cleaning-services.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Back to Services
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

    <!-- Create Form Card -->
    <div class="card">
        <div class="card-header">
            <h2>Service Information</h2>
        </div>
        
        <div class="card-body">
            <form action="{{ route('admin.cleaning-services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="title">
                            <i class="fas fa-tag"></i>
                            Service Title
                        </label>
                        <input type="text" 
                               id="title"
                               name="title" 
                               value="{{ old('title') }}" 
                               placeholder="Enter service title"
                               required>
                        @error('title')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">
                            <i class="fas fa-money-bill"></i>
                            Price (Rs.)
                        </label>
                        <input type="number" 
                               id="price"
                               name="price" 
                               value="{{ old('price') }}"
                               step="0.01"
                               placeholder="Enter service price"
                               required>
                        @error('price')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="duration">
                            <i class="fas fa-clock"></i>
                            Duration
                        </label>
                        <input type="text" 
                               id="duration"
                               name="duration" 
                               value="{{ old('duration') }}"
                               placeholder="e.g., 2 hours"
                               required>
                        @error('duration')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="frequency">
                            <i class="fas fa-redo"></i>
                            Frequency
                        </label>
                        <select id="frequency" 
                                name="frequency" 
                                required>
                            <option value="">Select frequency</option>
                            <option value="One-time">One-time</option>
                            <option value="Daily">Daily</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Monthly">Monthly</option>
                        </select>
                        @error('frequency')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="description">
                        <i class="fas fa-align-left"></i>
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              placeholder="Enter service description"
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">
                        <i class="fas fa-image"></i>
                        Service Image
                    </label>
                    <div class="file-upload">
                        <input type="file" 
                               id="image"
                               name="image" 
                               accept="image/*"
                               class="file-input">
                        <label for="image" class="file-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Choose an image...</span>
                        </label>
                    </div>
                    @error('image')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-plus"></i>
                        Add Service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection