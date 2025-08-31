@extends('layouts.app')

@section('content')
<style>
.carousel-container {
    background: linear-gradient(135deg, #f8fff8 0%, #e8f5e8 50%, #d4edda 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.carousel-header {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    animation: slideDown 0.6s ease-out;
    border: 1px solid #e8f5e8;
}

.carousel-title {
    color: #2d5a3d;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Live Carousel Display Styles */
.live-carousel-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    border: 1px solid #e8f5e8;
}

.live-carousel-title {
    color: #2d5a3d;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
}

#liveCarousel {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.2);
    border: 3px solid #e8f5e8;
}

.carousel-image-container {
    position: relative;
    height: 500px;
    overflow: hidden;
}

.carousel-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.carousel-item:hover .carousel-image-container img {
    transform: scale(1.05);
}

.carousel-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(45, 90, 61, 0.8) 0%, rgba(74, 124, 89, 0.6) 50%, rgba(107, 156, 122, 0.4) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 40px;
}

.carousel-content {
    color: white;
    max-width: 600px;
}

.carousel-title-text {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 0.8s ease-out;
}

.carousel-description {
    font-size: 1.2rem;
    margin-bottom: 20px;
    line-height: 1.6;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.carousel-sport-badge {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
    display: inline-block;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

.carousel-admin-controls {
    animation: fadeInUp 0.8s ease-out 0.6s both;
}

.carousel-admin-controls .btn {
    border-radius: 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
}

.carousel-admin-controls .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

.carousel-indicators {
    bottom: 30px;
}

.carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.5);
    border: 2px solid rgba(255, 255, 255, 0.3);
    margin: 0 5px;
    transition: all 0.3s ease;
}

.carousel-indicators button.active {
    background-color: #4a7c59;
    border-color: #4a7c59;
    transform: scale(1.2);
}

.carousel-control-prev,
.carousel-control-next {
    width: 60px;
    height: 60px;
    background: rgba(74, 124, 89, 0.8);
    border-radius: 50%;
    border: 3px solid rgba(255, 255, 255, 0.3);
    top: 50%;
    transform: translateY(-50%);
    transition: all 0.3s ease;
}

.carousel-control-prev {
    left: 20px;
}

.carousel-control-next {
    right: 20px;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    background: rgba(74, 124, 89, 1);
    border-color: rgba(255, 255, 255, 0.8);
    transform: translateY(-50%) scale(1.1);
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 30px;
    height: 30px;
}

/* Management Grid Styles */
.management-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    animation: slideUp 0.6s ease-out 0.2s both;
    border: 1px solid #e8f5e8;
}

.management-title {
    color: #2d5a3d;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
}

.carousel-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.carousel-item {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(74, 124, 89, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e8f5e8;
}

.carousel-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(74, 124, 89, 0.2);
}

.carousel-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
}

.carousel-content-grid {
    padding: 20px;
}

.carousel-item-title {
    color: #2d5a3d;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.carousel-item-description {
    color: #4a7c59;
    font-size: 0.9rem;
    margin-bottom: 15px;
    line-height: 1.5;
}

.carousel-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 0.85rem;
}

.carousel-sport {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    padding: 4px 12px;
    border-radius: 15px;
    font-weight: 600;
}

.carousel-status {
    padding: 4px 12px;
    border-radius: 15px;
    font-weight: 600;
    font-size: 0.8rem;
}

.carousel-status.active {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.carousel-status.inactive {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    color: white;
}

.carousel-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
}

.carousel-btn {
    padding: 8px 15px;
    border: none;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.carousel-btn.view {
    background: linear-gradient(135deg, #17a2b8, #138496);
    color: white;
}

.carousel-btn.edit {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: #212529;
}

.carousel-btn.delete {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
}

.carousel-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    text-decoration: none;
}

.add-carousel-btn {
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

.add-carousel-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(74, 124, 89, 0.3);
    color: white;
    text-decoration: none;
}

.add-carousel-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.add-carousel-btn:hover::before {
    left: 100%;
}

.btn-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: #212529;
    border: none;
    padding: 12px 20px;
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

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(255, 193, 7, 0.3);
    color: #212529;
    text-decoration: none;
}

