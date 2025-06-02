<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service['title'] }} | WasteGuardian</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/modern-dashboard.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <style>
        .service-details-wrapper {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .service-header {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .service-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        
        .service-header h1 {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            margin: 0;
        }
        
        .service-info {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        
        .service-price {
            font-size: 1.5rem;
            color: #14b8a6;
            margin: 1.5rem 0;
        }
        
        .btn-book {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #14b8a6 0%, #3b82f6 100%);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-book:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="modern-navbar" id="mainNavbar">
        <div class="container-fluid">
            <div class="navbar-content">
                <!-- Brand -->
                <div class="navbar-brand">
                    <a href="{{ url('/') }}" class="logo-container">
                        <img src="{{ asset('images/logo.png') }}" class="brand-logo" alt="WasteGuardian">
                        <div class="brand-text">
                            <span class="brand-name">WasteGuardian</span>
                            <span class="brand-tagline">Smart Waste Solutions</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation -->
                <div class="navbar-menu" id="navbarMenu">
                    <ul class="nav-links">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">
                                <i class="material-icons-round">home</i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#services-section">
                                <i class="material-icons-round">cleaning_services</i>
                                <span>Services</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Service Details -->
    <div class="service-details-wrapper">
        <div class="service-header">
            <img src="{{ asset($service['image']) }}" 
                 alt="{{ $service['title'] }}" 
                 class="service-image">
            <h1>{{ $service['title'] }}</h1>
        </div>

        <div class="service-info">
            <p class="text-lg text-gray-600">{{ $service['description'] }}</p>
            
            <div class="service-price">
                <strong>Price:</strong> Rs. {{ $service['price'] }}
            </div>

            @auth
                <form action="{{ route('services.book', ['service' => $service['id']]) }}" 
                      method="POST" 
                      class="mt-4">
                    @csrf
                    <button type="submit" class="btn-book">
                        <i class="material-icons-round">shopping_cart</i>
                        <span>Book & Pay with eSewa</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-book">
                    <i class="material-icons-round">login</i>
                    <span>Login to Book</span>
                </a>
            @endauth
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-modern">
        <div class="container">
            <div class="footer-content">
                <p>&copy; {{ date('Y') }} WasteGuardian. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>