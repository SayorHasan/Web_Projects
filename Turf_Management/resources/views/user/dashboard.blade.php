@extends('layouts.app')

@section('content')
<style>
.dashboard-container {
    background: linear-gradient(135deg, #f8fff8 0%, #e8f5e8 50%, #d4edda 100%);
    min-height: 100vh;
    padding: 20px 0;
    position: relative;
    overflow-x: hidden;
}

.dashboard-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(74, 124, 89, 0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
    z-index: 0;
}

.dashboard-content {
    position: relative;
    z-index: 1;
}

.dashboard-header {
    background: linear-gradient(135deg, rgba(74, 124, 89, 0.95), rgba(107, 156, 122, 0.95));
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.3);
    border: 2px solid rgba(74, 124, 89, 0.3);
    animation: slideDown 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 4s infinite;
}

.dashboard-title {
    color: #ffffff;
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
    animation: titleGlow 3s ease-in-out infinite alternate;
}

.dashboard-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.3rem;
    margin-bottom: 0;
    position: relative;
    z-index: 1;
    animation: fadeInUp 1s ease-out 0.5s both;
}

.user-badge {
    background: linear-gradient(135deg, #2d5a3d, #4a7c59);
    color: white;
    padding: 15px 30px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 1.2rem;
    box-shadow: 0 8px 25px rgba(74, 124, 89, 0.4);
    animation: pulse 3s infinite;
    position: relative;
    z-index: 1;
    transition: all 0.3s ease;
}

.user-badge:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 35px rgba(74, 124, 89, 0.6);
}

.carousel-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.1);
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
}

.carousel-title {
    color: #2d5a3d;
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(74, 124, 89, 0.1);
}

.carousel-container {
    position: relative;
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(74, 124, 89, 0.2);
    border: 3px solid #4a7c59;
}

.carousel-slide {
    position: relative;
    height: 450px;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
}

.carousel-overlay {
    background: rgba(0, 0, 0, 0.7);
    padding: 50px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(74, 124, 89, 0.4);
    animation: fadeIn 1s ease-out;
}

.carousel-overlay h3 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 20px;
    text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
    color: #4a7c59;
    animation: titleGlow 2s ease-in-out infinite alternate;
}

.carousel-overlay p {
    font-size: 1.4rem;
    opacity: 0.95;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    line-height: 1.6;
}

.carousel-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(74, 124, 89, 0.9);
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 1.8rem;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.carousel-nav:hover {
    background: #4a7c59;
    transform: translateY(-50%) scale(1.15);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
}

.carousel-nav.prev {
    left: 25px;
}

.carousel-nav.next {
    right: 25px;
}

.carousel-indicators {
    position: absolute;
    bottom: 25px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 15px;
    z-index: 10;
}

.carousel-indicator {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: rgba(74, 124, 89, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.carousel-indicator.active {
    background: #4a7c59;
    transform: scale(1.3);
    border-color: rgba(255, 255, 255, 0.8);
    box-shadow: 0 0 20px rgba(74, 124, 89, 0.6);
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.action-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 40px;
    text-align: center;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    border: 2px solid rgba(74, 124, 89, 0.2);
    min-height: 280px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.action-card:nth-child(1) { animation-delay: 0.4s; }
.action-card:nth-child(2) { animation-delay: 0.6s; }
.action-card:nth-child(3) { animation-delay: 0.8s; }

.action-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--card-color), var(--card-color-light));
}

.action-card:hover {
    transform: translateY(-20px) scale(1.03);
    box-shadow: 0 30px 80px rgba(74, 124, 89, 0.2);
    border-color: var(--card-color);
}

