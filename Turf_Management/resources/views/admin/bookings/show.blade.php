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

.booking-details-card {
    background: rgba(26, 32, 44, 0.9);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.3s both;
}

.booking-info-grid {
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

.booking-status-badge {
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

.booking-status-badge.pending {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
    color: #212529;
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
}

.booking-status-badge.confirmed {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
}

.booking-status-badge.completed {
    background: linear-gradient(135deg, #17a2b8, #20c997);
    color: white;
    box-shadow: 0 8px 25px rgba(23, 162, 184, 0.4);
}

.booking-status-badge.cancelled {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
    color: white;
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
}

.turf-image-section {
    text-align: center;
    margin-bottom: 30px;
}

.turf-image {
    width: 100%;
    max-width: 400px;
    height: 250px;
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

.booking-actions {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 2px solid rgba(74, 124, 89, 0.2);
    flex-wrap: wrap;
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

.action-btn.confirm {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.action-btn.complete {
    background: linear-gradient(135deg, #17a2b8, #20c997);
    color: white;
}

.action-btn.cancel {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
    color: white;
}

.action-btn.delete {
    background: linear-gradient(135deg, #6c757d, #495057);
    color: white;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    color: inherit;
    text-decoration: none;
}

.notes-section {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 20px;
    padding: 25px;
    margin-top: 30px;
    border: 2px solid rgba(74, 124, 89, 0.2);
}

.notes-content {
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.7;
    font-size: 1.1rem;
    font-style: italic;
}

.no-notes {
    color: rgba(255, 255, 255, 0.6);
    font-style: italic;
    text-align: center;
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
    
    .booking-info-grid {
        grid-template-columns: 1fr;
    }
    
    .booking-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .show-header,
    .booking-details-card {
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
                            <i class="fas fa-calendar-check me-3"></i>Booking Details
                        </h1>
                        <p class="show-subtitle">View complete information about booking #{{ $booking->id }}</p>
                    </div>
                    <a href="{{ route('admin.bookings.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left me-2"></i>Back to Bookings
                    </a>
                </div>
            </div>

            <!-- Booking Details Card -->
            <div class="booking-details-card">
                <!-- Turf Image -->
                <div class="turf-image-section">
                    <img src="{{ asset('storage/' . $booking->turf->image_path) }}" alt="{{ $booking->turf->name }}" class="turf-image">
                </div>

                <!-- Status Badge -->
                <div class="text-center mb-4">
                    <span class="booking-status-badge {{ $booking->status }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

                <!-- Booking Information Grid -->
                <div class="booking-info-grid">
                    <!-- Customer Information -->
                    <div class="info-section">
                        <h3 class="section-title">
                            <i class="fas fa-user me-2"></i>Customer Details
                        </h3>
                        <div class="info-item">
                            <span class="info-label">Name:</span>
                            <span class="info-value">{{ $booking->user->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email:</span>
                            <span class="info-value">{{ $booking->user->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone:</span>
                            <span class="info-value">{{ $booking->user->phone ?? 'Not provided' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Member Since:</span>
                            <span class="info-value">{{ $booking->user->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <!-- Turf Information -->
                    <div class="info-section">
                        <h3 class="section-title">
                            <i class="fas fa-futbol me-2"></i>Turf Details
                        </h3>
                        <div class="info-item">
                            <span class="info-label">Name:</span>
                            <span class="info-value">{{ $booking->turf->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Sport Type:</span>
                            <span class="info-value">{{ ucfirst($booking->turf->sport_type) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Price per Hour:</span>
                            <span class="info-value">${{ $booking->turf->price_per_hour }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status:</span>
                            <span class="info-value">{{ ucfirst($booking->turf->status) }}</span>
                        </div>
                    </div>

                    <!-- Booking Information -->
                    <div class="info-section">
                        <h3 class="section-title">
                            <i class="fas fa-calendar me-2"></i>Booking Details
                        </h3>
                        <div class="info-item">
                            <span class="info-label">Date:</span>
                            <span class="info-value">{{ $booking->booking_date->format('M d, Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Start Time:</span>
                            <span class="info-value">{{ $booking->start_time }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Duration:</span>
                            <span class="info-value">{{ $booking->duration_hours }} hours</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Total Amount:</span>
                            <span class="info-value">${{ $booking->total_amount }}</span>
                        </div>
                    </div>

                    <!-- System Information -->
                    <div class="info-section">
                        <h3 class="section-title">
                            <i class="fas fa-cogs me-2"></i>System Info
                        </h3>
                        <div class="info-item">
                            <span class="info-label">Booking ID:</span>
                            <span class="info-value">#{{ $booking->id }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Created:</span>
                            <span class="info-value">{{ $booking->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Last Updated:</span>
                            <span class="info-value">{{ $booking->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Payment Status:</span>
                            <span class="info-value">{{ $booking->payment_status ?? 'Pending' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                @if($booking->notes)
                <div class="notes-section">
                    <h3 class="section-title">
                        <i class="fas fa-sticky-note me-2"></i>Customer Notes
                    </h3>
                    <div class="notes-content">
                        {{ $booking->notes }}
                    </div>
                </div>
                @else
                <div class="notes-section">
                    <h3 class="section-title">
                        <i class="fas fa-sticky-note me-2"></i>Customer Notes
                    </h3>
                    <div class="no-notes">
                        No notes provided by the customer
                    </div>
                </div>
                @endif

                <!-- Booking Actions -->
                <div class="booking-actions">
                    <a href="{{ route('admin.bookings.edit', $booking) }}" class="action-btn edit">
                        <i class="fas fa-edit"></i>Edit Booking
                    </a>
                    
                    @if($booking->status == 'pending')
                        <form action="{{ route('admin.bookings.confirm', $booking) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn confirm">
                                <i class="fas fa-check"></i>Confirm Booking
                            </button>
                        </form>
                    @endif
                    
                    @if($booking->status == 'confirmed')
                        <form action="{{ route('admin.bookings.complete', $booking) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn complete">
                                <i class="fas fa-flag-checkered"></i>Mark Complete
                            </button>
                        </form>
                    @endif
                    
                    @if(in_array($booking->status, ['pending', 'confirmed']))
                        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="cancelled">
                            <input type="hidden" name="turf_id" value="{{ $booking->turf_id }}">
                            <input type="hidden" name="booking_date" value="{{ $booking->booking_date }}">
                            <input type="hidden" name="start_time" value="{{ $booking->start_time }}">
                            <input type="hidden" name="duration_hours" value="{{ $booking->duration_hours }}">
                            <input type="hidden" name="notes" value="{{ $booking->notes }}">
                            <button type="submit" class="action-btn cancel">
                                <i class="fas fa-times"></i>Cancel Booking
                            </button>
                        </form>
                    @endif
                    
                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete" onclick="return confirm('Are you sure you want to delete this booking? This action cannot be undone.')">
                            <i class="fas fa-trash"></i>Delete Booking
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
