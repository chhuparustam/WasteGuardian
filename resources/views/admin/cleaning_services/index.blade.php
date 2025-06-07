@extends('admin.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/Admin-cleaning-services.css') }}">
@endsection

@section('content')
<div class="main-content">
    <!-- Header Section -->
    <div class="content-header">
        <div class="header-left">
            <h1><i class="fas fa-brush"></i> Cleaning Services</h1>
            <ul class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="active">Cleaning Services</li>
            </ul>
        </div>
        <div class="header-right">
            <a href="{{ route('admin.cleaning-services.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Add Cleaning Service
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Services Grid -->
    <div class="services-grid">
        @forelse($services as $service)
            <div class="service-card">
                <div class="card-image">
                    <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('images/services/default-service.jpg') }}" 
                         alt="{{ $service->title }}" 
                         class="service-image">
                    <div class="price-tag">
                        <span>Rs. {{ number_format($service->price, 2) }}</span>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="service-title">{{ $service->title }}</h3>
                    <div class="service-details">
                        <div class="detail">
                            <i class="fas fa-clock"></i>
                            <span>{{ $service->duration }}</span>
                        </div>
                        <div class="detail">
                            <i class="fas fa-redo"></i>
                            <span>{{ $service->frequency }}</span>
                        </div>
                    </div>
                    <p class="service-description">{{ $service->description }}</p>
                    <div class="card-actions">
                        <a href="{{ route('admin.cleaning-services.edit', $service->id) }}" 
                           class="btn-edit">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <form action="{{ route('admin.cleaning-services.destroy', $service->id) }}" 
                              method="POST" 
                              class="delete-form">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn-delete"
                                    onclick="return confirm('Are you sure you want to delete this service?')">
                                <i class="fas fa-trash"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-brush"></i>
                <h3>No Services Found</h3>
                <p>Start by adding your first cleaning service</p>
            </div>
        @endforelse
    </div>
</div>
@endsection