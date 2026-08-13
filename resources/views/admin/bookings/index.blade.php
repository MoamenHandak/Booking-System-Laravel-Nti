@extends('layout.admin')

@php
    $pageTitle = 'Bookings Management';
@endphp

@section('title', 'Bookings')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">Bookings & Reservations</h2>
            <p class="text-muted mb-0 small">Monitor reservation activity, process guest check-ins, and manage status approvals.</p>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Filter Card -->
    <div class="card-custom p-3 mb-4">
        <form method="GET" action="{{ route('admin.bookings.index') }}">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="search-input-group w-100">
                        <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                        <input type="text" name="search" class="form-control" placeholder="Search Guest or Booking ID..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="all">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="checked_in" {{ request('status') == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                        <option value="checked_out" {{ request('status') == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                    <select name="hotel_id" class="form-select" onchange="this.form.submit()">
                        <option value="">All Hotels</option>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}" {{ request('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                {{ $hotel->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-secondary-light btn-sm">Filter</button>
                    @if(request('search') || request('status') || request('hotel_id'))
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-link text-decoration-none btn-sm">Reset</a>
                    @endif
                </div>
                <div class="col-12 col-md-2 ms-auto text-end">
                    <span class="text-muted small">
                        Total: <strong class="text-dark">{{ $bookings->total() }}</strong>
                    </span>
                </div>
            </div>
        </form>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Bookings Table Card -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="bookingsTable">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Guest</th>
                        <th>Hotel</th>
                        <th>Room</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th class="text-end" style="min-width: 170px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td><strong class="text-dark">#{{ $booking->id }}</strong></td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $booking->user->name ?? 'Guest' }}</div>
                                <small class="text-muted">{{ $booking->user->email ?? '' }}</small>
                            </td>
                            <td>{{ $booking->room->hotel->name ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $booking->room->type ?? 'Room' }}
                                </span>
                            </td>
                            <td><span class="small text-muted">{{ $booking->check_in_date ?? $booking->check_in }}</span></td>
                            <td><span class="small text-muted">{{ $booking->check_out_date ?? $booking->check_out }}</span></td>
                            <td><strong class="text-dark">${{ number_format($booking->total_price ?? 0, 2) }}</strong></td>
                            <td><x-status-badge :status="$booking->status" /></td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    @if ($booking->status === 'pending')
                                        <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success px-2 py-1">Approve</button>
                                        </form>
                                        <form action="{{ route('bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger px-2 py-1">Reject</button>
                                        </form>
                                    @elseif ($booking->status === 'approved')
                                        <form action="{{ route('bookings.checkIn', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary px-2 py-1">Check In</button>
                                        </form>
                                    @elseif ($booking->status === 'checked_in')
                                        <form action="{{ route('bookings.checkOut', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-dark px-2 py-1">Check Out</button>
                                        </form>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <div class="py-2">
                                    <i data-lucide="calendar-check" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                    <p class="mb-0 small fw-semibold">No bookings available</p>
                                    <span class="small text-secondary">Guest reservation records will appear here.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top">
            {{ $bookings->links() }}
        </div>
    </div>

</div>
@endsection
