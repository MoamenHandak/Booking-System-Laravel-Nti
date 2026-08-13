@extends('layout.admin')

@php
    $pageTitle = 'Reports & Analytics';
@endphp

@section('title', 'Reports')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1" data-i18n="financial_reports">Financial & Booking Reports</h2>
            <p class="text-muted mb-0 small" data-i18n="reports_subtitle">Performance intelligence, occupancy metrics, and gross revenue reports.</p>
        </div>
        <button class="btn btn-primary-blue" onclick="window.print()">
            <i data-lucide="printer" style="width: 15px; height: 15px;"></i> <span data-i18n="print_report">Print / Save Report</span>
        </button>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Stat Cards Row -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <x-stat-card 
                title="Total Bookings" 
                value="{{ $totalBookings ?? 0 }}" 
                icon="calendar" 
                trend="All Time" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <x-stat-card 
                title="Total Revenue" 
                value="${{ number_format($totalRevenue ?? 0, 2) }}" 
                icon="wallet-2" 
                trend="Confirmed" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <x-stat-card 
                title="Avg Booking Value" 
                value="${{ number_format($avgBookingValue ?? 0, 2) }}" 
                icon="trending-up" 
                trend="Per Reservation" 
                :trendUp="true" 
            />
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <x-stat-card 
                title="Monthly Revenue" 
                value="${{ number_format($monthlyRevenue ?? 0, 2) }}" 
                icon="dollar-sign" 
                trend="Current Month" 
                :trendUp="true" 
            />
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Top Hotels & Top Rooms Tables -->
    <div class="row g-4 mb-4">
        <!-- Top Booked Hotels -->
        <div class="col-12 col-lg-6">
            <div class="card-custom h-100 mb-0">
                <h5 class="fw-bold text-dark mb-3" data-i18n="top_booked_hotels">Top Booked Hotels</h5>
                <div class="table-responsive">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th data-i18n="hotel_name">Hotel Name</th>
                                <th data-i18n="city">City</th>
                                <th data-i18n="rating">Rating</th>
                                <th class="text-end" data-i18n="bookings">Bookings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($topHotels ?? [] as $hotel)
                                <tr>
                                    <td><strong class="text-dark">{{ $hotel->name }}</strong></td>
                                    <td><span class="text-muted small">{{ $hotel->city->name ?? 'N/A' }}</span></td>
                                    <td>
                                        <span class="text-warning fw-semibold small">
                                            ★ {{ number_format($hotel->rating ?? 0, 1) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-primary-subtle text-primary border px-2 py-1">
                                            {{ $hotel->bookings_count ?? 0 }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3" data-i18n="no_hotel_data">No hotel data available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Top Booked Rooms -->
        <div class="col-12 col-lg-6">
            <div class="card-custom h-100 mb-0">
                <h5 class="fw-bold text-dark mb-3" data-i18n="top_booked_rooms">Top Booked Room Types</h5>
                <div class="table-responsive">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th data-i18n="room_type">Room Type</th>
                                <th data-i18n="hotel">Hotel</th>
                                <th data-i18n="night_rate">Night Rate</th>
                                <th class="text-end" data-i18n="total_stays">Total Stays</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($topRooms ?? [] as $room)
                                <tr>
                                    <td><strong class="text-dark">{{ $room->type }}</strong></td>
                                    <td><span class="text-muted small">{{ $room->hotel->name ?? 'N/A' }}</span></td>
                                    <td><span class="fw-semibold">${{ number_format($room->price, 2) }}</span></td>
                                    <td class="text-end">
                                        <span class="badge bg-success-subtle text-success border px-2 py-1">
                                            {{ $room->bookings_count ?? 0 }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3" data-i18n="no_room_data">No room data available</td>
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
