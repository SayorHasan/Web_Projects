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

.carousel-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    animation: slideUp 0.6s ease-out 0.2s both;
    border: 1px solid #e8f5e8;
}

.carousel-image-section {
    text-align: center;
    margin-bottom: 30px;
}

.carousel-image {
    max-width: 100%;
    max-height: 400px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.2);
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 4rem;
    margin: 0 auto;
}

.carousel-details {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(74, 124, 89, 0.05);
    border: 1px solid #e8f5e8;
}

.detail-section {
    margin-bottom: 25px;
}

.detail-label {
    color: #4a7c59;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.detail-value {
    color: #2d5a3d;
    font-size: 1.1rem;
    font-weight: 500;
    line-height: 1.6;
}

.detail-title {
    color: #2d5a3d;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.detail-description {
    color: #4a7c59;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 20px;
}

.carousel-meta {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 25px;
}

.meta-item {
    background: linear-gradient(135deg, #e8f5e8, #d4edda);
    padding: 8px 15px;
    border-radius: 20px;
    color: #2d5a3d;
    font-weight: 600;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.meta-item.status {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.meta-item.status.inactive {
    background: linear-gradient(135deg, #6c757d, #5a6268);
}

.carousel-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 30px;
    flex-wrap: wrap;
}

.carousel-btn {
    padding: 12px 25px;
    border: none;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.carousel-btn.back {
    background: linear-gradient(135deg, #6c757d, #5a6268);
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
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    text-decoration: none;
}

.carousel-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.carousel-btn:hover::before {
    left: 100%;
}

.carousel-info {
    background: linear-gradient(135deg, #e8f5e8, #d4edda);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 25px;
    border-left: 4px solid #4a7c59;
}

.carousel-info h4 {
    color: #2d5a3d;
    font-weight: 700;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.carousel-info p {
    color: #4a7c59;
    margin-bottom: 0;
    line-height: 1.6;
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

@media (max-width: 768px) {
    .carousel-title {
        font-size: 2rem;
    }
    
    .carousel-meta {
        flex-direction: column;
    }
    
    .carousel-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .carousel-btn {
        width: 100%;
        max-width: 250px;
        justify-content: center;
    }
    
    .carousel-card {
        padding: 30px 20px;
    }
}
</style>

<div class="carousel-container">
    <div class="container">
        <!-- Carousel Header -->
        <div class="carousel-header">
            <h1 class="carousel-title">
                <i class="fas fa-eye me-3"></i>Carousel Image Details
            </h1>
            <p class="text-muted">View detailed information about this carousel image</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="carousel-card">
                    <div class="carousel-image-section">
                        @if($carouselImage->image_exists)
                            <img src="{{ $carouselImage->image_url }}" 
                                 alt="{{ $carouselImage->title }}" 
                                 class="carousel-image">
                        @else
                            <div class="carousel-image" style="width: 400px; height: 300px;">
                                <i class="fas fa-image"></i>
                                <p class="mt-3 text-muted">Image not found</p>
                            </div>
                        @endif
                    </div>

                    <div class="carousel-details">
                        <div class="detail-section">
                            <div class="detail-title">{{ $carouselImage->title }}</div>
                            @if($carouselImage->description)
                                <div class="detail-description">{{ $carouselImage->description }}</div>
                            @endif
                        </div>

                        <div class="carousel-meta">
                            @if($carouselImage->sport_type)
                                <div class="meta-item">
                                    <i class="fas fa-futbol"></i>
                                    {{ ucfirst($carouselImage->sport_type) }}
                                </div>
                            @endif
                            
                            <div class="meta-item">
                                <i class="fas fa-sort-numeric-up"></i>
                                Order: {{ $carouselImage->order }}
                            </div>
                            
                            <div class="meta-item status {{ $carouselImage->is_active ? '' : 'inactive' }}">
                                <i class="fas fa-toggle-{{ $carouselImage->is_active ? 'on' : 'off' }}"></i>
                                {{ $carouselImage->is_active ? 'Active' : 'Inactive' }}
                            </div>
                        </div>

                        <div class="carousel-info">
                            <h4>
                                <i class="fas fa-info-circle"></i>
                                Image Information
                            </h4>
                            <p>
                                <strong>Created:</strong> {{ $carouselImage->created_at->format('F j, Y \a\t g:i A') }}<br>
                                <strong>Last Updated:</strong> {{ $carouselImage->updated_at->format('F j, Y \a\t g:i A') }}<br>
                                @if($carouselImage->image_path)
                                    <strong>File Path:</strong> {{ $carouselImage->image_path }}<br>
                                    <strong>File Status:</strong> 
                                    @if($carouselImage->image_exists)
                                        <span class="text-success"><i class="fas fa-check-circle"></i> File exists</span>
                                    @else
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> File missing</span>
                                    @endif
                                @endif
                            </p>
                        </div>

                        <div class="carousel-actions">
                            <a href="{{ route('admin.carousel.index') }}" class="carousel-btn back">
                                <i class="fas fa-arrow-left"></i>Back to Carousel
                            </a>
                            <a href="{{ route('admin.carousel.edit', ['carousel' => $carouselImage->id]) }}" class="carousel-btn edit">
                                <i class="fas fa-edit"></i>Edit Image
                            </a>
                            <form action="{{ route('admin.carousel.destroy', ['carousel' => $carouselImage->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this carousel image?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="carousel-btn delete">
                                    <i class="fas fa-trash"></i>Delete Image
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
