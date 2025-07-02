@extends('user.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Cleaning-services.css') }}">
<div class="content-wrapper">
    <!-- Page Header -->
    <div class="content-header">
        <h1>
            <i class="fas fa-broom"></i>
            Cleaning Services
        </h1>
    </div>

    <!-- Services Grid -->
    <div class="services-grid">
        @foreach($services as $service)
            <div class="service-card">
                <div class="card-image">
                    <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('images/services/default-service.jpg') }}" 
                         alt="{{ $service->title }}" class="card-image primary">
                    <div class="price-badge">
                        <i class="fas fa-tag"></i>
                        <span>Rs. {{ $service->price }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <h3>{{ $service->title }}</h3>
                    <div class="service-info">
                        <span class="duration">
                            <i class="fas fa-clock"></i>
                            {{ $service->duration }}
                        </span>
                        <span class="frequency">
                            <i class="fas fa-redo"></i>
                            {{ $service->frequency }}
                        </span>
                    </div>
                    <p class="service-description">
                        {{ $service->description }}
                    </p>
                    <a href="{{ route('user.services.show', $service->id) }}" 
                       class="btn-book">
                        View Details & Book
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection