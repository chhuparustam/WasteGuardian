<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WasteGuardian - Smart Waste Management Dashboard">
    <meta name="author" content="WasteGuardian Team">
    <title>WasteGuardian - Smart Waste Management Dashboard</title>

    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modern-dashboard.css') }}" rel="stylesheet">
</head>

<body class="modern-dashboard">

    <!-- Modern Sticky Navigation -->
    <nav class="modern-navbar" id="mainNavbar">
        <div class="container-fluid">
            <div class="navbar-content">
                <!-- Brand Section -->
                <div class="navbar-brand">
                    <div class="logo-container">
                        <img src="{{ asset('images/logo.png') }}" class="brand-logo" alt="WasteGuardian">
                        <div class="brand-text">
                            <span class="brand-name">WasteGuardian</span>
                            <span class="brand-tagline">Smart Waste Solutions</span>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <div class="navbar-menu" id="navbarMenu">
                    <ul class="nav-links">
                        <li class="nav-item">
                            <a class="nav-link active" href="#home-section">
                                <i class="material-icons-round">home</i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services-section">
                                <i class="material-icons-round">cleaning_services</i>
                                <span>Services</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">
                                <i class="material-icons-round">info</i>
                                <span>About</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact-details">
                                <i class="material-icons-round">contact_mail</i>
                                <span>Contact</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="navbar-actions">
                    <a href="{{ route('select-register') }}" class="btn btn-outline-modern">
                        <i class="material-icons-round">person_add</i>
                        <span>Register</span>
                    </a>
                    <a href="{{ route('select-login') }}" class="btn btn-primary-modern">
                        <i class="material-icons-round">login</i>
                        <span>Login</span>
                    </a>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-toggle d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                    <span class="toggle-line"></span>
                    <span class="toggle-line"></span>
                    <span class="toggle-line"></span>
                </button>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <!-- Modern Hero Section -->
        <section class="hero-modern" id="hero">
            <div class="hero-background">
                <div class="hero-gradient"></div>
                <div class="hero-pattern"></div>
            </div>
            
            <div class="container">
                <div class="hero-container">
                    <div class="hero-content">
                        <div class="hero-badge">
                            <i class="material-icons-round">eco</i>
                            <span>Smart Waste Management</span>
                        </div>
                        
                        <h1 class="hero-title">
                            <span class="title-line">Let's protect our</span>
                            <span class="rotating-text-container">
                                <span class="rotating-text active">Streets</span>
                                <span class="rotating-text">Community</span>
                                <span class="rotating-text">Environment</span>
                                <span class="rotating-text">Future</span>
                            </span>
                        </h1>
                        
                        <p class="hero-description">
                            Transform waste management with smart tracking, instant requests, and eco-friendly solutions. 
                            Join thousands who choose WasteGuardian for a cleaner tomorrow.
                        </p>
                        
                        <div class="hero-buttons">
                            <a class="btn btn-hero-primary" href="#intro-section">
                                <span>Get Started</span>
                                <i class="material-icons-round">arrow_forward</i>
                            </a>
                            <a class="btn btn-hero-secondary" href="#services-section">
                                <i class="material-icons-round">explore</i>
                                <span>Explore Services</span>
                            </a>
                        </div>
                        
                        <!-- Hero Stats -->
                        <div class="hero-stats">
                            <div class="stat-item">
                                <div class="stat-number">15K+</div>
                                <div class="stat-label">Happy Customers</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">99%</div>
                                <div class="stat-label">Satisfaction Rate</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">24/7</div>
                                <div class="stat-label">Support</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modern Introduction Section -->
        <section class="intro-modern" id="intro-section">
            <div class="container">
                <div class="intro-grid">
                    <!-- Content Side -->
                    <div class="intro-content">
                        <div class="section-badge">
                            <i class="material-icons-round">lightbulb</i>
                            <span>About WasteGuardian</span>
                        </div>
                        
                        <h2 class="section-title">
                            Welcome to <span class="text-gradient">WasteGuardian</span>
                        </h2>
                        <p class="section-subtitle">Your Smart Waste Companion!</p>
                        
                        <div class="intro-text">
                            <p class="lead-text">
                                Say goodbye to messy waste routines! With smart tracking, quick requests, and clean communication, 
                                <strong>WasteGuardian</strong> helps you manage waste effortlessly.
                            </p>
                            <p>
                                Whether you're a user or a driver — you're part of the solution. 
                                Let's <strong>Clean smarter, not harder!</strong> Together, we're not just managing waste — 
                                we're shaping a greener tomorrow.
                            </p>
                        </div>
                        
                        <!-- Feature Points -->
                        <div class="feature-points">
                            <div class="feature-point">
                                <i class="material-icons-round">check_circle</i>
                                <span>Smart Tracking Technology</span>
                            </div>
                            <div class="feature-point">
                                <i class="material-icons-round">check_circle</i>
                                <span>Eco-Friendly Solutions</span>
                            </div>
                            <div class="feature-point">
                                <i class="material-icons-round">check_circle</i>
                                <span>24/7 Customer Support</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Visual Side -->
                    <div class="intro-visual">
                        <div class="image-stack">
                            <div class="main-image-container">
                                <img src="{{ asset('images/male-wearing-apron-female-white-t-shirt-smiling-broadly-being-glad-clean.png') }}" 
                                     alt="Professional cleaning team" class="main-image">
                            </div>
                            
                            <!-- Floating Contact Card -->
                            <div class="floating-contact-card">
                                <div class="card-header">
                                    <i class="material-icons-round">support_agent</i>
                                    <h6>Need Help?</h6>
                                </div>
                                <p>Call us anytime:</p>
                                <div class="contact-info">
                                    <i class="material-icons-round">phone</i>
                                    <a href="tel:110-220-9800" class="phone-number">110-220-9800</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modern Services Section -->
        <section class="services-modern" id="services-section">
            <div class="container">
                <!-- Section Header -->
                <div class="section-header text-center">
                    <div class="section-badge">
                        <i class="material-icons-round">star</i>
                        <span>Our Services</span>
                    </div>
                    <h2 class="section-title">Our <span class="text-gradient">Best Offers</span></h2>
                    <p class="section-subtitle">Professional cleaning services tailored to your specific needs</p>
                </div>
                
                <!-- Services Grid -->
                <div class="services-grid">
                    <!-- Office Cleaning Service -->
                    <div class="service-card modern-card">
                        <div class="card-image-container">
                            <img src="{{ asset('images/services/people-taking-care-office-cleaning.jpg') }}" 
                                 alt="Office Cleaning" class="card-image primary">
                            <img src="{{ asset('images/services/person-taking-care-office.jpg') }}" 
                                 alt="Office Cleaning" class="card-image secondary">
                            
                            <!-- Service Badge -->
                            <div class="service-badges">
                                <div class="price-badge">
                                    <i class="material-icons-round">attach_money</i>
                                    <span>$820</span>
                                </div>
                                <div class="time-badge">
                                    <i class="material-icons-round">schedule</i>
                                    <span>5 hrs</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <h4 class="card-title">Office Cleaning</h4>
                          
                            
                            <div class="card-footer">
                                <div class="rating-stars">
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <span class="rating-text">3.0</span>
                                </div>
                                <a href="{{ route('user.services.show', ['service' => 'office-cleaning']) }}" class="btn btn-card-action">
                                    <i class="material-icons-round">arrow_forward</i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Kitchen Cleaning Service -->
                    <div class="service-card modern-card featured">
                        <div class="featured-badge">
                            <i class="material-icons-round">star</i>
                            <span>Popular</span>
                        </div>
                        
                        <div class="card-image-container">
                            <img src="{{ asset('images/services/young-smiling-woman-wearing-rubber-gloves-cleaning-stove.jpg') }}" 
                                 alt="Kitchen Cleaning" class="card-image primary">
                            <img src="{{ asset('images/services/woman-holding-rag-detergent-cleaning-cooker.jpg') }}" 
                                 alt="Kitchen Cleaning" class="card-image secondary">
                            
                            <div class="service-badges">
                                <div class="price-badge">
                                    <i class="material-icons-round">attach_money</i>
                                    <span>$640</span>
                                </div>
                                <div class="time-badge">
                                    <i class="material-icons-round">schedule</i>
                                    <span>4 hrs</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <h4 class="card-title">Kitchen Cleaning</h4>
                            <p class="card-description">

                            
                            <div class="card-footer">
                                <div class="rating-stars">
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <span class="rating-text">5.0</span>
                                </div>
                                <a href="services-detail.html" class="btn btn-card-action">
                                    <span>Book</span>
                                    <i class="material-icons-round">arrow_forward</i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Car Washing Service -->
                    <div class="service-card modern-card">
                        <div class="card-image-container">
                            <img src="{{ asset('images/services/man-polishing-car-inside-car-service.jpg') }}" 
                                 alt="Car Washing" class="card-image primary">
                            <img src="{{ asset('images/services/man-polishing-car-inside.jpg') }}" 
                                 alt="Car Washing" class="card-image secondary">
                            
                            <div class="service-badges">
                                <div class="price-badge">
                                    <i class="material-icons-round">attach_money</i>
                                    <span>$240</span>
                                </div>
                                <div class="time-badge">
                                    <i class="material-icons-round">schedule</i>
                                    <span>2 hrs</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <h4 class="card-title">Car Washing</h4>
                           
                            
                            <div class="card-footer">
                                <div class="rating-stars">
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <span class="rating-text">5.0</span>
                                </div>
                                <a href="services-detail.html" class="btn btn-card-action">
                                    <span>Book</span>
                                    <i class="material-icons-round">arrow_forward</i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Factory Cleaning Service -->
                    <div class="service-card modern-card enterprise">
                        <div class="enterprise-badge">
                            <i class="material-icons-round">business</i>
                            <span>Enterprise</span>
                        </div>
                        
                        <div class="card-image-container">
                            <img src="{{ asset('images/services/professional-industrial-cleaner-protective-uniform-cleaning-floor-food-processing-plant.jpg') }}" 
                                 alt="Factory Cleaning" class="card-image primary">
                            <img src="{{ asset('images/services/close-up-mop-cleaning-industrial-plant-floor.jpg') }}" 
                                 alt="Factory Cleaning" class="card-image secondary">
                            
                            <div class="service-badges">
                                <div class="price-badge">
                                    <i class="material-icons-round">attach_money</i>
                                    <span>$6,800</span>
                                </div>
                                <div class="time-badge">
                                    <i class="material-icons-round">schedule</i>
                                    <span>30 hrs</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <h4 class="card-title">Factory Cleaning</h4>
                          
                            
                            <div class="card-footer">
                                <div class="rating-stars">
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <i class="material-icons-round filled">star</i>
                                    <span class="rating-text">4.0</span>
                                </div>
                                <a href="services-detail.html" class="btn btn-card-action">
                                    <span>Book</span>
                                    <i class="material-icons-round">arrow_forward</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @php
            $isLoggedin = true //true if login else false will work as expected
        @endphp

        <!-- Modern Pickup Request Section -->
        <section class="pickup-modern" id="pickup-request">
            <div class="container">
                <!-- Section Header -->
                <div class="section-header text-center">
                    <div class="section-badge">
                        <i class="material-icons-round">local_shipping</i>
                        <span>Quick Service</span>
                    </div>
                    <h2 class="section-title">Quick <span class="text-gradient">Pickup Request</span></h2>
                    <p class="section-subtitle">Your Waste, Our Responsibility - Fast & Reliable</p>
                </div>
                
                <div class="pickup-container {{ $isLoggedin ? 'has-form' : 'testimonials-only' }}">
                    <!-- Testimonials Sidebar -->
                    <div class="testimonials-modern">
                        <div class="testimonials-header">
                            <h4 class="testimonials-title">
                                <i class="material-icons-round">reviews</i>
                                What Our Customers Say
                            </h4>
                        </div>
                        
                        <div class="testimonials-container">
                            <!-- Testimonial 1 -->
                            <div class="testimonial-card modern-testimonial">
                                <div class="testimonial-content">
                                    <div class="quote-icon">
                                        <i class="material-icons-round">format_quote</i>
                                    </div>
                                    <p class="testimonial-text">Best Cleaning Service Provider. Excellent service and professional staff.</p>
                                </div>
                                <div class="testimonial-footer">
                                    <div class="customer-info">
                                        <div class="customer-avatar">
                                            <i class="material-icons-round">person</i>
                                        </div>
                                        <div class="customer-details">
                                            <h5 class="customer-name">Marie</h5>
                                            <span class="customer-title">Business Owner</span>
                                        </div>
                                    </div>
                                    <div class="rating-display">
                                        <div class="stars">
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star</i>
                                        </div>
                                        <span class="rating-number">5.0</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 2 -->
                            <div class="testimonial-card modern-testimonial">
                                <div class="testimonial-content">
                                    <div class="quote-icon">
                                        <i class="material-icons-round">format_quote</i>
                                    </div>
                                    <p class="testimonial-text">Reliable and eco-friendly waste management. Highly recommended service.</p>
                                </div>
                                <div class="testimonial-footer">
                                    <div class="customer-info">
                                        <div class="customer-avatar">
                                            <i class="material-icons-round">person</i>
                                        </div>
                                        <div class="customer-details">
                                            <h5 class="customer-name">John</h5>
                                            <span class="customer-title">Homeowner</span>
                                        </div>
                                    </div>
                                    <div class="rating-display">
                                        <div class="stars">
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star</i>
                                        </div>
                                        <span class="rating-number">5.0</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 3 -->
                            <div class="testimonial-card modern-testimonial">
                                <div class="testimonial-content">
                                    <div class="quote-icon">
                                        <i class="material-icons-round">format_quote</i>
                                    </div>
                                    <p class="testimonial-text">Quick response and professional cleaning. Very satisfied with the service.</p>
                                </div>
                                <div class="testimonial-footer">
                                    <div class="customer-info">
                                        <div class="customer-avatar">
                                            <i class="material-icons-round">person</i>
                                        </div>
                                        <div class="customer-details">
                                            <h5 class="customer-name">Sarah</h5>
                                            <span class="customer-title">Office Manager</span>
                                        </div>
                                    </div>
                                    <div class="rating-display">
                                        <div class="stars">
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star</i>
                                            <i class="material-icons-round">star_border</i>
                                        </div>
                                        <span class="rating-number">4.0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($isLoggedin)
                    <!-- Modern Pickup Request Form -->
                    <div class="pickup-form-modern">
                        <div class="form-container modern-card">
                            <div class="form-header">
                                <div class="form-icon">
                                    <i class="material-icons-round">send</i>
                                </div>
                                <h4 class="form-title">Request Pickup</h4>
                                <p class="form-subtitle">Fill in the details below and we'll handle the rest</p>
                            </div>
                            
                            <form action="{{ route('pickup.store') }}" method="POST" enctype="multipart/form-data" class="pickup-form">
                                @csrf
                                <div class="form-grid">
                                    <!-- Full Name Field -->
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            <i class="material-icons-round">person</i>
                                            <span>Full Name</span>
                                        </label>
                                        <div class="input-container">
                                            <input type="text" id="name" name="name" class="form-control modern-input" 
                                                   placeholder="Enter your full name" required>
                                            <div class="input-border"></div>
                                        </div>
                                    </div>

                                    <!-- Address Field -->
                                    <div class="form-group">
                                        <label for="address" class="form-label">
                                            <i class="material-icons-round">location_on</i>
                                            <span>Address</span>
                                        </label>
                                        <div class="input-container">
                                            <input type="text" id="address" name="address" class="form-control modern-input" 
                                                   placeholder="Enter your address" required>
                                            <div class="input-border"></div>
                                        </div>
                                    </div>

                                    <!-- Landmark Field -->
                                    <div class="form-group">
                                        <label for="landmark" class="form-label">
                                            <i class="material-icons-round">place</i>
                                            <span>Nearest Landmark</span>
                                        </label>
                                        <div class="input-container">
                                            <input type="text" id="landmark" name="landmark" class="form-control modern-input" 
                                                   placeholder="Enter nearest landmark" required>
                                            <div class="input-border"></div>
                                        </div>
                                    </div>

                                    <!-- Photo Upload Field -->
                                    <div class="form-group">
                                        <label for="photo" class="form-label">
                                            <i class="material-icons-round">photo_camera</i>
                                            <span>Upload Photo</span>
                                        </label>
                                        <div class="file-upload-modern">
                                            <input type="file" id="photo" name="photo" class="file-input" accept="image/*" required>
                                            <div class="file-upload-area">
                                                <div class="upload-icon">
                                                    <i class="material-icons-round">cloud_upload</i>
                                                </div>
                                                <div class="upload-text">
                                                    <span class="upload-primary">Choose file or drag here</span>
                                                    <span class="upload-secondary">PNG, JPG up to 10MB</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Message Field -->
                                    <div class="form-group full-width">
                                        <label for="message" class="form-label">
                                            <i class="material-icons-round">message</i>
                                            <span>Additional Notes</span>
                                            <span class="optional-badge">Optional</span>
                                        </label>
                                        <div class="input-container">
                                            <textarea id="message" name="message" class="form-control modern-textarea" rows="4" 
                                                      placeholder="Any additional information or special instructions"></textarea>
                                            <div class="input-border"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-submit-modern">
                                        <i class="material-icons-round">send</i>
                                        <span>Submit Request</span>
                                        <div class="btn-loading">
                                            <div class="spinner"></div>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

    <!-- Modern Footer -->
    <footer class="footer-modern">
        <div class="container">
            <div class="footer-content">
                <!-- Footer Header -->
                <div class="footer-header">
                    <div class="footer-brand">
                        <div class="brand-container">
                            <img src="{{ asset('images/logo.png') }}" class="footer-logo" alt="WasteGuardian">
                            <div class="brand-info">
                                <span class="brand-name">WasteGuardian</span>
                                <span class="brand-tagline">Smart Waste Solutions</span>
                            </div>
                        </div>
                        <p class="brand-description">
                            Leading the future of waste management with smart, eco-friendly solutions 
                            that make a difference in communities worldwide.
                        </p>
                    </div>
                    
                    <!-- Quick Navigation -->
                    <nav class="footer-nav">
                        <a href="#" class="footer-nav-link">
                            <i class="material-icons-round">info</i>
                            <span>About Us</span>
                        </a>
                        <a href="#" class="footer-nav-link">
                            <i class="material-icons-round">article</i>
                            <span>Blog</span>
                        </a>
                        <a href="#" class="footer-nav-link">
                            <i class="material-icons-round">star</i>
                            <span>Reviews</span>
                        </a>
                        <a href="#" class="footer-nav-link">
                            <i class="material-icons-round">contact_mail</i>
                            <span>Contact</span>
                        </a>
                    </nav>
                </div>

                <!-- Footer Body -->
                <div class="footer-body">
                    <!-- Services Section -->
                    <div class="footer-section">
                        <h5 class="footer-section-title">
                            <i class="material-icons-round">cleaning_services</i>
                            Our Services
                        </h5>
                        <ul class="footer-links">
                            <li><a href="#" class="footer-link">
                                <i class="material-icons-round">home</i>
                                House Cleaning
                            </a></li>
                            <li><a href="#" class="footer-link">
                                <i class="material-icons-round">directions_car</i>
                                Car Washing
                            </a></li>
                            <li><a href="#" class="footer-link">
                                <i class="material-icons-round">local_laundry_service</i>
                                Laundry
                            </a></li>
                            <li><a href="#" class="footer-link">
                                <i class="material-icons-round">business</i>
                                Office Cleaning
                            </a></li>
                            <li><a href="#" class="footer-link">
                                <i class="material-icons-round">wc</i>
                                Toilet Cleaning
                            </a></li>
                        </ul>
                    </div>

                    <!-- Contact Section -->
                    <div class="footer-section">
                        <h5 class="footer-section-title">
                            <i class="material-icons-round">contact_phone</i>
                            Contact Info
                        </h5>
                        <div class="contact-details">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="material-icons-round">location_on</i>
                                </div>
                                <div class="contact-text">
                                    <span class="contact-label">Address</span>
                                    <span class="contact-value">Birgunj - 15, Parsa</span>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="material-icons-round">phone</i>
                                </div>
                                <div class="contact-text">
                                    <span class="contact-label">Phone</span>
                                    <a href="tel:110-220-9800" class="contact-value">+9779824*****8</a>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="material-icons-round">email</i>
                                </div>
                                <div class="contact-text">
                                    <span class="contact-label">Email</span>
                                    <a href="mailto:info@company.com" class="contact-value">info@wasteguardian.com</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Hours Section -->
                    <div class="footer-section">
                        <h5 class="footer-section-title">
                            <i class="material-icons-round">schedule</i>
                            Service Hours
                        </h5>
                        <div class="hours-list">
                            <div class="hours-item">
                                <div class="day-range">Sunday - Fri</div>
                                <div class="time-range">6:00 AM - 6:30 PM</div>
                            </div>
                            <div class="hours-item closed">
                                <div class="day-range">Saturday</div>
                                <div class="time-range">Closed</div>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter Section -->
                    <div class="footer-section">
                        <h5 class="footer-section-title">
                            <i class="material-icons-round">notifications</i>
                            Stay Updated
                        </h5>
                        <p class="newsletter-text">Subscribe to get updates on our latest services and offers.</p>
                        <div class="newsletter-form">
                            <div class="newsletter-input">
                                <input type="email" placeholder="Enter your email" class="newsletter-field">
                                <button type="button" class="newsletter-btn">
                                    <i class="material-icons-round">send</i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Social Links -->
                        <div class="social-links">
                            <a href="#" class="social-link twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="social-link facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-link instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="social-link linkedin">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <div class="footer-bottom-content">
                        <div class="copyright">
                            <p>© 2025 WasteGuardian. All rights reserved.</p>
                        </div>
                        <div class="footer-links-bottom">
                            <a href="#" class="footer-link-bottom">Privacy Policy</a>
                            <a href="#" class="footer-link-bottom">Terms of Service</a>
                            <a href="#" class="footer-link-bottom">Cookie Policy</a>
                        </div>
                        <div class="credits">
                            <p>Designed with <i class="material-icons-round love">favorite</i> by 
                               <a href="https://chhuparustam.com.np" target="_blank" class="credit-link">Chhuparustam</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop">
        <i class="material-icons-round">keyboard_arrow_up</i>
    </button>

    <!-- JavaScript Files -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/modern-dashboard.js') }}"></script>

    <!-- Custom JavaScript for Modern Features -->
    <script>
        // Modern Dashboard JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Rotating text animation
            const rotatingTexts = document.querySelectorAll('.rotating-text');
            let currentIndex = 0;
            
            function rotateText() {
                rotatingTexts.forEach((text, index) => {
                    text.classList.remove('active');
                    if (index === currentIndex) {
                        text.classList.add('active');
                    }
                });
                currentIndex = (currentIndex + 1) % rotatingTexts.length;
            }
            
            setInterval(rotateText, 3000);

            // Navbar scroll effect
            const navbar = document.getElementById('mainNavbar');
            
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Back to top button
            const backToTopBtn = document.getElementById('backToTop');
            
            window.addEventListener('scroll', function() {
                if (window.scrollY > 300) {
                    backToTopBtn.classList.add('visible');
                } else {
                    backToTopBtn.classList.remove('visible');
                }
            });

            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // File upload handling
            const fileInput = document.getElementById('photo');
            const fileUploadArea = document.querySelector('.file-upload-area');
            
            if (fileInput && fileUploadArea) {
                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        fileUploadArea.classList.add('file-selected');
                        const fileName = this.files[0].name;
                        fileUploadArea.querySelector('.upload-primary').textContent = fileName;
                        fileUploadArea.querySelector('.upload-secondary').textContent = 'File selected successfully';
                    }
                });

                // Drag and drop functionality
                fileUploadArea.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('drag-over');
                });

                fileUploadArea.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.classList.remove('drag-over');
                });

                fileUploadArea.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('drag-over');
                    
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        fileInput.files = files;
                        this.classList.add('file-selected');
                        this.querySelector('.upload-primary').textContent = files[0].name;
                        this.querySelector('.upload-secondary').textContent = 'File selected successfully';
                    }
                });
            }

            // Form submission animation
            const submitBtn = document.querySelector('.btn-submit-modern');
            
            if (submitBtn) {
                submitBtn.addEventListener('click', function(e) {
                    this.classList.add('loading');
                    // Remove loading class after 3 seconds (adjust as needed)
                    setTimeout(() => {
                        this.classList.remove('loading');
                    }, 3000);
                });
            }

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>

    @if(session('scroll_to'))
        <script>
            window.addEventListener('load', function () {
                const target = document.getElementById("{{ session('scroll_to') }}");
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        </script>
    @endif
</body>
</html>