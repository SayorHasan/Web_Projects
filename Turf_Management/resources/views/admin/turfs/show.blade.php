@extends('layouts.app')

@section('content')
<style>
.show-container {
    background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
    min-height: 100vh;
    padding: 20px 0;
    position: relative;
    overflow-x: hidden;
}

.show-container::before {
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

.show-content {
    position: relative;
    z-index: 1;
}

.show-header {
    background: linear-gradient(135deg, rgba(74, 124, 89, 0.95), rgba(107, 156, 122, 0.95));
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    border: 2px solid rgba(74, 124, 89, 0.3);
    animation: slideDown 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.show-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 4s infinite;
}

.show-title {
    color: #ffffff;
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
}

.show-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.3rem;
    margin-bottom: 0;
    position: relative;
    z-index: 1;
}

.back-btn {
    background: linear-gradient(135deg, #6c757d, #495057);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
    position: relative;
    z-index: 1;
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(108, 117, 125, 0.6);
    color: white;
    text-decoration: none;
}

.turf-details-card {
    background: rgba(26, 32, 44, 0.9);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.3s both;
}

.turf-image-section {
    text-align: center;
    margin-bottom: 40px;
}

.turf-image {
    width: 100%;
    max-width: 600px;
    height: 400px;
    object-fit: cover;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
    border: 3px solid #4a7c59;
    transition: all 0.3s ease;
}

.turf-image:hover {
    transform: scale(1.02);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
}

.turf-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.info-section {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 20px;
    padding: 25px;
    border: 2px solid rgba(74, 124, 89, 0.2);
    transition: all 0.3s ease;
}

.info-section:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(74, 124, 89, 0.4);
    transform: translateY(-5px);
}

.section-title {
    color: #4a7c59;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    color: rgba(255, 255, 255, 0.8);
    font-weight: 600;
    font-size: 1rem;
}

.info-value {
    color: #ffffff;
    font-weight: 700;
    font-size: 1.1rem;
}

.turf-status-badge {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-align: center;
    margin: 10px 0;
}

.turf-status-badge.available {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
}

.turf-status-badge.maintenance {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
    color: #212529;
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
}

.turf-status-badge.booked {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
    color: white;
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
}

.features-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.feature-item {
    background: rgba(74, 124, 89, 0.2);
    border-radius: 15px;
    padding: 15px 20px;
    margin-bottom: 10px;
    color: #ffffff;
    font-weight: 600;
    text-align: center;
    border: 1px solid rgba(74, 124, 89, 0.3);
    transition: all 0.3s ease;
}

.feature-item:hover {
    background: rgba(74, 124, 89, 0.3);
    transform: translateX(10px);
}

.turf-actions {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 2px solid rgba(74, 124, 89, 0.2);
}

.action-btn {
    padding: 15px 30px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.action-btn.edit {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
    color: #212529;
}

.action-btn.delete {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
    color: white;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    color: inherit;
    text-decoration: none;
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

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

@media (max-width: 768px) {
    .show-title {
        font-size: 2.5rem;
    }
    
    .turf-info-grid {
        grid-template-columns: 1fr;
    }
    
    .turf-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .show-header,
    .turf-details-card {
        padding: 25px;
        margin-bottom: 25px;
    }
}
</style>

<div class="show-container">
    <div class="show-content">
        <div class="container">
            <!-- Show Header -->
            <div class="show-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="show-title">
                            <i class="fas fa-eye me-3"></i>Turf Details
                        </h1>
                        <p class="show-subtitle">View complete information about {{ $turf->name }}</p>
                    </div>
                    <a href="{{ route('admin.turfs.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left me-2"></i>Back to Turfs
                    </a>
                </div>
            </div>

            <!-- Turf Details Card -->
            <div class="turf-details-card">
                <!-- Turf Image -->
                <div class="turf-image-section">
                    <img src="{{ asset('storage/' . $turf->image_path) }}" alt="{{ $turf->name }}" class="turf-image">
                </div>

                <!-- Turf Information Grid -->
                <div class="turf-info-grid">
                    <!-- Basic Information -->
                    <div class="info-section">
                        <h3 class="section-title">
                            <i class="fas fa-info-circle me-2"></i>Basic Information
                        </h3>
                        <div class="info-item">
                            <span class="info-label">Name:</span>
                            <span class="info-value">{{ $turf->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Sport Type:</span>
                            <span class="info-value">{{ ucfirst($turf->sport_type) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Price per Hour:</span>
                            <span class="info-value">${{ $turf->price_per_hour }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Created:</span>
                            <span class="info-value">{{ $turf->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Last Updated:</span>
                            <span class="info-value">{{ $turf->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <!-- Status & Features -->
                    <div class="info-section">
                        <h3 class="section-title">
                            <i class="fas fa-cogs me-2"></i>Status & Features
                        </h3>
                        <div class="text-center mb-3">
                            <span class="turf-status-badge {{ $turf->status }}">
                                {{ ucfirst($turf->status) }}
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Total Features:</span>
                            <span class="info-value">{{ count($turf->features) }}</span>
                        </div>
                        @if(count($turf->features) > 0)
                            <ul class="features-list">
                                @foreach($turf->features as $feature)
                                    <li class="feature-item">
                                        <i class="fas fa-check me-2"></i>{{ ucfirst(str_replace('_', ' ', $feature)) }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-center text-muted" style="color: rgba(255, 255, 255, 0.6) !important;">
                                No features added yet
                            </p>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="info-section">
                        <h3 class="section-title">
                            <i class="fas fa-align-left me-2"></i>Description
                        </h3>
                        <p style="color: rgba(255, 255, 255, 0.9); line-height: 1.7; font-size: 1.1rem;">
                            {{ $turf->description }}
                        </p>
                    </div>
                </div>

                <!-- Turf Actions -->
                <div class="turf-actions">
                    <a href="{{ route('admin.turfs.edit', $turf) }}" class="action-btn edit">
                        <i class="fas fa-edit"></i>Edit Turf
                    </a>
                    <form action="{{ route('admin.turfs.destroy', $turf) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete" onclick="return confirm('Are you sure you want to delete this turf? This action cannot be undone.')">
                            <i class="fas fa-trash"></i>Delete Turf
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