.action-card.book-turf { --card-color: #4a7c59; --card-color-light: #6b9c7a; }
.action-card.my-bookings { --card-color: #28a745; --card-color-light: #20c997; }
.action-card.profile { --card-color: #17a2b8; --card-color-light: #20c997; }

.action-icon {
    font-size: 4rem;
    margin-bottom: 25px;
    background: linear-gradient(135deg, var(--card-color), var(--card-color-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    transition: all 0.3s ease;
}

.action-card:hover .action-icon {
    transform: scale(1.2) rotate(5deg);
}

.action-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2d5a3d;
    margin-bottom: 20px;
}

.action-description {
    color: #4a7c59;
    margin-bottom: 30px;
    line-height: 1.7;
    font-size: 1.1rem;
}

.action-btn {
    background: linear-gradient(135deg, var(--card-color), var(--card-color-light));
    color: white;
    border: none;
    padding: 15px 35px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(74, 124, 89, 0.2);
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(74, 124, 89, 0.3);
    color: white;
    text-decoration: none;
}

.action-btn:hover::before {
    left: 100%;
}

.stats-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.1);
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 1s both;
}

.stats-title {
    color: #2d5a3d;
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(74, 124, 89, 0.1);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 25px;
}

.stat-item {
    text-align: center;
    padding: 30px 20px;
    border-radius: 20px;
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    transition: all 0.4s ease;
    border: 2px solid rgba(255, 255, 255, 0.1);
    position: relative;
    overflow: hidden;
}

.stat-item::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transform: rotate(45deg);
    transition: all 0.6s ease;
}

.stat-item:hover::before {
    animation: shimmer 1s ease-out;
}

.stat-item:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 20px 50px rgba(74, 124, 89, 0.3);
}

.stat-number {
    font-size: 3rem;
    font-weight: 900;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
}

.stat-label {
    font-size: 1.1rem;
    opacity: 0.95;
    font-weight: 600;
    position: relative;
    z-index: 1;
}

.recent-bookings {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.1);
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 1.2s both;
}

.recent-bookings h3 {
    color: #2d5a3d;
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(74, 124, 89, 0.1);
}

.booking-item {
    background: rgba(74, 124, 89, 0.05);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    border: 2px solid rgba(74, 124, 89, 0.3);
    transition: all 0.4s ease;
    animation: slideIn 0.6s ease-out;
}

.booking-item:nth-child(1) { animation-delay: 0.1s; }
.booking-item:nth-child(2) { animation-delay: 0.2s; }
.booking-item:nth-child(3) { animation-delay: 0.3s; }

.booking-item:hover {
    background: rgba(74, 124, 89, 0.1);
    transform: translateX(15px);
    border-color: rgba(74, 124, 89, 0.6);
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.2);
}

.booking-item h5 {
    color: #4a7c59;
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 1.3rem;
}

.booking-item p {
    color: #2d5a3d;
    margin-bottom: 8px;
    font-size: 1rem;
}

.no-bookings {
    text-align: center;
    color: #4a7c59;
    font-style: italic;
    padding: 60px 40px;
}

.no-bookings i {
    color: #4a7c59;
    margin-bottom: 20px;
}

.no-bookings .btn {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    border: none;
    padding: 15px 30px;
    border-radius: 25px;
    font-weight: 600;
    margin-top: 20px;
    transition: all 0.3s ease;
}

