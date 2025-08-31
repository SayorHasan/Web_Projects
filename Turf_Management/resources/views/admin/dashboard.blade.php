@extends('layouts.app')

@section('content')
<style>
.admin-dashboard {
    background: linear-gradient(135deg, #f8fff8 0%, #e8f5e8 50%, #d4edda 100%);
    min-height: 100vh;
    padding: 20px 0;
    position: relative;
    overflow-x: hidden;
}

.admin-dashboard::before {
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

.admin-container {
    position: relative;
    z-index: 1;
}

.admin-header {
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

.admin-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 4s infinite;
}

.admin-title {
    color: #ffffff;
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
}

.admin-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.2rem;
    margin-bottom: 0;
    position: relative;
    z-index: 1;
}

.admin-badge {
    background: linear-gradient(135deg, #2d5a3d, #4a7c59);
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 8px 25px rgba(74, 124, 89, 0.4);
    animation: pulse 3s infinite;
    position: relative;
    z-index: 1;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.stat-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 30px;
    border: 2px solid rgba(74, 124, 89, 0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.1);
}

.stat-card:nth-child(1) { animation-delay: 0.1s; }
.stat-card:nth-child(2) { animation-delay: 0.2s; }
.stat-card:nth-child(3) { animation-delay: 0.3s; }
.stat-card:nth-child(4) { animation-delay: 0.4s; }

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--card-color), var(--card-color-light));
}

.stat-card:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 25px 60px rgba(74, 124, 89, 0.2);
    border-color: var(--card-color);
}

