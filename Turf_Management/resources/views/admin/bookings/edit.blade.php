@extends('layouts.app')

@section('content')
<style>
.edit-container {
    background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
    min-height: 100vh;
    padding: 20px 0;
    position: relative;
    overflow-x: hidden;
}

.edit-container::before {
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

.edit-content {
    position: relative;
    z-index: 1;
}

.edit-header {
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

.edit-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 4s infinite;
}

.edit-title {
    color: #ffffff;
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
}

.edit-subtitle {
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

.edit-form {
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

.current-booking-info {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    border: 2px solid rgba(74, 124, 89, 0.2);
}

.current-booking-title {
    color: #4a7c59;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-align: center;
}

.current-booking-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.current-booking-item {
    text-align: center;
    padding: 10px;
    background: rgba(74, 124, 89, 0.1);
    border-radius: 10px;
    border: 1px solid rgba(74, 124, 89, 0.2);
}

.current-booking-label {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
    margin-bottom: 5px;
    display: block;
}

.current-booking-value {
    color: #ffffff;
    font-weight: 700;
    font-size: 1rem;
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
    .edit-title {
        font-size: 2.5rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .edit-header,
    .edit-form {
        padding: 25px;
        margin-bottom: 25px;
    }
    
    .current-booking-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="edit-container">
    <div class="edit-content">
        <div class="container">
            <!-- Edit Header -->
            <div class="edit-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="edit-title">
                            <i class="fas fa-edit me-3"></i>Edit Booking
                        </h1>
                        <p class="edit-subtitle">Update information for booking #{{ $booking->id }}</p>
                    </div>
                    <a href="{{ route('admin.bookings.show', $booking) }}" class="back-btn">
                        <i class="fas fa-arrow-left me-2"></i>Back to Booking
                    </a>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="edit-form">
                <!-- Current Booking Information -->
                <div class="current-booking-info">
                    <h3 class="current-booking-title">
                        <i class="fas fa-info-circle me-2"></i>Current Booking Information
                    </h3>
                    <div class="current-booking-grid">
                        <div class="current-booking-item">
                            <span class="current-booking-label">Customer</span>
                            <span class="current-booking-value">{{ $booking->user->name }}</span>
                        </div>
                        <div class="current-booking-item">
                            <span class="current-booking-label">Turf</span>
                            <span class="current-booking-value">{{ $booking->turf->name }}</span>
                        </div>
                        <div class="current-booking-item">
                            <span class="current-booking-label">Date</span>
                            <span class="current-booking-value">{{ $booking->booking_date->format('M d, Y') }}</span>
                        </div>
                        <div class="current-booking-item">
                            <span class="current-booking-label">Status</span>
                            <span class="current-booking-value">{{ ucfirst($booking->status) }}</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="turf_id" class="form-label">
                                <i class="fas fa-futbol me-2"></i>Turf
                            </label>
                            <select id="turf_id" name="turf_id" class="form-control @error('turf_id') is-invalid @enderror" required>
                                <option value="">Select turf</option>
                                @foreach($turfs as $turf)
                                    <option value="{{ $turf->id }}" {{ old('turf_id', $booking->turf_id) == $turf->id ? 'selected' : '' }}>
                                        {{ $turf->name }} - {{ ucfirst($turf->sport_type) }} (${{ $turf->price_per_hour }}/hour)
                                    </option>
                                @endforeach
                            </select>
                            @error('turf_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="status" class="form-label">
                                <i class="fas fa-toggle-on me-2"></i>Status
                            </label>
                            <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="">Select status</option>
                                <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="booking_date" class="form-label">
                                <i class="fas fa-calendar me-2"></i>Booking Date
                            </label>
                            <input type="date" id="booking_date" name="booking_date" class="form-control @error('booking_date') is-invalid @enderror" 
                                   value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}" required>
                            @error('booking_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="start_time" class="form-label">
                                <i class="fas fa-clock me-2"></i>Start Time
                            </label>
                            <input type="time" id="start_time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" 
                                   value="{{ old('start_time', $booking->start_time) }}" required>
                            @error('start_time')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="duration_hours" class="form-label">
                            <i class="fas fa-hourglass-half me-2"></i>Duration (Hours)
                        </label>
                        <select id="duration_hours" name="duration_hours" class="form-control @error('duration_hours') is-invalid @enderror" required>
                            <option value="">Select duration</option>
                            <option value="1" {{ old('duration_hours', $booking->duration_hours) == 1 ? 'selected' : '' }}>1 Hour</option>
                            <option value="2" {{ old('duration_hours', $booking->duration_hours) == 2 ? 'selected' : '' }}>2 Hours</option>
                            <option value="3" {{ old('duration_hours', $booking->duration_hours) == 3 ? 'selected' : '' }}>3 Hours</option>
                            <option value="4" {{ old('duration_hours', $booking->duration_hours) == 4 ? 'selected' : '' }}>4 Hours</option>
                            <option value="5" {{ old('duration_hours', $booking->duration_hours) == 5 ? 'selected' : '' }}>5 Hours</option>
                            <option value="6" {{ old('duration_hours', $booking->duration_hours) == 6 ? 'selected' : '' }}>6 Hours</option>
                            <option value="7" {{ old('duration_hours', $booking->duration_hours) == 7 ? 'selected' : '' }}>7 Hours</option>
                            <option value="8" {{ old('duration_hours', $booking->duration_hours) == 8 ? 'selected' : '' }}>8 Hours</option>
                        </select>
                        @error('duration_hours')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="notes" class="form-label">
                            <i class="fas fa-sticky-note me-2"></i>Notes
                        </label>
                        <textarea id="notes" name="notes" rows="4" class="form-control @error('notes') is-invalid @enderror" 
                                  placeholder="Add any additional notes or special requests">{{ old('notes', $booking->notes) }}</textarea>
                        @error('notes')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-actions">
                        <button type="reset" class="reset-btn">
                            <i class="fas fa-undo me-2"></i>Reset Form
                        </button>
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-save me-2"></i>Update Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
