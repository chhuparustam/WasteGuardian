@extends('user.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/service-detail.css') }}">

<div class="service-detail-wrapper">
    <!-- Breadcrumb Navigation -->
    <div class="breadcrumb-nav">
        <a href="{{ route('user.services.index') }}" class="breadcrumb-link">
            <i class="fas fa-arrow-left"></i>
            Back to Services
        </a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">{{ $service->title }}</span>
    </div>

    <!-- Service Detail Card -->
    <div class="service-detail-card">
        <!-- Service Hero Section -->
        <div class="service-hero">
            <div class="service-image-container">
                <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('images/services/default-service.jpg') }}" 
                     alt="{{ $service->title }}" class="service-detail-image">
                <div class="service-badge">
                    <i class="fas fa-star"></i>
                    <span>Premium Service</span>
                </div>
            </div>
            <div class="service-info">
                <h1 class="service-title">{{ $service->title }}</h1>
                <div class="service-price">
                    <span class="price-label">Starting from</span>
                    <span class="price-amount">Rs. {{ number_format($service->price, 2) }}</span>
                </div>
                <div class="service-meta">
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span class="meta-label">Duration</span>
                        <span class="meta-value">{{ $service->duration }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-redo"></i>
                        <span class="meta-label">Frequency</span>
                        <span class="meta-value">{{ $service->frequency }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-check-circle"></i>
                        <span class="meta-label">Status</span>
                        <span class="meta-value status-available">Available</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Description -->
        <div class="service-description-section">
            <h3><i class="fas fa-info-circle"></i> Service Description</h3>
            <p class="service-description">{{ $service->description }}</p>
        </div>

        <!-- Service Features -->
        <div class="service-features">
            <h3><i class="fas fa-list-check"></i> What's Included</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>Insured & Bonded</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-users"></i>
                    <span>Professional Staff</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-leaf"></i>
                    <span>Eco-friendly Products</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-clock"></i>
                    <span>Flexible Scheduling</span>
                </div>
            </div>
        </div>

        <!-- Booking Section -->
        <div class="booking-section">
            <h3><i class="fas fa-calendar-check"></i> Book This Service</h3>
            <div class="booking-container">
                <div class="booking-info">
                    <div class="price-summary">
                        <span class="price-text">Total Price</span>
                        <span class="price-final">Rs. {{ number_format($service->price, 2) }}</span>
                    </div>
                    <p class="booking-note">
                        <i class="fas fa-info-circle"></i>
                        Final price may vary based on specific requirements and location.
                    </p>
                </div>
                <div class="booking-form-container">
                    <form action="#" method="POST" class="booking-form">
                        @csrf
                        <div class="form-group">
                            <label for="booking_date">
                                <i class="fas fa-calendar"></i>
                                Preferred Date
                            </label>
                            <input type="date" id="booking_date" name="booking_date" 
                                   min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="booking_time">
                                <i class="fas fa-clock"></i>
                                Preferred Time
                            </label>
                            <select id="booking_time" name="booking_time" required>
                                <option value="">Select Time</option>
                                <option value="08:00">8:00 AM</option>
                                <option value="10:00">10:00 AM</option>
                                <option value="12:00">12:00 PM</option>
                                <option value="14:00">2:00 PM</option>
                                <option value="16:00">4:00 PM</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="special_notes">
                                <i class="fas fa-comment"></i>
                                Special Instructions (Optional)
                            </label>
                            <textarea id="special_notes" name="special_notes" 
                                      placeholder="Any specific requirements or instructions..."></textarea>
                        </div>
                        <button type="submit" class="btn-book-now">
                            <i class="fas fa-calendar-plus"></i>
                            <span>Book Now</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
