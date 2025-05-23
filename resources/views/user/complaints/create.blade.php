@extends('user.layout')

@section('content')
<div class="complaint-form-container">
    <div class="form-header">
        <h2><i class="fas fa-comment-alt"></i> File a Complaint</h2>
        <p class="text-muted">Please provide details about your complaint below</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.complaints.store') }}" method="POST" class="complaint-form">
        @csrf
        <div class="form-group">
            <label for="subject">Subject <span class="required">*</span></label>
            <input 
                type="text" 
                id="subject" 
                name="subject" 
                class="form-control @error('subject') is-invalid @enderror" 
                value="{{ old('subject') }}"
                required
                placeholder="Brief subject of your complaint">
            @error('subject')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description <span class="required">*</span></label>
            <textarea 
                id="description" 
                name="description" 
                class="form-control @error('description') is-invalid @enderror" 
                rows="5" 
                required
                placeholder="Please provide detailed information about your complaint">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Submit Complaint
            </button>
        </div>
    </form>
</div>

<style>
.complaint-form-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.form-header {
    margin-bottom: 2rem;
    text-align: center;
}

.form-header h2 {
    color: #333;
    margin-bottom: 0.5rem;
}

.complaint-form .form-group {
    margin-bottom: 1.5rem;
}

.complaint-form label {
    font-weight: 500;
    margin-bottom: 0.5rem;
    display: block;
}

.required {
    color: #dc3545;
}

.form-control {
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: 100%;
    transition: border-color 0.15s ease-in-out;
}

.form-control:focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
}

.btn {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    color: white;
}

.btn-secondary {
    background-color: #6c757d;
    border: none;
    color: white;
    text-decoration: none;
}

.alert {
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 4px;
}

.alert-danger {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}
</style>
@endsection