.stat-card.users { --card-color: #4a7c59; --card-color-light: #6b9c7a; }
.stat-card.admins { --card-color: #28a745; --card-color-light: #20c997; }
.stat-card.turfs { --card-color: #17a2b8; --card-color-light: #20c997; }
.stat-card.bookings { --card-color: #ffc107; --card-color-light: #fd7e14; }

.stat-number {
    font-size: 3.5rem;
    font-weight: 900;
    color: #2d5a3d;
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(74, 124, 89, 0.1);
}

.stat-label {
    color: #4a7c59;
    font-size: 1.1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.stat-icon {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 3rem;
    opacity: 0.2;
    color: var(--card-color);
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon {
    opacity: 0.4;
    transform: scale(1.1);
}

.quick-actions-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.1);
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.5s both;
}

.quick-actions-title {
    color: #2d5a3d;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(74, 124, 89, 0.1);
}

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}

.action-btn {
    background: linear-gradient(135deg, var(--btn-color), var(--btn-color-light));
    color: white;
    border: none;
    padding: 25px 20px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    min-height: 150px;
    box-shadow: 0 10px 30px rgba(74, 124, 89, 0.2);
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s;
}

.action-btn:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 25px 60px rgba(74, 124, 89, 0.3);
    color: white;
    text-decoration: none;
}

.action-btn:hover::before {
    left: 100%;
}

.action-btn.users { --btn-color: #4a7c59; --btn-color-light: #6b9c7a; }
.action-btn.turfs { --btn-color: #28a745; --btn-color-light: #20c997; }
.action-btn.bookings { --btn-color: #17a2b8; --btn-color-light: #20c997; }
.action-btn.carousel { --btn-color: #6f42c1; --btn-color-light: #8e44ad; }
.action-btn.reports { --btn-color: #ffc107; --btn-color-light: #fd7e14; }

.action-icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.action-btn:hover .action-icon {
    transform: scale(1.2);
}

.activity-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.1);
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.7s both;
}

.activity-title {
    color: #2d5a3d;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(74, 124, 89, 0.1);
}

.activity-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.activity-item {
    background: rgba(74, 124, 89, 0.05);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 15px;
    border: 1px solid rgba(74, 124, 89, 0.2);
    transition: all 0.3s ease;
    animation: slideIn 0.6s ease-out;
}

.activity-item:nth-child(1) { animation-delay: 0.1s; }
.activity-item:nth-child(2) { animation-delay: 0.2s; }
.activity-item:nth-child(3) { animation-delay: 0.3s; }

.activity-item:hover {
    background: rgba(74, 124, 89, 0.1);
    transform: translateX(10px);
    border-color: rgba(74, 124, 89, 0.4);
}

.activity-text {
    color: #2d5a3d;
    font-weight: 600;
    margin-bottom: 5px;
}

.activity-time {
    color: #4a7c59;
    font-size: 0.9rem;
}

.status-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(74, 124, 89, 0.1);
    border: 2px solid rgba(74, 124, 89, 0.2);
    animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.9s both;
}

.status-title {
    color: #2d5a3d;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(74, 124, 89, 0.1);
}

.status-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid rgba(74, 124, 89, 0.1);
}

.status-item:last-child {
    border-bottom: none;
}

.status-label {
    color: #4a7c59;
    font-weight: 500;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
}

.status-badge.online { background: #28a745; color: white; }
.status-badge.connected { background: #17a2b8; color: white; }
.status-badge.info { background: #6f42c1; color: white; }
.status-badge.warning { background: #ffc107; color: #212529; }

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@media (max-width: 768px) {
    .admin-title {
        font-size: 2.5rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-actions-grid {
        grid-template-columns: 1fr;
    }
    
    .admin-header,
    .quick-actions-section,
    .activity-section,
    .status-section {
        padding: 25px;
        margin-bottom: 25px;
    }
}
</style>

<div class="admin-dashboard">
    <div class="admin-container">
        <div class="container">
            <!-- Admin Header -->
            <div class="admin-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="admin-title">
                            <i class="fas fa-shield-alt me-3"></i>Admin Dashboard
                        </h1>
                        <p class="admin-subtitle">Manage your turf booking system with ease</p>
                    </div>
                    <span class="admin-badge">
                        <i class="fas fa-user-shield me-2"></i>{{ $admin->name }} ({{ ucfirst($admin->role) }})
                    </span>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card users">
                    <div class="stat-number">{{ $totalUsers }}</div>
                    <div class="stat-label">Total Users</div>
                    <i class="fas fa-users stat-icon"></i>
                </div>
                
                <div class="stat-card admins">
                    <div class="stat-number">{{ $totalAdmins }}</div>
                    <div class="stat-label">Total Admins</div>
                    <i class="fas fa-user-shield stat-icon"></i>
                </div>
                
                <div class="stat-card turfs">
                    <div class="stat-number">{{ $availableTurfs }}</div>
                    <div class="stat-label">Available Turfs</div>
                    <i class="fas fa-futbol stat-icon"></i>
                </div>
                
                <div class="stat-card bookings">
                    <div class="stat-number">{{ $activeBookings }}</div>
                    <div class="stat-label">Active Bookings</div>
                    <i class="fas fa-calendar-check stat-icon"></i>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions-section">
                <h2 class="quick-actions-title">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h2>
                <div class="quick-actions-grid">
                    <a href="{{ route('admin.users') }}" class="action-btn users">
                        <i class="fas fa-users action-icon"></i>
                        Manage Users
                    </a>
                    <a href="{{ route('admin.turfs.index') }}" class="action-btn turfs">
                        <i class="fas fa-futbol action-icon"></i>
                        Manage Turfs
                    </a>
                    <a href="{{ route('admin.bookings.index') }}" class="action-btn bookings">
                        <i class="fas fa-calendar action-icon"></i>
                        View Bookings
                    </a>
                    <a href="{{ route('admin.carousel.index') }}" class="action-btn carousel">
                        <i class="fas fa-images action-icon"></i>
                        Manage Carousel
                    </a>
                    <a href="#" class="action-btn reports">
                        <i class="fas fa-chart-bar action-icon"></i>
                        Reports
                    </a>
                </div>
            </div>

            <!-- Recent Activity & System Status -->
            <div class="row">
                <div class="col-md-8">
                    <div class="activity-section">
                        <h3 class="activity-title">
                            <i class="fas fa-history me-2"></i>Recent Activity
                        </h3>
                        <ul class="activity-list">
                            @forelse($recentActivity as $event)
                            <li class="activity-item">
                                <div class="activity-text">
                                    @if($event['type'] === 'user')
                                        <i class="fas fa-user me-2"></i>{{ $event['title'] }}
                                    @elseif($event['type'] === 'booking')
                                        <i class="fas fa-calendar-check me-2"></i>{{ $event['title'] }}
                                    @else
                                        <i class="fas fa-futbol me-2"></i>{{ $event['title'] }}
                                    @endif
                                </div>
                                <div class="activity-time">{{ $event['detail'] }}</div>
                                <small class="text-muted">{{ $event['time']->diffForHumans() }}</small>
                            </li>
                            @empty
                            <li class="activity-item">
                                <div class="activity-text">No recent activity</div>
                                <div class="activity-time">Activity will appear here as users interact with the system.</div>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="status-section">
                        <h3 class="status-title">
                            <i class="fas fa-server me-2"></i>System Status
                        </h3>
                        <div class="status-item">
                            <span class="status-label">Server Status:</span>
                            <span class="status-badge online">Online</span>
                        </div>
                        <div class="status-item">
                            <span class="status-label">Database:</span>
                            <span class="status-badge connected">Connected</span>
                        </div>
                        <div class="status-item">
                            <span class="status-label">Last Backup:</span>
                            <span class="status-badge info">2 hours ago</span>
                        </div>
                        <div class="status-item">
                            <span class="status-label">System Load:</span>
                            <span class="status-badge warning">Medium</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
