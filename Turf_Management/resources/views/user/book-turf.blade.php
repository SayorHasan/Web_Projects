@extends('layouts.app')

@section('content')
<style>
.booking-container {
    background: #f8fff8;
    min-height: 100vh;
    padding: 20px 0;
}

.booking-header {
    background: rgba(74, 124, 89, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.3);
    animation: slideDown 0.6s ease-out;
    border: 1px solid #4a7c59;
}

.booking-title {
    color: #ffffff;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    background: linear-gradient(135deg, #ffffff, #e8f5e8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.turfs-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    animation: slideUp 0.6s ease-out 0.2s both;
    border: 1px solid #e8f5e8;
}

.section-title {
    color: #2d5a3d;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 25px;
    text-align: center;
}

.turfs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 25px;
}

.turf-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    transition: all 0.3s ease;
    position: relative;
    border: 1px solid rgba(74, 124, 89, 0.2);
}

.turf-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(74, 124, 89, 0.2);
}

.turf-image {
    height: 250px;
    background-size: cover;
    background-position: center;
    position: relative;
    overflow: hidden;
}

.turf-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, rgba(0, 0, 0, 0.1), transparent);
    animation: shimmer 3s infinite;
}

.turf-overlay {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    backdrop-filter: blur(5px);
}

.turf-content {
    padding: 25px;
}

.turf-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d5a3d;
    margin-bottom: 10px;
}

.turf-description {
    color: #4a7c59;
    margin-bottom: 20px;
    line-height: 1.6;
}

.turf-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.turf-price {
    font-size: 1.3rem;
    font-weight: 700;
    color: #4a7c59;
}

