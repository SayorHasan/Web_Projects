@extends('layouts.app')

@section('content')
<style>
.bookings-container {
    background: linear-gradient(135deg, #f8fff8 0%, #e8f5e8 50%, #d4edda 100%);
    min-height: 100vh;
    padding: 20px 0;
    position: relative;
    overflow-x: hidden;
}

.bookings-container::before {
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

.bookings-content {
    position: relative;
    z-index: 1;
}

.bookings-header {
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

.bookings-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 4s infinite;
}

.bookings-title {
    color: #ffffff;
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
}

.bookings-subtitle {
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

.filters-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.1);
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
}

.filters-title {
    color: #2d5a3d;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(74, 124, 89, 0.1);
}

.filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    align-items: end;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-label {
    color: #4a7c59;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.filter-control {
    padding: 12px 15px;
    border: 2px solid rgba(74, 124, 89, 0.3);
    border-radius: 15px;
    background: #ffffff;
    color: #2d5a3d;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.filter-control:focus {
    outline: none;
    border-color: #4a7c59;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.1);
}

.apply-filters-btn {
    background: linear-gradient(135deg, #17a2b8, #20c997);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
}

.apply-filters-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(23, 162, 184, 0.6);
}

.bookings-table {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 30px;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.1);
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.4s both;
    overflow-x: auto;
}

.table {
    color: #2d5a3d;
    margin-bottom: 0;
}

.table thead th {
    background: rgba(74, 124, 89, 0.3);
    border: none;
    color: #ffffff;
    font-weight: 700;
    font-size: 1rem;
    padding: 20px 15px;
    text-align: left;
    border-radius: 15px 15px 0 0;
}

.table tbody tr {
    background: rgba(74, 124, 89, 0.05);
    border: none;
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background: rgba(74, 124, 89, 0.1);
    transform: translateX(5px);
}

.table tbody td {
    border: none;
    padding: 20px 15px;
    vertical-align: middle;
    color: #2d5a3d;
}

.booking-id {
    font-weight: 700;
    color: #4a7c59;
    font-size: 1.1rem;
}

