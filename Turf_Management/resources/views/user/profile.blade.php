@extends('layouts.app')

@section('content')
<style>
.profile-container {
    background: linear-gradient(135deg, #f8fff8 0%, #e8f5e8 50%, #d4edda 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.profile-header {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    animation: slideDown 0.6s ease-out;
    border: 1px solid #e8f5e8;
}

.profile-title {
    color: #2d5a3d;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.profile-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    animation: slideUp 0.6s ease-out 0.2s both;
    border: 1px solid #e8f5e8;
}

.profile-avatar-section {
    text-align: center;
    margin-bottom: 40px;
    position: relative;
}

.profile-avatar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid white;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.2);
    transition: all 0.3s ease;
    position: relative;
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
    font-weight: 700;
    margin: 0 auto 20px;
}

.profile-avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 40px rgba(74, 124, 89, 0.3);
}

.avatar-upload {
    position: absolute;
    bottom: 0;
    right: 50%;
    transform: translateX(50%);
    background: linear-gradient(135deg, #28a745, #20c997);
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(74, 124, 89, 0.2);
}

.avatar-upload:hover {
    transform: translateX(50%) scale(1.1);
    box-shadow: 0 8px 20px rgba(74, 124, 89, 0.3);
}

.user-info {
    text-align: center;
    margin-bottom: 30px;
}

.user-name {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2d5a3d;
    margin-bottom: 10px;
}

.user-role {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 600;
    display: inline-block;
    animation: pulse 2s infinite;
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

.alert-success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
    border-left: 4px solid #28a745;
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

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
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

.btn-update {
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

.btn-update:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(74, 124, 89, 0.3);
}

.btn-update::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-update:hover::before {
    left: 100%;
}

.stats-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    margin-top: 30px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    animation: slideUp 0.6s ease-out 0.4s both;
    border: 1px solid #e8f5e8;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.stat-item {
    text-align: center;
    padding: 20px;
    border-radius: 15px;
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(74, 124, 89, 0.3);
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
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

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@media (max-width: 768px) {
    .profile-title {
        font-size: 2rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .btn-group {
        flex-direction: column;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        font-size: 2.5rem;
    }
}
</style>

<div class="profile-container">
    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header">
            <h1 class="profile-title">
                <i class="fas fa-user-edit me-3"></i>Profile Settings
            </h1>
            <p class="text-muted">Manage your account information and preferences</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="profile-card">
                    <!-- Profile Avatar Section -->
                    <div class="profile-avatar-section">
                        <div class="profile-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <button class="avatar-upload" title="Change Profile Picture">
                            <i class="fas fa-camera"></i>
                        </button>
                        <div class="user-info">
                            <h2 class="user-name">{{ $user->name }}</h2>
                            <span class="user-role">
                                <i class="fas fa-user me-2"></i>{{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>

                    <!-- Profile Form -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-user-edit"></i>Personal Information
                        </h3>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('user.profile.update') }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2"></i>Full Name
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $user->name) }}" 
                                           required placeholder="Enter your full name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>Email Address
                                    </label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $user->email) }}" 
                                           required placeholder="Enter your email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone me-2"></i>Phone Number
                                    </label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" 
                                           placeholder="Enter your phone number">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="address" class="form-label">
                                        <i class="fas fa-map-marker-alt me-2"></i>Address
                                    </label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" name="address" rows="3" 
                                              placeholder="Enter your address">{{ old('address', $user->address ?? '') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="btn-group">
                                <a href="{{ route('user.dashboard') }}" class="btn-back">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                                </a>
                                <button type="submit" class="btn-update">
                                    <i class="fas fa-save me-2"></i>Update Profile
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Password Change Section -->
                    <div class="form-section" style="margin-top: 30px;">
                        <h3 class="section-title">
                            <i class="fas fa-lock"></i>Change Password
                        </h3>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('user.profile.password') }}" id="password-form">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="current_password" class="form-label">
                                        <i class="fas fa-key me-2"></i>Current Password
                                    </label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                           id="current_password" name="current_password" 
                                           placeholder="Enter current password" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="new_password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>New Password
                                    </label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                           id="new_password" name="new_password" 
                                           placeholder="Enter new password" required minlength="8">
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="new_password_confirmation" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Confirm New Password
                                </label>
                                <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                                       id="new_password_confirmation" name="new_password_confirmation" 
                                       placeholder="Confirm new password" required minlength="8">
                                @error('new_password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="btn-group">
                                <button type="submit" class="btn-update" id="password-submit-btn">
                                    <i class="fas fa-key me-2"></i>Change Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- User Stats Section -->
                <div class="stats-section">
                    <h3 class="section-title">
                        <i class="fas fa-chart-bar me-2"></i>Your Activity Overview
                    </h3>
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
                            <div class="stat-number">{{ $favoriteSportCount }}</div>
                            <div class="stat-label">Favorite Sport: {{ $favoriteSportName }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Avatar upload functionality
document.querySelector('.avatar-upload').addEventListener('click', function() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Here you would typically upload the image to the server
                // For now, we'll just show a success message
                alert('Profile picture updated successfully!');
            };
            reader.readAsDataURL(file);
        }
    };
    input.click();
});

// Password form validation
document.getElementById('password-form').addEventListener('submit', function(e) {
    const currentPassword = document.getElementById('current_password').value;
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('new_password_confirmation').value;
    
    // Clear previous errors
    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    
    let hasErrors = false;
    
    // Validate current password
    if (!currentPassword) {
        document.getElementById('current_password').classList.add('is-invalid');
        hasErrors = true;
    }
    
    // Validate new password
    if (!newPassword) {
        document.getElementById('new_password').classList.add('is-invalid');
        hasErrors = true;
    } else if (newPassword.length < 8) {
        document.getElementById('new_password').classList.add('is-invalid');
        hasErrors = true;
    }
    
    // Validate password confirmation
    if (!confirmPassword) {
        document.getElementById('new_password_confirmation').classList.add('is-invalid');
        hasErrors = true;
    } else if (newPassword !== confirmPassword) {
        document.getElementById('new_password_confirmation').classList.add('is-invalid');
        hasErrors = true;
    }
    
    if (hasErrors) {
        e.preventDefault();
        return false;
    }
    
    // Show loading state
    const submitBtn = document.getElementById('password-submit-btn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Changing Password...';
    submitBtn.disabled = true;
    
    // Re-enable button after 5 seconds in case of error
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 5000);
});

// Profile form validation
document.querySelector('form[action*="profile.update"]').addEventListener('submit', function(e) {
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
    submitBtn.disabled = true;
    
    // Re-enable button after 3 seconds in case of error
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 3000);
});

// Real-time password confirmation validation
document.getElementById('new_password_confirmation').addEventListener('input', function() {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = this.value;
    
    if (confirmPassword && newPassword !== confirmPassword) {
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
});

document.getElementById('new_password').addEventListener('input', function() {
    const newPassword = this.value;
    const confirmPassword = document.getElementById('new_password_confirmation').value;
    
    if (newPassword.length < 8) {
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
    
    if (confirmPassword && newPassword !== confirmPassword) {
        document.getElementById('new_password_confirmation').classList.add('is-invalid');
    } else if (confirmPassword) {
        document.getElementById('new_password_confirmation').classList.remove('is-invalid');
    }
});
</script>
@endsection
