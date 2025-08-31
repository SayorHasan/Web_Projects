@extends('layouts.app')

@section('content')
<style>
.turfs-container {
    background: linear-gradient(135deg, #f8fff8 0%, #e8f5e8 50%, #d4edda 100%);
    min-height: 100vh;
    padding: 20px 0;
    position: relative;
    overflow-x: hidden;
}

.turfs-container::before {
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

.turfs-content {
    position: relative;
    z-index: 1;
}

.turfs-header {
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

.turfs-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 4s infinite;
}

.turfs-title {
    color: #ffffff;
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
}

.turfs-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.3rem;
    margin-bottom: 0;
    position: relative;
    z-index: 1;
}

.create-btn {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    position: relative;
    z-index: 1;
}

.create-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(40, 167, 69, 0.6);
    color: white;
    text-decoration: none;
}

.turfs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.turf-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.1);
    border: 2px solid rgba(74, 124, 89, 0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.turf-card:nth-child(1) { animation-delay: 0.1s; }
.turf-card:nth-child(2) { animation-delay: 0.2s; }
.turf-card:nth-child(3) { animation-delay: 0.3s; }
.turf-card:nth-child(4) { animation-delay: 0.4s; }

.turf-card:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 30px 80px rgba(74, 124, 89, 0.2);
    border-color: #4a7c59;
}

.turf-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: all 0.3s ease;
}

.turf-card:hover .turf-image {
    transform: scale(1.05);
}

.turf-body {
    padding: 30px;
}

.turf-name {
    color: #2d5a3d;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(74, 124, 89, 0.1);
}

.turf-description {
    color: #4a7c59;
    margin-bottom: 20px;
    line-height: 1.6;
    font-size: 1rem;
}

.turf-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 25px;
}

.turf-detail {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #2d5a3d;
    font-size: 0.95rem;
}

.turf-detail i {
    color: #4a7c59;
    font-size: 1.1rem;
}

.turf-status {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 20px;
}

.turf-status.available {
    background: #28a745;
    color: white;
}

.turf-status.maintenance {
    background: #ffc107;
    color: #212529;
}

.turf-status.booked {
    background: #dc3545;
    color: white;
}

.turf-actions {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.turf-btn {
    padding: 12px 20px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 3px 10px rgba(74, 124, 89, 0.2);
}

.turf-btn.view {
    background: linear-gradient(135deg, #17a2b8, #20c997);
    color: white;
}

.turf-btn.edit {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
    color: #212529;
}

.turf-btn.delete {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
    color: white;
}

.turf-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(74, 124, 89, 0.3);
    color: inherit;
    text-decoration: none;
}

.no-turfs {
    text-align: center;
    color: #4a7c59;
    padding: 80px 40px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.5s both;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.1);
}

.no-turfs i {
    color: #4a7c59;
    font-size: 4rem;
    margin-bottom: 20px;
}

.no-turfs h3 {
    color: #2d5a3d;
    font-size: 2rem;
    margin-bottom: 15px;
}

.no-turfs p {
    font-size: 1.1rem;
    margin-bottom: 25px;
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
    .turfs-title {
        font-size: 2.5rem;
    }
    
    .turfs-grid {
        grid-template-columns: 1fr;
    }
    
    .turf-details {
        grid-template-columns: 1fr;
    }
    
    .turf-actions {
        flex-direction: column;
    }
    
    .turfs-header {
        padding: 25px;
        margin-bottom: 25px;
    }
}
</style>

<div class="turfs-container">
    <div class="turfs-content">
        <div class="container">
            <!-- Turfs Header -->
            <div class="turfs-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="turfs-title">
                            <i class="fas fa-futbol me-3"></i>Manage Turfs
                        </h1>
                        <p class="turfs-subtitle">Manage all your sports facilities and turf locations</p>
                    </div>
                    <a href="{{ route('admin.turfs.create') }}" class="create-btn">
                        <i class="fas fa-plus me-2"></i>Add New Turf
                    </a>
                </div>
            </div>

            <!-- Turfs Grid -->
            @if($turfs->count() > 0)
                <div class="turfs-grid">
                    @foreach($turfs as $turf)
                    <div class="turf-card">
                        <img src="{{ asset('storage/' . $turf->image_path) }}" alt="{{ $turf->name }}" class="turf-image">
                        <div class="turf-body">
                            <h3 class="turf-name">{{ $turf->name }}</h3>
                            <p class="turf-description">{{ Str::limit($turf->description, 100) }}</p>
                            
                            <div class="turf-details">
                                <div class="turf-detail">
                                    <i class="fas fa-sport"></i>
                                    <span>{{ $turf->sport_display }}</span>
                                </div>
                                <div class="turf-detail">
                                    <i class="fas fa-dollar-sign"></i>
                                    <span>${{ $turf->price_per_hour }}/hour</span>
                                </div>
                                <div class="turf-detail">
                                    <i class="fas fa-list"></i>
                                    <span>{{ count($turf->features) }} features</span>
                                </div>
                                <div class="turf-detail">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $turf->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            
                            <span class="turf-status {{ $turf->status }}">{{ ucfirst($turf->status) }}</span>
                            
                            <div class="turf-actions">
                                <a href="{{ route('admin.turfs.show', $turf) }}" class="turf-btn view">
                                    <i class="fas fa-eye"></i>View
                                </a>
                                <a href="{{ route('admin.turfs.edit', $turf) }}" class="turf-btn edit">
                                    <i class="fas fa-edit"></i>Edit
                                </a>
                                <form action="{{ route('admin.turfs.destroy', $turf) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="turf-btn delete" onclick="return confirm('Are you sure you want to delete this turf?')">
                                        <i class="fas fa-trash"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="no-turfs">
                    <i class="fas fa-futbol"></i>
                    <h3>No Turfs Found</h3>
                    <p>You haven't added any turfs yet. Start by creating your first sports facility.</p>
                    <a href="{{ route('admin.turfs.create') }}" class="create-btn">
                        <i class="fas fa-plus me-2"></i>Create Your First Turf
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