.no-bookings .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(74, 124, 89, 0.4);
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-60px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(60px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-40px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes titleGlow {
    from { text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3), 0 0 20px rgba(74, 124, 89, 0.3); }
    to { text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3), 0 0 30px rgba(74, 124, 89, 0.6); }
}

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@media (max-width: 768px) {
    .dashboard-title {
        font-size: 2.5rem;
    }
    
    .dashboard-subtitle {
        font-size: 1.1rem;
    }
    
    .carousel-slide {
        height: 350px;
    }
    
    .carousel-overlay h3 {
        font-size: 2.5rem;
    }
    
    .carousel-overlay p {
        font-size: 1.2rem;
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .dashboard-header,
    .carousel-section,
    .quick-actions,
    .stats-section,
    .recent-bookings {
        padding: 25px;
        margin-bottom: 25px;
    }
}
</style>

<div class="dashboard-container">
    <div class="dashboard-content">
        <div class="container">
            <!-- Dashboard Header -->
            <div class="dashboard-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="dashboard-title">
                            <i class="fas fa-tachometer-alt me-3"></i>Welcome to Your Dashboard
                        </h1>
                        <p class="dashboard-subtitle">Experience the thrill of sports excellence with our premium turf facilities</p>
                    </div>
                    <span class="user-badge">
                        <i class="fas fa-user me-2"></i>{{ $user->name }}
                    </span>
                </div>
            </div>

            <!-- Carousel Section -->
            @if($carouselImages->count() > 0)
            <div class="carousel-section">
                <h2 class="carousel-title">
                    <i class="fas fa-images me-2"></i>Featured Sports Venues
                </h2>
                <div class="carousel-container">
                    @foreach($carouselImages as $index => $image)
                    <div class="carousel-slide" id="slide{{ $index + 1 }}" 
                         style="background-image: url('{{ $image->image_url }}'); {{ $index > 0 ? 'display: none;' : '' }}">
                        <div class="carousel-overlay">
                            <h3>{{ $image->title }}</h3>
                            <p>{{ $image->description ?? 'Experience the thrill of sports excellence' }}</p>
                        </div>
                    </div>
                    @endforeach
                    
                    @if($carouselImages->count() > 1)
                    <button class="carousel-nav prev" onclick="changeSlide(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="carousel-nav next" onclick="changeSlide(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    
                    <div class="carousel-indicators">
                        @foreach($carouselImages as $index => $image)
                        <div class="carousel-indicator {{ $index === 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})"></div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="quick-actions">
                <div class="action-card book-turf">
                    <div class="action-icon">
                        <i class="fas fa-futbol"></i>
                    </div>
                    <h3 class="action-title">Book Turf</h3>
                    <p class="action-description">Reserve your preferred turf for an exciting game session. Choose from our variety of sports facilities.</p>
                    <a href="{{ route('user.book-turf') }}" class="action-btn">
                        <i class="fas fa-calendar-plus me-2"></i>Book Now
                    </a>
                </div>
                
                <div class="action-card my-bookings">
                    <div class="action-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="action-title">My Bookings</h3>
                    <p class="action-description">View and manage your current and past turf bookings. Track your sporting activities.</p>
                    <a href="{{ route('user.bookings.index') }}" class="action-btn">
                        <i class="fas fa-list me-2"></i>View Bookings
                    </a>
                </div>
                
                <div class="action-card profile">
                    <div class="action-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <h3 class="action-title">Profile Settings</h3>
                    <p class="action-description">Update your profile information and preferences. Manage your account settings.</p>
                    <a href="{{ route('user.profile') }}" class="action-btn">
                        <i class="fas fa-cog me-2"></i>Edit Profile
                    </a>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="stats-section">
                <h2 class="stats-title">
                    <i class="fas fa-chart-bar me-2"></i>Your Activity Overview
                </h2>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">{{ $totalBookings }}</div>
                        <div class="stat-label">Total Bookings</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $activeBookings }}</div>
                        <div class="stat-label">Active Bookings</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $completedBookings }}</div>
                        <div class="stat-label">Completed Games</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $recentBookings->count() }}</div>
                        <div class="stat-label">Recent Activities</div>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="recent-bookings">
                <h3 class="stats-title">
                    <i class="fas fa-history me-2"></i>Recent Bookings
                </h3>
                @if($recentBookings->count() > 0)
                    @foreach($recentBookings as $booking)
                    <div class="booking-item">
                        <h5>{{ $booking->turf->name }}</h5>
                        <p><i class="fas fa-calendar me-2"></i>{{ $booking->booking_date->format('M d, Y') }}</p>
                        <p><i class="fas fa-clock me-2"></i>{{ $booking->start_time }} ({{ $booking->duration_hours }} hours)</p>
                        <p><i class="fas fa-dollar-sign me-2"></i>Total: ${{ $booking->total_amount }}</p>
                        <span class="badge {{ $booking->getStatusBadgeClass() }}">{{ ucfirst($booking->status) }}</span>
                    </div>
                    @endforeach
                @else
                    <div class="no-bookings">
                        <i class="fas fa-calendar-times fa-4x mb-3"></i>
                        <p>No recent bookings to display.</p>
                        <a href="{{ route('user.book-turf') }}" class="btn">
                            <i class="fas fa-plus me-2"></i>Book Your First Turf
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($carouselImages->count() > 1)
<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-slide');
const indicators = document.querySelectorAll('.carousel-indicator');

function showSlide(n) {
    slides.forEach(slide => slide.style.display = 'none');
    indicators.forEach(indicator => indicator.classList.remove('active'));
    
    slides[n].style.display = 'flex';
    indicators[n].classList.add('active');
}

function changeSlide(direction) {
    currentSlide += direction;
    if (currentSlide >= slides.length) currentSlide = 0;
    if (currentSlide < 0) currentSlide = slides.length - 1;
    showSlide(currentSlide);
}

function goToSlide(n) {
    currentSlide = n;
    showSlide(currentSlide);
}

// Auto-advance carousel
setInterval(() => {
    changeSlide(1);
}, 6000);

// Initialize first slide
showSlide(0);
</script>
@endif
@endsection
