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

.form-section {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(74, 124, 89, 0.05);
    border: 1px solid #e8f5e8;
}

.section-title {
    color: #2d5a3d;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    color: #2d5a3d;
    font-weight: 600;
    font-size: 0.95rem;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e8f5e8;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #ffffff;
    color: #2d5a3d;
}

.form-control:focus {
    outline: none;
    border-color: #4a7c59;
    background: white;
    box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.1);
    transform: translateY(-2px);
}

.form-control.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
}

.form-control.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25);
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #dc3545;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.form-check-input {
    width: 20px;
    height: 20px;
    border: 2px solid #e8f5e8;
    border-radius: 4px;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #4a7c59;
    border-color: #4a7c59;
}

.form-check-label {
    color: #2d5a3d;
    font-weight: 600;
    cursor: pointer;
}

.file-upload-area {
    border: 2px dashed #e8f5e8;
    border-radius: 12px;
    padding: 40px 20px;
    text-align: center;
    transition: all 0.3s ease;
    background: #f8fff8;
    cursor: pointer;
}

.file-upload-area:hover {
    border-color: #4a7c59;
    background: #e8f5e8;
}

.file-upload-area.dragover {
    border-color: #4a7c59;
    background: #e8f5e8;
    transform: scale(1.02);
}

.file-upload-icon {
    font-size: 3rem;
    color: #4a7c59;
    margin-bottom: 15px;
}

.file-upload-text {
    color: #2d5a3d;
    font-weight: 600;
    margin-bottom: 10px;
}

.file-upload-hint {
    color: #4a7c59;
    font-size: 0.9rem;
}

.image-preview {
    max-width: 100%;
    max-height: 300px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(74, 124, 89, 0.1);
    margin-top: 20px;
}

.btn-group {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 30px;
}

.btn-back {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
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

.btn-create {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-create:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(74, 124, 89, 0.3);
}

.btn-create::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-create:hover::before {
    left: 100%;
}

.alert {
    border-radius: 12px;
    border: none;
    padding: 15px 20px;
    margin-bottom: 25px;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    color: #721c24;
    border-left: 4px solid #dc3545;
}

.alert ul {
    margin-bottom: 0;
    padding-left: 20px;
}

.alert li {
    margin-bottom: 5px;
}

.alert li:last-child {
    margin-bottom: 0;
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
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .btn-group {
        flex-direction: column;
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
                <i class="fas fa-plus-circle me-3"></i>Add New Carousel Image
            </h1>
            <p class="text-muted">Create a new carousel image to showcase your turfs and facilities</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="carousel-card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.carousel.store') }}" enctype="multipart/form-data" id="carousel-form">
                        @csrf
                        
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-image"></i>Image Details
                            </h3>
                            
                            <div class="form-group">
                                <label for="title" class="form-label">
                                    <i class="fas fa-heading me-2"></i>Title
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title') }}" 
                                       required placeholder="Enter image title">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="description" class="form-label">
                                    <i class="fas fa-align-left me-2"></i>Description
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4" 
                                          placeholder="Enter image description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="sport_type" class="form-label">
                                        <i class="fas fa-futbol me-2"></i>Sport Type
                                    </label>
                                    <select class="form-control @error('sport_type') is-invalid @enderror" 
                                            id="sport_type" name="sport_type">
                                        <option value="">Select Sport Type</option>
                                        <option value="football" {{ old('sport_type') == 'football' ? 'selected' : '' }}>Football</option>
                                        <option value="cricket" {{ old('sport_type') == 'cricket' ? 'selected' : '' }}>Cricket</option>
                                        <option value="tennis" {{ old('sport_type') == 'tennis' ? 'selected' : '' }}>Tennis</option>
                                        <option value="basketball" {{ old('sport_type') == 'basketball' ? 'selected' : '' }}>Basketball</option>
                                        <option value="volleyball" {{ old('sport_type') == 'volleyball' ? 'selected' : '' }}>Volleyball</option>
                                        <option value="badminton" {{ old('sport_type') == 'badminton' ? 'selected' : '' }}>Badminton</option>
                                        <option value="other" {{ old('sport_type') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('sport_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="order" class="form-label">
                                        <i class="fas fa-sort-numeric-up me-2"></i>Display Order
                                    </label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                           id="order" name="order" value="{{ old('order', 0) }}" 
                                           min="0" placeholder="Enter display order">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                       {{ old('is_active') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <i class="fas fa-toggle-on me-2"></i>Active (Show on homepage)
                                </label>
                            </div>
                        </div>

                        <div class="form-section" style="margin-top: 30px;">
                            <h3 class="section-title">
                                <i class="fas fa-upload"></i>Upload Image
                            </h3>
                            
                            <div class="form-group">
                                <label for="image" class="form-label">
                                    <i class="fas fa-image me-2"></i>Carousel Image
                                </label>
                                <div class="file-upload-area" onclick="document.getElementById('image').click()">
                                    <div class="file-upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div class="file-upload-text">Click to upload or drag and drop</div>
                                    <div class="file-upload-hint">PNG, JPG, JPEG, GIF up to 2MB</div>
                                    <input type="file" id="image" name="image" accept="image/*" 
                                           class="d-none" required>
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                <div id="image-preview-container" style="display: none;">
                                    <img id="image-preview" class="image-preview" alt="Preview">
                                </div>
                            </div>
                        </div>
                        
                        <div class="btn-group">
                            <a href="{{ route('admin.carousel.index') }}" class="btn-back">
                                <i class="fas fa-arrow-left me-2"></i>Back to Carousel
                            </a>
                            <button type="submit" class="btn-create" id="submit-btn">
                                <i class="fas fa-save me-2"></i>Create Carousel Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// File upload handling
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
            document.getElementById('image-preview-container').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

// Drag and drop functionality
const uploadArea = document.querySelector('.file-upload-area');

uploadArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.classList.remove('dragover');
});

uploadArea.addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('dragover');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        const file = files[0];
        if (file.type.startsWith('image/')) {
            document.getElementById('image').files = files;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview-container').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
});

// Form submission handling
document.getElementById('carousel-form').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submit-btn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';
    submitBtn.disabled = true;
    
    // Re-enable button after 5 seconds in case of error
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 5000);
});
</script>
@endsection