.customer-info {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.customer-name {
    font-weight: 700;
    color: #2d5a3d;
}

.customer-email {
    font-size: 0.9rem;
    color: #4a7c59;
}

.turf-info {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.turf-name {
    font-weight: 700;
    color: #2d5a3d;
}

.turf-sport {
    font-size: 0.9rem;
    color: #4a7c59;
}

.booking-datetime {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.booking-date {
    font-weight: 700;
    color: #2d5a3d;
}

.booking-time {
    font-size: 0.9rem;
    color: #4a7c59;
}

.duration {
    text-align: center;
    font-weight: 700;
    color: #4a7c59;
}

.amount {
    text-align: center;
    font-weight: 700;
    color: #28a745;
    font-size: 1.1rem;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-align: center;
    display: inline-block;
}

.status-badge.pending {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
    color: #212529;
}

.status-badge.confirmed {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.status-badge.completed {
    background: linear-gradient(135deg, #17a2b8, #20c997);
    color: white;
}

.status-badge.cancelled {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
    color: white;
}

.actions-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: center;
}

.action-btn {
    padding: 8px 12px;
    border-radius: 15px;
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    box-shadow: 0 3px 10px rgba(74, 124, 89, 0.2);
}

.action-btn.view {
    background: linear-gradient(135deg, #17a2b8, #20c997);
    color: white;
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
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(74, 124, 89, 0.3);
    color: inherit;
    text-decoration: none;
}

.no-bookings {
    text-align: center;
    color: #4a7c59;
    padding: 80px 40px;
    font-style: italic;
}

.no-bookings i {
    color: #4a7c59;
    font-size: 4rem;
    margin-bottom: 20px;
}

.no-bookings h3 {
    color: #2d5a3d;
    font-size: 2rem;
    margin-bottom: 15px;
}

.no-bookings p {
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
    .bookings-title {
        font-size: 2.5rem;
    }
    
    .filters-grid {
        grid-template-columns: 1fr;
    }
    
    .actions-group {
        flex-direction: column;
        align-items: center;
    }
    
    .bookings-header,
    .filters-section,
    .bookings-table {
        padding: 25px;
        margin-bottom: 25px;
    }
    
    .table thead th,
    .table tbody td {
        padding: 15px 10px;
        font-size: 0.9rem;
    }
}
</style>

<div class="bookings-container">
    <div class="bookings-content">
        <div class="container">
            <!-- Bookings Header -->
            <div class="bookings-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="bookings-title">
                            <i class="fas fa-calendar-check me-3"></i>Manage Bookings
                        </h1>
                        <p class="bookings-subtitle">View and manage all turf bookings from users</p>
                    </div>
                    <a href="{{ route('admin.bookings.create') }}" class="create-btn">
                        <i class="fas fa-plus me-2"></i>Add New Booking
                    </a>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="filters-section">
                <h3 class="filters-title">
                    <i class="fas fa-filter me-2"></i>Filter Bookings
                </h3>
                <form action="{{ route('admin.bookings.index') }}" method="GET" class="filters-grid">
                    <div class="filter-group">
                        <label for="status" class="filter-label">Status</label>
                        <select name="status" id="status" class="filter-control">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="date" class="filter-label">Date</label>
                        <input type="date" name="date" id="date" class="filter-control" value="{{ request('date') }}">
                    </div>
                    
                    <div class="filter-group">
                        <label for="turf" class="filter-label">Turf</label>
                        <select name="turf" id="turf" class="filter-control">
                            <option value="">All Turfs</option>
                            @foreach($turfs ?? [] as $turf)
                                <option value="{{ $turf->id }}" {{ request('turf') == $turf->id ? 'selected' : '' }}>
                                    {{ $turf->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <button type="submit" class="apply-filters-btn">
                            <i class="fas fa-search me-2"></i>Apply Filters
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bookings Table -->
            <div class="bookings-table">
                @if($bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Customer</th>
                                    <th>Turf</th>
                                    <th>Date & Time</th>
                                    <th>Duration</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $rowIndex => $booking)
                                <tr>
                                    <td>
                                        <span class="booking-id">#{{ ($bookings->currentPage() - 1) * $bookings->perPage() + $rowIndex + 1 }}</span>
                                    </td>
                                    <td>
                                        <div class="customer-info">
                                            <span class="customer-name">{{ $booking->user->name }}</span>
                                            <span class="customer-email">{{ $booking->user->email }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="turf-info">
                                            <span class="turf-name">{{ $booking->turf->name }}</span>
                                            <span class="turf-sport">{{ ucfirst($booking->turf->sport_type) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="booking-datetime">
                                            <span class="booking-date">{{ $booking->booking_date->format('M d, Y') }}</span>
                                            <span class="booking-time">{{ $booking->start_time }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="duration">{{ $booking->duration_hours }} hours</span>
                                    </td>
                                    <td>
                                        <span class="amount">${{ $booking->total_amount }}</span>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $booking->status }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions-group">
                                            <a href="{{ route('admin.bookings.show', $booking) }}" class="action-btn view">
                                                <i class="fas fa-eye"></i>View
                                            </a>
                                            
                                            <a href="{{ route('admin.bookings.edit', $booking) }}" class="action-btn edit">
                                                <i class="fas fa-edit"></i>Edit
                                            </a>
                                            
                                            @if($booking->status == 'pending')
                                                <form action="{{ route('admin.bookings.confirm', $booking) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="action-btn confirm">
                                                        <i class="fas fa-check"></i>Confirm
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            @if($booking->status == 'confirmed')
                                                <form action="{{ route('admin.bookings.complete', $booking) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="action-btn complete">
                                                        <i class="fas fa-flag-checkered"></i>Complete
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            @if(in_array($booking->status, ['pending', 'confirmed']))
                                                <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="action-btn cancel" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                        <i class="fas fa-times"></i>Cancel
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn delete" onclick="return confirm('Are you sure you want to delete this booking? This action cannot be undone.')">
                                                    <i class="fas fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $bookings->links() }}
                    </div>
                @else
                    <div class="no-bookings">
                        <i class="fas fa-calendar-times"></i>
                        <h3>No Bookings Found</h3>
                        <p>There are no bookings to display at the moment.</p>
                        <a href="{{ route('admin.bookings.create') }}" class="create-btn">
                            <i class="fas fa-plus me-2"></i>Create Your First Booking
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
