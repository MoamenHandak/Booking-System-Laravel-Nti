@extends('layout.admin')

@php
    $pageTitle = 'Dashboard Overview';
@endphp

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Top Welcome Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">
                <span data-i18n="welcome_back">Welcome back</span>, {{ auth()->user()->name ?? 'Admin' }}
            </h2>
            <p class="text-muted mb-0 small" data-i18n="dashboard_subtitle">Here is what is happening with your hotels & bookings today.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm" onclick="window.location.reload()">
                <i class="fa-solid fa-rotate-right me-1"></i> <span data-i18n="refresh">Refresh</span>
            </button>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fa-solid fa-plus me-1"></i> <span data-i18n="manage_bookings">Manage Bookings</span>
            </a>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Stat Cards Row -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <x-stat-card 
                title="Total Bookings" 
                value="{{ $totalBookings ?? 0 }}" 
                icon="calendar-check" 
                trend="+12%" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <x-stat-card 
                title="Total Revenue" 
                value="${{ number_format($totalRevenue ?? 0, 2) }}" 
                icon="dollar-sign" 
                trend="+8%" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <x-stat-card 
                title="Total Users" 
                value="{{ $totalUsers ?? 0 }}" 
                icon="users" 
                trend="+5%" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <x-stat-card 
                title="Available Places" 
                value="{{ $availablePlaces ?? 0 }} Rooms" 
                icon="building-2" 
                trend="Live" 
                :trendUp="true" 
            />
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Booking Statistics Over Time -->
        <div class="col-12 col-lg-8">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-0" data-i18n="booking_statistics">Booking Statistics Over Time</h5>
                        <small class="text-muted" data-i18n="monthly_volume">Monthly reservation volume</small>
                    </div>
                    <select class="form-select form-select-sm w-auto" id="dashboardYearFilter">
                        <option value="2026" selected data-i18n="this_year">This Year (2026)</option>
                    </select>
                </div>
                <div style="height: 280px;">
                    <canvas id="bookingTrendsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Most Booked Places Doughnut -->
        <div class="col-12 col-lg-4">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-0" data-i18n="most_booked_places">Most Booked Places</h5>
                        <small class="text-muted" data-i18n="distribution_by_hotel">Distribution by Top Hotel</small>
                    </div>
                </div>
                <div style="height: 260px;" class="d-flex align-items-center justify-content-center">
                    <canvas id="mostBookedChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Revenue Overview & Recent Bookings -->
    <div class="row g-4">
        <!-- Revenue Bar Chart -->
        <div class="col-12 col-xl-4">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-0" data-i18n="revenue_overview">Revenue Overview</h5>
                        <small class="text-muted" data-i18n="quarterly_earnings">Quarterly earnings ($)</small>
                    </div>
                </div>
                <div style="height: 270px;">
                    <canvas id="revenueBarChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Bookings Table Card -->
        <div class="col-12 col-xl-8">
            <div class="card-custom h-100 mb-0 p-0 overflow-hidden">
                <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold text-dark mb-0" data-i18n="recent_reservations">Recent Reservations</h5>
                        <small class="text-muted" data-i18n="latest_guest_activity">Latest guest activity</small>
                    </div>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm" data-i18n="view_all">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0" id="mainTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th data-i18n="guest_name">Guest</th>
                                <th data-i18n="hotel">Hotel</th>
                                <th data-i18n="room_type">Room</th>
                                <th data-i18n="dates">Check-In</th>
                                <th data-i18n="dates">Check-Out</th>
                                <th data-i18n="status">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentBookings as $booking)
                                <tr>
                                    <td><strong class="text-dark">#{{ $booking->id }}</strong></td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $booking->user->name ?? 'Guest' }}</div>
                                        <small class="text-muted">{{ $booking->user->email ?? '' }}</small>
                                    </td>
                                    <td>{{ $booking->room->hotel->name ?? 'N/A' }}</td>
                                    <td><span class="badge bg-light text-dark border">{{ $booking->room->type ?? 'Room' }}</span></td>
                                    <td>{{ $booking->check_in }}</td>
                                    <td>{{ $booking->check_out }}</td>
                                    <td><x-status-badge :status="$booking->status" /></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <div class="py-2">
                                            <i class="fa-solid fa-box-open fs-3 mb-2 opacity-50"></i>
                                            <p class="mb-0 small fw-semibold" data-i18n="no_bookings_available">No recent reservations available</p>
                                            <span class="small text-secondary" data-i18n="no_bookings_desc">New booking records will appear here once created.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Booking Trends Line Chart
        const bookingTrendsLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const bookingTrendsData = @json($monthlyBookings);
        const ctxTrends = document.getElementById('bookingTrendsChart').getContext('2d');
        new Chart(ctxTrends, {
            type: 'line',
            data: {
                labels: bookingTrendsLabels,
                datasets: [{
                    label: 'Bookings',
                    data: bookingTrendsData,
                    borderColor: '#0F62FE',
                    backgroundColor: 'rgba(15, 98, 254, 0.08)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#0F62FE',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: 'rgba(110, 110, 110, 0.15)' }, ticks: { color: '#6F6E77' }, beginAtZero: true },
                    x: { grid: { display: false }, ticks: { color: '#6F6E77' } }
                }
            }
        });

        // 2. Most Booked Places Doughnut Chart
        const mostBookedLabels = @json($hotelNames);
        const mostBookedData = @json($hotelCounts);
        const ctxMostBooked = document.getElementById('mostBookedChart').getContext('2d');
        new Chart(ctxMostBooked, {
            type: 'doughnut',
            data: {
                labels: mostBookedLabels.length ? mostBookedLabels : ['No Data'],
                datasets: [{
                    data: mostBookedData.length ? mostBookedData : [1],
                    backgroundColor: ['#0F62FE', '#6F6E77', '#161616', '#A855F7'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, padding: 12 } } },
                cutout: '72%'
            }
        });

        // 3. Revenue Bar Chart
        const revenueLabels = ['Q1', 'Q2', 'Q3', 'Q4'];
        const revenueData = @json($revenueData);
        const ctxRevenue = document.getElementById('revenueBarChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'bar',
            data: {
                labels: revenueLabels,
                datasets: [{
                    label: 'Revenue ($)',
                    data: revenueData,
                    backgroundColor: '#0F62FE',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: 'rgba(110, 110, 110, 0.15)' }, ticks: { color: '#6F6E77' }, beginAtZero: true },
                    x: { grid: { display: false }, ticks: { color: '#6F6E77' } }
                }
            }
        });
    });
</script>
@endpush
