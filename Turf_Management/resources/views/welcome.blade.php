<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Turf Management System') }}</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: #f8fff8;
            color: #2d5a3d;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #4a7c59 0%, #6b9c7a 50%, #8bc34a 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }
        
        .hero-section .container {
            position: relative;
            z-index: 1;
        }
        
        .navbar {
            background: linear-gradient(135deg, #4a7c59 0%, #6b9c7a 100%) !important;
            box-shadow: 0 2px 10px rgba(74, 124, 89, 0.2);
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }
        
        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid #e8f5e8;
            box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
        }
        
        .dropdown-item {
            color: #2d5a3d;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background: #e8f5e8;
            color: #4a7c59;
        }
        
        .btn-light {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: #4a7c59;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-light:hover {
            background: white;
            border-color: white;
            color: #2d5a3d;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 255, 255, 0.3);
        }
        
        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.7);
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-light:hover {
            background: white;
            border-color: white;
            color: #4a7c59;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 255, 255, 0.3);
        }
        
        .feature-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 5px 20px rgba(74, 124, 89, 0.1);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(74, 124, 89, 0.2);
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #4a7c59, #6b9c7a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-title {
            color: #2d5a3d;
            font-weight: 700;
        }
        
        .card-text {
            color: #4a7c59;
        }
        
        .cta-section {
            background: linear-gradient(135deg, #e8f5e8 0%, #d4edda 100%);
            padding: 80px 0;
            position: relative;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain2" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(74,124,89,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain2)"/></svg>');
            opacity: 0.5;
        }
        
        .cta-section .container {
            position: relative;
            z-index: 1;
        }
        
        .cta-section h2 {
            color: #2d5a3d;
            font-weight: 700;
        }
        
        .cta-section .lead {
            color: #4a7c59;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4a7c59, #6b9c7a);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #3d6b4a, #5a8a69);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(74, 124, 89, 0.3);
            color: white;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        footer {
            background: linear-gradient(135deg, #2d5a3d 0%, #4a7c59 100%) !important;
            color: white;
            padding: 30px 0;
        }
        
        .display-4, .display-5 {
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .lead {
            font-weight: 500;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero-section h1 {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .hero-section p {
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }
        
        .hero-section .btn {
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }
        
        .feature-card {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .feature-card:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .feature-card:nth-child(3) {
            animation-delay: 0.4s;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-futbol me-2"></i>Turf Management System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                @if(auth()->user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">User Dashboard</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Welcome to Turf Management System</h1>
            <p class="lead mb-4">Efficiently manage and book sports turfs with our comprehensive management system</p>
            @guest
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Get Started
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                </div>
            @else
                <div class="d-flex justify-content-center gap-3">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-tachometer-alt me-2"></i>User Dashboard
                        </a>
                    @endif
                </div>
            @endguest
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="display-5 mb-3">Key Features</h2>
                    <p class="lead text-muted">Discover what makes our turf management system special</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100 text-center">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h5 class="card-title">Easy Booking</h5>
                            <p class="card-text">Book your preferred turf with just a few clicks. Real-time availability and instant confirmation.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100 text-center">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h5 class="card-title">User Management</h5>
                            <p class="card-text">Comprehensive user management system with role-based access control for admins and users.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100 text-center">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h5 class="card-title">Analytics & Reports</h5>
                            <p class="card-text">Get detailed insights into bookings, revenue, and turf utilization with comprehensive reports.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center">
            <h2 class="mb-4">Ready to Get Started?</h2>
            <p class="lead mb-4">Join thousands of users who trust our turf management system</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-rocket me-2"></i>Start Your Free Trial
                </a>
            @else
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-right me-2"></i>Go to Dashboard
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Turf Management System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
