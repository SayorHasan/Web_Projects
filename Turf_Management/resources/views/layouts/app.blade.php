<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Turf Nation') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f8fff8;
            color: #2d5a3d;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: linear-gradient(135deg, #4a7c59, #6b9c7a) !important;
            border-bottom: 2px solid #2d5a3d;
            box-shadow: 0 4px 20px rgba(74, 124, 89, 0.3);
        }

        .navbar-brand {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand .logo-shield {
            background: linear-gradient(135deg, #2d5a3d, #4a7c59);
            border-radius: 8px;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: #e8f5e8 !important;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 2px;
            background: #e8f5e8;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        .navbar-toggler {
            border: none;
            color: #ffffff;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .dropdown-menu {
            background: #ffffff;
            border: 1px solid #4a7c59;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(74, 124, 89, 0.2);
        }

        .dropdown-item {
            color: #2d5a3d;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: #e8f5e8;
            color: #2d5a3d;
            transform: translateX(5px);
        }

        .badge {
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 15px;
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, #4a7c59, #6b9c7a) !important;
        }

        .badge.bg-danger {
            background: linear-gradient(135deg, #dc3545, #e74c3c) !important;
        }

        .main-content {
            min-height: calc(100vh - 80px);
            background: #f8fff8;
        }

        .btn {
            border-radius: 25px;
            font-weight: 600;
            padding: 10px 25px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(74, 124, 89, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4a7c59, #6b9c7a);
            color: #ffffff;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #6b9c7a, #4a7c59);
            color: #ffffff;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #ffffff;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #e74c3c);
            color: #ffffff;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e8f5e8;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, #4a7c59, #6b9c7a);
            color: #ffffff;
            border-bottom: 1px solid #4a7c59;
            border-radius: 15px 15px 0 0 !important;
        }

        .form-control {
            background: #ffffff !important;
            border: 2px solid #e8f5e8 !important;
            color: #2d5a3d !important;
            -webkit-text-fill-color: #2d5a3d !important;
            border-radius: 10px;
            padding: 12px 15px;
        }

        .form-control:focus {
            background: #ffffff !important;
            border-color: #4a7c59 !important;
            color: #2d5a3d !important;
            -webkit-text-fill-color: #2d5a3d !important;
            box-shadow: 0 0 0 0.2rem rgba(74, 124, 89, 0.25);
        }

        .form-control::placeholder {
            color: #6b9c7a;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .alert-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #ffffff;
        }

        .alert-danger {
            background: linear-gradient(135deg, #dc3545, #e74c3c);
            color: #ffffff;
        }

        .alert-warning {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
            color: #ffffff;
        }

        .alert-info {
            background: linear-gradient(135deg, #17a2b8, #20c997);
            color: #ffffff;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #e8f5e8;
        }

        ::-webkit-scrollbar-thumb {
            background: #4a7c59;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6b9c7a;
        }

        /* Animation classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-up {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .btn {
                padding: 8px 20px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="logo-shield">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    TURF NATION
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(auth()->user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.users') }}">
                                        <i class="fas fa-users me-1"></i>Users
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.turfs.index') }}">
                                        <i class="fas fa-futbol me-1"></i>Turfs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.bookings.index') }}">
                                        <i class="fas fa-calendar me-1"></i>Bookings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.carousel.index') }}">
                                        <i class="fas fa-images me-1"></i>Carousel
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.book-turf') }}">
                                        <i class="fas fa-futbol me-1"></i>Book Turf
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.bookings.index') }}">
                                        <i class="fas fa-calendar me-1"></i>My Bookings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ auth()->user()->isAdmin() ? route('admin.profile') : route('user.profile') }}">
                                        <i class="fas fa-user me-1"></i>Profile
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>{{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>{{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                                    <span class="badge {{ auth()->user()->isAdmin() ? 'bg-danger' : 'bg-primary' }} ms-1">
                                        {{ ucfirst(auth()->user()->role) }}
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(auth()->user()->isAdmin())
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.carousel.index') }}">
                                            <i class="fas fa-images me-2"></i>Manage Carousel
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                            <i class="fas fa-tachometer-alt me-2"></i>User Dashboard
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ auth()->user()->isAdmin() ? route('admin.profile') : route('user.profile') }}">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-content py-4">
            @if(session('success'))
                <div class="container">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="container">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