.no-carousel {
    text-align: center;
    padding: 60px 20px;
    color: #4a7c59;
}

.no-carousel h3 {
    color: #2d5a3d;
    margin-bottom: 15px;
    font-weight: 700;
}

.no-carousel p {
    margin-bottom: 30px;
    font-size: 1.1rem;
}

.alert {
    border-radius: 12px;
    border: none;
    padding: 15px 20px;
    margin-bottom: 25px;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    color: #721c24;
    border-left: 4px solid #dc3545;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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

/* Responsive Design */
@media (max-width: 768px) {
    .carousel-title {
        font-size: 2rem;
    }
    
    .live-carousel-title,
    .management-title {
        font-size: 1.5rem;
    }
    
    .carousel-image-container {
        height: 300px;
    }
    
    .carousel-title-text {
        font-size: 1.8rem;
    }
    
    .carousel-description {
        font-size: 1rem;
    }
    
    .carousel-overlay {
        padding: 20px;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
    }
    
    .carousel-control-prev {
        left: 10px;
    }
    
    .carousel-control-next {
        right: 10px;
    }
    
    .carousel-grid {
        grid-template-columns: 1fr;
    }
    
    .carousel-actions {
        flex-direction: column;
    }
    
    .carousel-btn {
        justify-content: center;
    }
}
</style>

<div class="carousel-container">
    <div class="container">
        <!-- Carousel Header -->
        <div class="carousel-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="carousel-title">
                        <i class="fas fa-images me-3"></i>Carousel Management
                    </h1>
                    <p class="text-muted mb-0">Manage the homepage carousel images and their display order</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.carousel.missing-images') }}" class="btn btn-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>Check Missing Images
                    </a>
                    <a href="{{ route('admin.carousel.create') }}" class="add-carousel-btn">
                        <i class="fas fa-plus"></i>Add New Image
                    </a>
                </div>
            </div>
        </div>

        <!-- Live Carousel Display -->
        @php
            $activeCarousels = \App\Http\Controllers\CarouselController::getActiveCarousels();
        @endphp
        
        @if($activeCarousels->count() > 0)
            <div class="live-carousel-section">
                <h2 class="live-carousel-title">
                    <i class="fas fa-play-circle me-2"></i>Live Carousel Preview
                </h2>
                <p class="text-center text-muted mb-4">This is how your carousel appears on the main page</p>
                
                <div id="liveCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($activeCarousels as $index => $carousel)
                            <button type="button" data-bs-target="#liveCarousel" data-bs-slide-to="{{ $index }}" 
                                    class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                                    aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    
                    <div class="carousel-inner">
                        @foreach($activeCarousels as $index => $carousel)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="carousel-image-container">
                                    @if($carousel->image_exists)
                                        <img src="{{ $carousel->image_url }}" class="d-block w-100" alt="{{ $carousel->title }}">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100" style="background: linear-gradient(135deg, #4a7c59, #6b9c7a);">
                                            <div class="text-center text-white">
                                                <i class="fas fa-image" style="font-size: 4rem; margin-bottom: 1rem;"></i>
                                                <p>Image file not found</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="carousel-overlay">
                                        <div class="carousel-content">
                                            <h3 class="carousel-title-text">{{ $carousel->title }}</h3>
                                            @if($carousel->description)
                                                <p class="carousel-description">{{ $carousel->description }}</p>
                                            @endif
                                            @if($carousel->sport_type)
                                                <span class="carousel-sport-badge">{{ ucfirst($carousel->sport_type) }}</span>
                                            @endif
                                            <div class="carousel-admin-controls mt-3">
                                                <a href="{{ route('admin.carousel.edit', ['carousel' => $carousel->id]) }}" class="btn btn-light btn-sm me-2">
                                                    <i class="fas fa-edit me-1"></i>Edit This Image
                                                </a>
                                                <a href="{{ route('admin.carousel.show', ['carousel' => $carousel->id]) }}" class="btn btn-outline-light btn-sm">
                                                    <i class="fas fa-eye me-1"></i>View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($activeCarousels->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#liveCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#liveCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            </div>
        @endif

        <!-- Management Section -->
        <div class="management-section">
            <h2 class="management-title">
                <i class="fas fa-cogs me-2"></i>Manage All Carousel Images
            </h2>
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            @if($carouselImages->count() > 0)
                <div class="carousel-grid">
                    @foreach($carouselImages as $image)
                        <div class="carousel-item">
                            <div class="carousel-image">
                                @if($image->image_exists)
                                    <img src="{{ $image->image_url }}" alt="{{ $image->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="fas fa-image"></i>
                                    @if($image->image_path)
                                        <div class="mt-2">
                                            <small class="text-danger">File missing</small>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="carousel-content-grid">
                                <h3 class="carousel-item-title">{{ $image->title }}</h3>
                                <p class="carousel-item-description">{{ Str::limit($image->description, 100) }}</p>
                                
                                <div class="carousel-meta">
                                    @if($image->sport_type)
                                        <span class="carousel-sport">{{ $image->sport_type }}</span>
                                    @endif
                                    <span class="carousel-status {{ $image->is_active ? 'active' : 'inactive' }}">
                                        {{ $image->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                
                                <div class="carousel-actions">
                                    <a href="{{ route('admin.carousel.show', ['carousel' => $image->id]) }}" class="carousel-btn view">
                                        <i class="fas fa-eye"></i>View
                                    </a>
                                    <a href="{{ route('admin.carousel.edit', ['carousel' => $image->id]) }}" class="carousel-btn edit">
                                        <i class="fas fa-edit"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.carousel.destroy', ['carousel' => $image->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this carousel image?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="carousel-btn delete">
                                            <i class="fas fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-carousel">
                    <h3><i class="fas fa-images me-2"></i>No Carousel Images</h3>
                    <p>Get started by adding your first carousel image to showcase your turfs and facilities.</p>
                    <a href="{{ route('admin.carousel.create') }}" class="add-carousel-btn">
                        <i class="fas fa-plus me-2"></i>Add First Image
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Carousel Enhancement Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('liveCarousel');
        if (carousel) {
            // Initialize Bootstrap carousel with custom options
            const bsCarousel = new bootstrap.Carousel(carousel, {
                interval: 5000, // Auto-advance every 5 seconds
                wrap: true,     // Loop continuously
                pause: 'hover'  // Pause on hover
            });
            
            // Add smooth transitions
            carousel.addEventListener('slide.bs.carousel', function (event) {
                const activeItem = carousel.querySelector('.carousel-item.active');
                const nextItem = carousel.querySelectorAll('.carousel-item')[event.to];
                
                if (activeItem) {
                    activeItem.style.transition = 'opacity 0.6s ease-in-out';
                }
                if (nextItem) {
                    nextItem.style.transition = 'opacity 0.6s ease-in-out';
                }
            });
            
            // Add keyboard navigation
            document.addEventListener('keydown', function(event) {
                if (event.key === 'ArrowLeft') {
                    bsCarousel.prev();
                } else if (event.key === 'ArrowRight') {
                    bsCarousel.next();
                }
            });
            
            // Add touch/swipe support for mobile
            let startX = 0;
            let endX = 0;
            
            carousel.addEventListener('touchstart', function(event) {
                startX = event.touches[0].clientX;
            });
            
            carousel.addEventListener('touchend', function(event) {
                endX = event.changedTouches[0].clientX;
                handleSwipe();
            });
            
            function handleSwipe() {
                const threshold = 50;
                const diff = startX - endX;
                
                if (Math.abs(diff) > threshold) {
                    if (diff > 0) {
                        // Swipe left - next slide
                        bsCarousel.next();
                    } else {
                        // Swipe right - previous slide
                        bsCarousel.prev();
                    }
                }
            }
        }
    });
</script>
@endsection