.turf-features {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.feature-badge {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.turf-btn {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.turf-btn.available {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.turf-btn.available:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
}

.turf-btn.booked, .turf-btn.maintenance {
    background: #6c757d;
    color: #ffffff;
    cursor: not-allowed;
}

.turf-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.turf-btn.available:hover::before {
    left: 100%;
}

.booking-form-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    animation: slideUp 0.6s ease-out 0.4s both;
    position: sticky;
    top: 20px;
    border: 1px solid #e8f5e8;
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
    color: #2d5a3d !important;
    -webkit-text-fill-color: #2d5a3d !important;
}

.form-control:focus {
    outline: none;
    border-color: #4a7c59;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.1);
    transform: translateY(-2px);
}

.form-control:read-only {
    background: #f8f9fa;
    color: #6c757d;
}

.total-section {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 25px;
    text-align: center;
}

.total-amount {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.total-label {
    font-size: 0.9rem;
    opacity: 0.9;
}

.btn-confirm {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #28a745, #20c997);
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

.btn-confirm:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
}

.btn-confirm::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-confirm:hover::before {
    left: 100%;
}

.btn-cancel {
    width: 100%;
    padding: 12px;
    background: #6c757d;
    border: none;
    border-radius: 12px;
    color: white;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    transition: all 0.3s ease;
    margin-top: 10px;
}

.btn-cancel:hover {
    background: #5a6268;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.selected-turf {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: 600;
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

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

@media (max-width: 768px) {
    .booking-title {
        font-size: 2rem;
    }
    
    .turfs-grid {
        grid-template-columns: 1fr;
    }
    
    .booking-form-section {
        position: static;
        margin-top: 20px;
    }
}
</style>

<div class="booking-container">
    <div class="container">
        <!-- Booking Header -->
        <div class="booking-header">
            <h1 class="booking-title">
                <i class="fas fa-calendar-plus me-3"></i>Book Your Perfect Turf
            </h1>
            <p class="text-muted">Choose from our premium sports facilities and reserve your slot</p>
        </div>

        <div class="row">
            <!-- Available Turfs -->
            <div class="col-lg-8">
                <div class="turfs-section">
                    <h2 class="section-title">
                        <i class="fas fa-futbol me-2"></i>Available Turfs
                    </h2>
                    <div class="turfs-grid">
                        @forelse($turfs as $turf)
                        <div class="turf-card">
                            <div class="turf-image" style="background-image: url('{{ $turf->image_url }}');">
                                <div class="turf-overlay">{{ ucfirst($turf->status) }}</div>
                            </div>
                            <div class="turf-content">
                                <h3 class="turf-title">{{ $turf->name }}</h3>
                                <p class="turf-description">{{ $turf->description }}</p>
                                
                                @if($turf->features)
                                <div class="turf-features">
                                    @foreach($turf->features as $feature)
                                    <span class="feature-badge">{{ ucfirst(str_replace('_', ' ', $feature)) }}</span>
                                    @endforeach
                                </div>
                                @endif
                                
                                <div class="turf-details">
                                    <span class="turf-price">${{ $turf->price_per_hour }}/hour</span>
                                    <span class="badge {{ $turf->getStatusBadgeClass() }}">{{ ucfirst($turf->status) }}</span>
                                </div>
                                
                                @if($turf->isAvailable())
                                <button class="turf-btn available" onclick="selectTurf({{ $turf->id }}, '{{ $turf->name }}', {{ $turf->price_per_hour }})">
                                    <i class="fas fa-calendar-plus me-2"></i>Select Turf
                                </button>
                                @else
                                <button class="turf-btn {{ $turf->status }}" disabled>
                                    <i class="fas fa-clock me-2"></i>{{ $turf->status === 'maintenance' ? 'Under Maintenance' : 'Not Available' }}
                                </button>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center">
                            <div class="no-turfs">
                                <i class="fas fa-futbol fa-3x mb-3"></i>
                                <h3>No Turfs Available</h3>
                                <p>All turfs are currently booked or under maintenance. Please check back later.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="col-lg-4">
                <div class="booking-form-section">
                    <h3 class="section-title">
                        <i class="fas fa-clipboard-list me-2"></i>Booking Details
                    </h3>
                    
                    <div id="selectedTurfInfo" class="selected-turf" style="display: none;">
                        <i class="fas fa-check-circle me-2"></i>
                        <span id="selectedTurfText"></span>
                    </div>

                    <form id="bookingForm" action="{{ route('user.bookings.store') }}" method="POST">
                        @csrf
                        
                        <input type="hidden" id="turf_id" name="turf_id" required>
                        
                        <div class="form-group">
                            <label for="booking_date" class="form-label">
                                <i class="fas fa-calendar me-2"></i>Booking Date
                            </label>
                            <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="start_time" class="form-label">
                                <i class="fas fa-clock me-2"></i>Start Time
                            </label>
                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="duration_hours" class="form-label">
                                <i class="fas fa-hourglass-half me-2"></i>Duration (Hours)
                            </label>
                            <select class="form-control" id="duration_hours" name="duration_hours" required>
                                <option value="">Select Duration</option>
                                <option value="1">1 Hour</option>
                                <option value="2">2 Hours</option>
                                <option value="3">3 Hours</option>
                                <option value="4">4 Hours</option>
                            </select>
                        </div>
                        
                        <div class="total-section">
                            <div class="total-amount" id="totalAmount">$0</div>
                            <div class="total-label">Total Amount</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="notes" class="form-label">
                                <i class="fas fa-sticky-note me-2"></i>Additional Notes
                            </label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Any special requirements or notes..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn-confirm" id="confirmBtn" disabled>
                            <i class="fas fa-check-circle me-2"></i>Confirm Booking
                        </button>
                        
                        <a href="{{ route('user.dashboard') }}" class="btn-cancel">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedTurfId = null;
let selectedTurfName = '';
let selectedTurfPrice = 0;

function selectTurf(turfId, turfName, pricePerHour) {
    selectedTurfId = turfId;
    selectedTurfName = turfName;
    selectedTurfPrice = pricePerHour;
    
    document.getElementById('turf_id').value = turfId;
    document.getElementById('selectedTurfInfo').style.display = 'block';
    document.getElementById('selectedTurfText').textContent = `${turfName} selected`;
    document.getElementById('confirmBtn').disabled = false;
    
    calculateTotal();
}

function calculateTotal() {
    const duration = document.getElementById('duration_hours').value;
    
    if (duration && selectedTurfPrice > 0) {
        const total = selectedTurfPrice * duration;
        document.getElementById('totalAmount').textContent = `$${total}`;
    } else {
        document.getElementById('totalAmount').textContent = '$0';
    }
}

// Event listeners
document.getElementById('duration_hours').addEventListener('change', calculateTotal);
document.getElementById('booking_date').addEventListener('change', function() {
    const today = new Date().toISOString().split('T')[0];
    if (this.value < today) {
        alert('Please select a future date for booking.');
        this.value = '';
    }
});

document.getElementById('bookingForm').addEventListener('submit', function(e) {
    if (!selectedTurfId) {
        e.preventDefault();
        alert('Please select a turf first.');
        return;
    }
});
</script>
@endsection
