@extends('layouts.app')

@section('content')
<style>
.create-container {
    background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
    min-height: 100vh;
    padding: 20px 0;
    position: relative;
    overflow-x: hidden;
}

.create-container::before {
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

.create-content {
    position: relative;
    z-index: 1;
}

.create-header {
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

.create-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 4s infinite;
}

.create-title {
    color: #ffffff;
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
}

.create-subtitle {
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

.create-form {
    background: rgba(26, 32, 44, 0.9);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.3s both;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    color: #ffffff;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 10px;
    display: block;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid rgba(74, 124, 89, 0.3);
    border-radius: 15px;
    font-size: 1rem;
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.form-control:focus {
    outline: none;
    border-color: #4a7c59;
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.2);
    transform: translateY(-2px);
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.form-control.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2);
}

.invalid-feedback {
    color: #ff6b6b;
    font-size: 0.9rem;
    margin-top: 8px;
    display: block;
    animation: shake 0.5s ease-in-out;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-actions {
    display: flex;
    gap: 20px;
    justify-content: flex-end;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 2px solid rgba(74, 124, 89, 0.2);
}

.submit-btn {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    border: none;
    padding: 15px 35px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(40, 167, 69, 0.6);
}

.reset-btn {
    background: linear-gradient(135deg, #6c757d, #495057);
    color: white;
    border: none;
    padding: 15px 35px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
}

.reset-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(108, 117, 125, 0.6);
}

.features-section {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 20px;
    margin-top: 10px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.feature-checkbox {
    transform: scale(1.2);
    accent-color: #4a7c59;
}

.feature-label {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    cursor: pointer;
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

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

@media (max-width: 768px) {
    .create-title {
        font-size: 2.5rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .create-header,
    .create-form {
        padding: 25px;
        margin-bottom: 25px;
    }
}
</style>

<div class="create-container">
    <div class="create-content">
        <div class="container">
            <!-- Create Header -->
            <div class="create-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="create-title">
                            <i class="fas fa-plus me-3"></i>Add New Turf
                        </h1>
                        <p class="create-subtitle">Create a new sports facility for your users</p>
                    </div>
                    <a href="{{ route('admin.turfs.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left me-2"></i>Back to Turfs
                    </a>
                </div>
            </div>

            <!-- Create Form -->
            <div class="create-form">
                <form action="{{ route('admin.turfs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-futbol me-2"></i>Turf Name
                            </label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" placeholder="Enter turf name" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-sport me-2"></i>Sport Types
                            </label>
                            <div class="features-section">
                                @php $sports = ['football','cricket','tennis','basketball','volleyball','badminton']; @endphp
                                @foreach($sports as $sport)
                                <div class="feature-item">
                                    <input type="checkbox" id="sport_{{ $sport }}" name="sport_types[]" value="{{ $sport }}" class="feature-checkbox"
                                           {{ in_array($sport, old('sport_types', [])) ? 'checked' : '' }}>
                                    <label for="sport_{{ $sport }}" class="feature-label">{{ ucfirst($sport) }}</label>
                                </div>
                                @endforeach
                            </div>
                            @error('sport_types')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left me-2"></i>Description
                        </label>
                        <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror" 
                                  placeholder="Describe the turf and its features" required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="price_per_hour" class="form-label">
                                <i class="fas fa-dollar-sign me-2"></i>Price per Hour
                            </label>
                            <input type="number" id="price_per_hour" name="price_per_hour" step="0.01" min="0" 
                                   class="form-control @error('price_per_hour') is-invalid @enderror" 
                                   value="{{ old('price_per_hour') }}" placeholder="0.00" required>
                            @error('price_per_hour')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="status" class="form-label">
                                <i class="fas fa-toggle-on me-2"></i>Status
                            </label>
                            <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="">Select status</option>
                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="booked" {{ old('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="image" class="form-label">
                            <i class="fas fa-image me-2"></i>Turf Image
                        </label>
                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" 
                               accept="image/*" required>
                        @error('image')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted" style="color: rgba(255, 255, 255, 0.6) !important;">
                            Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-list me-2"></i>Features
                        </label>
                        <div class="features-section">
                            <div class="feature-item">
                                <input type="checkbox" id="lighting" name="features[]" value="lighting" class="feature-checkbox" 
                                       {{ in_array('lighting', old('features', [])) ? 'checked' : '' }}>
                                <label for="lighting" class="feature-label">Professional Lighting</label>
                            </div>
                            <div class="feature-item">
                                <input type="checkbox" id="parking" name="features[]" value="parking" class="feature-checkbox"
                                       {{ in_array('parking', old('features', [])) ? 'checked' : '' }}>
                                <label for="parking" class="feature-label">Free Parking</label>
                            </div>
                            <div class="feature-item">
                                <input type="checkbox" id="equipment" name="features[]" value="equipment" class="feature-checkbox"
                                       {{ in_array('equipment', old('features', [])) ? 'checked' : '' }}>
                                <label for="equipment" class="feature-label">Equipment Rental</label>
                            </div>
                            <div class="feature-item">
                                <input type="checkbox" id="changing_rooms" name="features[]" value="changing_rooms" class="feature-checkbox"
                                       {{ in_array('changing_rooms', old('features', [])) ? 'checked' : '' }}>
                                <label for="changing_rooms" class="feature-label">Changing Rooms</label>
                            </div>
                            <div class="feature-item">
                                <input type="checkbox" id="refreshments" name="features[]" value="refreshments" class="feature-checkbox"
                                       {{ in_array('refreshments', old('features', [])) ? 'checked' : '' }}>
                                <label for="refreshments" class="feature-label">Refreshments</label>
                            </div>
                            <div class="feature-item">
                                <input type="checkbox" id="coaching" name="features[]" value="coaching" class="feature-checkbox"
                                       {{ in_array('coaching', old('features', [])) ? 'checked' : '' }}>
                                <label for="coaching" class="feature-label">Professional Coaching</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="reset" class="reset-btn">
                            <i class="fas fa-undo me-2"></i>Reset Form
                        </button>
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-save me-2"></i>Create Turf
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
