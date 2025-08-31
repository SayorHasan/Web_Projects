@extends('layouts.app')

@section('content')
<style>
.home-container {
    background: linear-gradient(135deg, #f8fff8 0%, #e8f5e8 50%, #d4edda 100%);
    min-height: 100vh;
    padding: 40px 0;
}

.welcome-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    border: 1px solid #e8f5e8;
    animation: slideUp 0.6s ease-out;
}

.welcome-header {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    padding: 20px 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.welcome-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.welcome-header h1 {
    position: relative;
    z-index: 1;
    margin: 0;
    font-weight: 700;
    font-size: 2rem;
}

.welcome-content {
    text-align: center;
    color: #2d5a3d;
}

.welcome-message {
    font-size: 1.2rem;
    color: #4a7c59;
    margin-bottom: 30px;
    font-weight: 500;
}

.success-alert {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border: 1px solid #c3e6cb;
    color: #155724;
    border-radius: 12px;
    padding: 15px 20px;
    margin-bottom: 25px;
    box-shadow: 0 5px 15px rgba(74, 124, 89, 0.1);
}

.dashboard-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 30px;
}

.dashboard-btn {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.dashboard-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(74, 124, 89, 0.3);
    color: white;
    text-decoration: none;
}

.dashboard-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.dashboard-btn:hover::before {
    left: 100%;
}

.dashboard-btn.secondary {
    background: linear-gradient(135deg, #6c757d, #5a6268);
}

.dashboard-btn.secondary:hover {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .welcome-card {
        padding: 30px 20px;
    }
    
    .welcome-header {
        padding: 15px 20px;
    }
    
    .welcome-header h1 {
        font-size: 1.5rem;
    }
    
    .dashboard-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .dashboard-btn {
        width: 100%;
        max-width: 250px;
        justify-content: center;
    }
}
</style>

<div class="home-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="welcome-card">
                    <div class="welcome-header">
                        <h1><i class="fas fa-tachometer-alt me-3"></i>{{ __('Dashboard') }}</h1>
                    </div>

                    <div class="welcome-content">
                        @if (session('status'))
                            <div class="success-alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                            </div>
                        @endif

                        <div class="welcome-message">
                            <i class="fas fa-hand-wave me-2"></i>{{ __('Welcome! You are successfully logged in.') }}
                        </div>
                        
                        <p class="text-muted mb-4">
                            Choose an action below to get started with your turf management experience.
                        </p>

                        <div class="dashboard-actions">
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="dashboard-btn">
                                    <i class="fas fa-tachometer-alt"></i>
                                    Admin Dashboard
                                </a>
                                <a href="{{ route('admin.users') }}" class="dashboard-btn secondary">
                                    <i class="fas fa-users"></i>
                                    Manage Users
                                </a>
                                <a href="{{ route('admin.turfs.index') }}" class="dashboard-btn secondary">
                                    <i class="fas fa-futbol"></i>
                                    Manage Turfs
                                </a>
                                <a href="{{ route('admin.bookings.index') }}" class="dashboard-btn secondary">
                                    <i class="fas fa-calendar-check"></i>
                                    Manage Bookings
                                </a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="dashboard-btn">
                                    <i class="fas fa-tachometer-alt"></i>
                                    User Dashboard
                                </a>
                                <a href="{{ route('user.book-turf') }}" class="dashboard-btn secondary">
                                    <i class="fas fa-futbol"></i>
                                    Book a Turf
                                </a>
                                <a href="{{ route('user.bookings.index') }}" class="dashboard-btn secondary">
                                    <i class="fas fa-calendar-check"></i>
                                    My Bookings
                                </a>
                            @endif
                            
                            <a href="{{ auth()->user()->isAdmin() ? route('admin.profile') : route('user.profile') }}" class="dashboard-btn secondary">
                                <i class="fas fa-user"></i>
                                My Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
