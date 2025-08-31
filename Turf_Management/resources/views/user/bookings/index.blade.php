@extends('layouts.app')

@section('content')
<style>
.bookings-container {
    background: #f8fff8;
    min-height: 100vh;
    padding: 20px 0;
}

.bookings-header {
    background: rgba(74, 124, 89, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.3);
    animation: slideDown 0.6s ease-out;
    border: 1px solid #4a7c59;
}

.bookings-title {
    color: #ffffff;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    background: linear-gradient(135deg, #ffffff, #e8f5e8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bookings-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
    animation: slideUp 0.6s ease-out 0.2s both;
    border: 1px solid #e8f5e8;
}

.booking-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    border: 1px solid rgba(74, 124, 89, 0.2);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(74, 124, 89, 0.1);
}

.booking-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(135deg, var(--status-color), var(--status-color-light));
}

.booking-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(74, 124, 89, 0.2);
    background: rgba(255, 255, 255, 1);
}

.booking-card.pending::before {
    --status-color: #ffc107;
    --status-color-light: #fd7e14;
}

.booking-card.confirmed::before {
    --status-color: #28a745;
    --status-color-light: #20c997;
}

.booking-card.completed::before {
    --status-color: #17a2b8;
    --status-color-light: #20c997;
}

.booking-card.cancelled::before {
    --status-color: #dc3545;
    --status-color-light: #e74c3c;
}

.booking-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 15px;
}

.booking-title {
    color: #2d5a3d;
    font-size: 1.3rem;
    font-weight: 700;
    margin: 0;
}

.booking-status {
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.booking-status.pending {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
    color: #ffffff;
}

.booking-status.confirmed {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: #ffffff;
}

.booking-status.completed {
    background: linear-gradient(135deg, #17a2b8, #20c997);
    color: #ffffff;
}

.booking-status.cancelled {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
    color: #ffffff;
}

.booking-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.booking-detail {
    display: flex;
    align-items: center;
    gap: 10px;
}

.booking-detail i {
    color: #4a7c59;
    width: 20px;
}

.booking-detail span {
    color: #2d5a3d;
    font-weight: 500;
}

.booking-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-cancel {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    color: white;
}

.btn-view {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-view:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(74, 124, 89, 0.3);
    color: white;
    text-decoration: none;
}

.no-bookings {
    text-align: center;
    padding: 60px 20px;
    color: #4a7c59;
}

.no-bookings i {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
}

.no-bookings h3 {
    color: #2d5a3d;
    margin-bottom: 15px;
}

.no-bookings p {
    margin-bottom: 25px;
    color: #4a7c59;
}

.filter-section {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 30px;
    border: 1px solid rgba(74, 124, 89, 0.2);
    box-shadow: 0 5px 15px rgba(74, 124, 89, 0.1);
}

.filter-title {
    color: #2d5a3d;
    font-weight: 600;
    margin-bottom: 15px;
}

.filter-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-btn {
    background: rgba(74, 124, 89, 0.1);
    color: #4a7c59;
    border: 1px solid rgba(74, 124, 89, 0.3);
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-btn.active {
    background: linear-gradient(135deg, #4a7c59, #6b9c7a);
    color: white;
    border-color: #4a7c59;
}

.filter-btn:hover {
    background: rgba(74, 124, 89, 0.2);
    color: #2d5a3d;
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
    .bookings-title {
        font-size: 2rem;
    }
    
    .booking-details {
        grid-template-columns: 1fr;
    }
    
    .booking-actions {
        flex-direction: column;
    }
    
    .filter-buttons {
        flex-direction: column;
    }
}
</style>

<div class="bookings-container">
    <div class="container">
        <!-- Bookings Header -->
        <div class="bookings-header">
            <h1 class="bookings-title">
                <i class="fas fa-calendar-check me-3"></i>My Bookings
            </h1>
            <p class="text-muted">Manage and track all your turf bookings</p>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <h4 class="filter-title">
                <i class="fas fa-filter me-2"></i>Filter Bookings
            </h4>
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">All Bookings</button>
                <button class="filter-btn" data-filter="pending">Pending</button>
                <button class="filter-btn" data-filter="confirmed">Confirmed</button>
                <button class="filter-btn" data-filter="completed">Completed</button>
                <button class="filter-btn" data-filter="cancelled">Cancelled</button>
            </div>
        </div>

        <!-- Bookings Section -->
        <div class="bookings-section">
            @if($bookings->count() > 0)
                @foreach($bookings as $booking)
                <div class="booking-card {{ $booking->status }}" data-status="{{ $booking->status }}">
                    <div class="booking-header">
                        <h3 class="booking-title">{{ $booking->turf->name }}</h3>
                        <span class="booking-status {{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                    </div>
                    
                    <div class="booking-details">
                        <div class="booking-detail">
                            <i class="fas fa-calendar"></i>
                            <span>{{ $booking->booking_date->format('M d, Y') }}</span>
                        </div>
                        <div class="booking-detail">
                            <i class="fas fa-clock"></i>
                            <span>{{ $booking->start_time }} ({{ $booking->duration_hours }} hours)</span>
                        </div>
                        <div class="booking-detail">
                            <i class="fas fa-dollar-sign"></i>
                            <span>Total: ${{ $booking->total_amount }}</span>
                        </div>
                        <div class="booking-detail">
                            <i class="fas fa-futbol"></i>
                            <span>{{ ucfirst($booking->turf->sport_type) }}</span>
                        </div>
                    </div>
                    
                    @if($booking->notes)
                    <div class="booking-detail mb-3">
                        <i class="fas fa-sticky-note"></i>
                        <span>{{ $booking->notes }}</span>
                    </div>
                    @endif
                    
                    <div class="booking-actions">
                        @if($booking->status === 'pending')
                            <form action="{{ route('user.bookings.cancel', $booking) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-cancel" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                    <i class="fas fa-times me-2"></i>Cancel Booking
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('user.book-turf') }}" class="btn-view">
                            <i class="fas fa-plus me-2"></i>Book Another
                        </a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="no-bookings">
                    <i class="fas fa-calendar-times"></i>
                    <h3>No Bookings Found</h3>
                    <p>You haven't made any bookings yet. Start by booking your first turf!</p>
                    <a href="{{ route('user.book-turf') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Book Your First Turf
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Filter functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Remove active class from all buttons
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        // Add active class to clicked button
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        const bookings = document.querySelectorAll('.booking-card');
        
        bookings.forEach(booking => {
            if (filter === 'all' || booking.dataset.status === filter) {
                booking.style.display = 'block';
            } else {
                booking.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
