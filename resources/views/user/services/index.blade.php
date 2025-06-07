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
        <!-- Office Cleaning -->
        <div class="service-card">
            <div class="card-image">
                <img src="{{ asset('images/services/people-taking-care-office-cleaning.jpg') }}" 
                                 alt="Office Cleaning" class="card-image primary">
                            <img src="{{ asset('images/services/person-taking-care-office.jpg') }}" 
                                 alt="Office Cleaning" class="card-image secondary">
                <div class="price-badge">
                    <i class="fas fa-tag"></i>
                    <span>Rs. 820</span>
                </div>
            </div>
            <div class="card-body">
                <h3>Office Cleaning</h3>
                <div class="service-info">
                    <span class="duration">
                        <i class="fas fa-clock"></i>
                        5 hours
                    </span>
                    <span class="frequency">
                        <i class="fas fa-redo"></i>
                        One-time
                    </span>
                </div>
                <p class="service-description">
                    Professional office cleaning service including dusting, vacuuming, and sanitization.
                </p>
                <a href="{{ route('services.show', ['service' => 'office-cleaning']) }}" 
                   class="btn-book">
                    View Details & Book
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Kitchen Cleaning -->
        <div class="service-card">
            <div class="card-image">
                <img src="{{ asset('images/services/young-smiling-woman-wearing-rubber-gloves-cleaning-stove.jpg') }}" 
                                 alt="Kitchen Cleaning" class="card-image primary">
                            <img src="{{ asset('images/services/woman-holding-rag-detergent-cleaning-cooker.jpg') }}" 
                                 alt="Kitchen Cleaning" class="card-image secondary">
                <div class="price-badge">
                    <i class="fas fa-tag"></i>
                    <span>Rs. 640</span>
                </div>
            </div>
            <div class="card-body">
                <h3>Kitchen Cleaning</h3>
                <div class="service-info">
                    <span class="duration">
                        <i class="fas fa-clock"></i>
                        4 hours
                    </span>
                    <span class="frequency">
                        <i class="fas fa-redo"></i>
                        One-time
                    </span>
                </div>
                <p class="service-description">
                    Deep kitchen cleaning including appliances, countertops, and floor cleaning.
                </p>
                <a href="" 
                   class="btn-book">
                    View Details & Book
                    <
                </a>
            </div>
        </div>

        <!-- Vehicle Cleaning -->
        <div class="service-card">
            <div class="card-image">
                <img src="{{ asset('images/services/man-polishing-car-inside-car-service.jpg') }}" 
                                 alt="Car Washing" class="card-image primary">
                            <img src="{{ asset('images/services/man-polishing-car-inside.jpg') }}" 
                                 alt="Car Washing" class="card-image secondary">
                <div class="price-badge">
                    <i class="fas fa-tag"></i>
                    <span>Rs. 240</span>
                </div>
            </div>
            <div class="card-body">
                <h3>Vehicle Cleaning</h3>
                <div class="service-info">
                    <span class="duration">
                        <i class="fas fa-clock"></i>
                        2 hours
                    </span>
                    <span class="frequency">
                        <i class="fas fa-redo"></i>
                        One-time
                    </span>
                </div>
                <p class="service-description">
                    Interior and exterior vehicle cleaning with premium cleaning products.
                </p>
                <a href="" 
                   class="btn-book">
                    View Details & Book
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- House Cleaning -->
        <div class="service-card">
            <div class="card-image">
                <img src="{{ asset('images/services/house-cleaning.jpg') }}" 
                     alt="House Cleaning" class="card-image primary">
                <div class="price-badge">
                    <i class="fas fa-tag"></i>
                    <span>Rs. 1200</span>
                </div>
            </div>
            <div class="card-body">
                <h3>House Cleaning</h3>
                <div class="service-info">
                    <span class="duration">
                        <i class="fas fa-clock"></i>
                        6 hours
                    </span>
                    <span class="frequency">
                        <i class="fas fa-redo"></i>
                        One-time/Weekly
                    </span>
                </div>
                <p class="service-description">
                    Complete home cleaning service including all rooms, bathrooms, and living spaces.
                </p>
                <a href="" 
                   class="btn-book">
                    View Details & Book
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Factory Cleaning -->
        <div class="service-card">
            <div class="card-image">
                <img src="{{ asset('images/services/factory-cleaning.jpg') }}" 
                     alt="Factory Cleaning" class="card-image primary">
                <div class="price-badge">
                    <i class="fas fa-tag"></i>
                    <span>Rs. 6800</span>
                </div>
            </div>
            <div class="card-body">
                <h3>Factory Cleaning</h3>
                <div class="service-info">
                    <span class="duration">
                        <i class="fas fa-clock"></i>
                        30 hours
                    </span>
                    <span class="frequency">
                        <i class="fas fa-redo"></i>
                        Contract Based
                    </span>
                </div>
                <p class="service-description">
                    Industrial cleaning service for factories and manufacturing facilities, including equipment and workspace sanitization.
                </p>
                <a href="" 
                   class="btn-book">
                    View Details & Book
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Commercial Space Cleaning -->
        <div class="service-card">
            <div class="card-image">
                <img src="{{ asset('images/services/commercial-cleaning.jpg') }}" 
                     alt="Commercial Cleaning" class="card-image primary">
                <div class="price-badge">
                    <i class="fas fa-tag"></i>
                    <span>Rs. 3500</span>
                </div>
            </div>
            <div class="card-body">
                <h3>Commercial Space Cleaning</h3>
                <div class="service-info">
                    <span class="duration">
                        <i class="fas fa-clock"></i>
                        15 hours
                    </span>
                    <span class="frequency">
                        <i class="fas fa-redo"></i>
                        Monthly Contract
                    </span>
                </div>
                <p class="service-description">
                    Comprehensive cleaning service for shopping centers, retail spaces, and commercial buildings.
                </p>
                <a href="" 
                   class="btn-book">
                    View Details & Book
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection