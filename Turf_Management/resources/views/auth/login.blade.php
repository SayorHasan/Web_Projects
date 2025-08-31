@extends('layouts.app')

@section('content')
<style>
.auth-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #4a7c59 0%, #6b9c7a 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.auth-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(74, 124, 89, 0.2);
    overflow: hidden;
    max-width: 400px;
    width: 100%;
    animation: slideUp 0.6s ease-out;
}

.auth-header {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    padding: 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.auth-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 3s infinite;
}

.auth-header h2 {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
    position: relative;
    z-index: 1;
}

.auth-header p {
    margin: 10px 0 0 0;
    opacity: 0.9;
    position: relative;
    z-index: 1;
}

.auth-body {
    padding: 40px 30px;
}

.form-group {
    margin-bottom: 25px;
    position: relative;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #2d5a3d;
    font-weight: 600;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e8f5e8;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #ffffff;
    color: #2d5a3d !important;
    -webkit-text-fill-color: #2d5a3d !important;
}

.form-control:focus {
    outline: none;
    border-color: #4a7c59;
    background: white;
    box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.1);
    transform: translateY(-2px);
}

.form-check {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
}

.form-check-input {
    margin-right: 10px;
    transform: scale(1.2);
}

.btn-login {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-login:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(74, 124, 89, 0.3);
}

.btn-login::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-login:hover::before {
    left: 100%;
}

.forgot-link {
    text-align: center;
    margin-top: 20px;
}

.forgot-link a {
    color: #4a7c59;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.forgot-link a:hover {
    color: #6b9c7a;
}

.register-link {
    text-align: center;
    margin-top: 25px;
    padding-top: 25px;
    border-top: 1px solid #e8f5e8;
}

.register-link a {
    color: #4a7c59;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.register-link a:hover {
    color: #6b9c7a;
}

.sports-icons {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 2rem;
    opacity: 0.1;
    animation: float 3s ease-in-out infinite;
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

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
    display: block;
}

.form-control.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
}
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <i class="fas fa-futbol sports-icons"></i>
            <h2>Welcome Back!</h2>
            <p>Sign in to your account</p>
        </div>

        <div class="auth-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope me-2"></i>{{ __('Email Address') }}
                    </label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                           placeholder="Enter your email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>{{ __('Password') }}
                    </label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" required autocomplete="current-password"
                           placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>{{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <div class="forgot-link">
                        <a href="{{ route('password.request') }}">
                            <i class="fas fa-key me-1"></i>{{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif

                <div class="register-link">
                    <p>Don't have an account? <a href="{{ route('register') }}">
                        <i class="fas fa-user-plus me-1"></i>{{ __('Register Now') }}
                    </a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
