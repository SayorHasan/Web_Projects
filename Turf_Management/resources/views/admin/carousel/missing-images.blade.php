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

.missing-images-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    animation: slideUp 0.6s ease-out 0.2s both;
    border: 1px solid #e8f5e8;
}

.missing-image-item {
    background: white;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 5px 20px rgba(74, 124, 89, 0.1);
    border: 1px solid #e8f5e8;
    transition: all 0.3s ease;
}

.missing-image-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.2);
}

.missing-image-title {
    color: #2d5a3d;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.missing-image-path {
    color: #dc3545;
    font-family: monospace;
    background: #f8d7da;
    padding: 5px 10px;
    border-radius: 5px;
    margin-bottom: 15px;
    font-size: 0.9rem;
}

.missing-image-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-fix {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    border: none;
    padding: 8px 15px;
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

.btn-fix:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    color: white;
    text-decoration: none;
}

.btn-delete {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    border: none;
    padding: 8px 15px;
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

.btn-delete:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    color: white;
    text-decoration: none;
}

.no-missing-images {
    text-align: center;
    padding: 60px 20px;
    color: #4a7c59;
}

.no-missing-images h3 {
    color: #2d5a3d;
    margin-bottom: 15px;
    font-weight: 700;
}

.no-missing-images p {
    margin-bottom: 30px;
    font-size: 1.1rem;
}

.btn-back {
    background: linear-gradient(135deg, #6c757d, #5a6268);
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

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    color: white;
    text-decoration: none;
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
    
    .missing-image-actions {
        flex-direction: column;
    }
    
    .btn-fix,
    .btn-delete {
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
                        <i class="fas fa-exclamation-triangle me-3"></i>Missing Carousel Images
                    </h1>
                    <p class="text-muted mb-0">Check and fix carousel images with missing files</p>
                </div>
                <a href="{{ route('admin.carousel.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>Back to Carousel
                </a>
            </div>
        </div>

        <!-- Missing Images Section -->
        <div class="missing-images-section">
            @if($missingImages->count() > 0)
                <h2 class="mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Found {{ $missingImages->count() }} missing image(s)
                </h2>
                
                @foreach($missingImages as $image)
                    <div class="missing-image-item">
                        <h3 class="missing-image-title">{{ $image->title }}</h3>
                        <div class="missing-image-path">
                            <i class="fas fa-file-image me-2"></i>
                            {{ $image->image_path }}
                        </div>
                        <p class="text-muted mb-3">
                            <strong>Description:</strong> {{ $image->description ?: 'No description' }}<br>
                            <strong>Sport Type:</strong> {{ $image->sport_type ?: 'Not specified' }}<br>
                            <strong>Order:</strong> {{ $image->order }}<br>
                            <strong>Status:</strong> {{ $image->is_active ? 'Active' : 'Inactive' }}
                        </p>
                        
                        <div class="missing-image-actions">
                            <a href="{{ route('admin.carousel.edit', ['carousel' => $image->id]) }}" class="btn-fix">
                                <i class="fas fa-upload"></i>Upload New Image
                            </a>
                            <form action="{{ route('admin.carousel.destroy', ['carousel' => $image->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this carousel image?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    <i class="fas fa-trash"></i>Delete Entry
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-missing-images">
                    <h3><i class="fas fa-check-circle me-2"></i>No Missing Images</h3>
                    <p>All carousel images have their corresponding files in place.</p>
                    <a href="{{ route('admin.carousel.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Back to Carousel Management
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
