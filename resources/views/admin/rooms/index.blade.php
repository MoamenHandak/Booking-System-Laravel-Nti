@extends('layout.admin')

@php
    $pageTitle = 'Rooms Management';
@endphp

@section('title', 'Rooms')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">Hotel Rooms</h2>
            <p class="text-muted mb-0 small">Manage individual room inventory, room pricing, capacities, and availability status.</p>
        </div>
        <button class="btn btn-primary-blue" data-bs-toggle="modal" data-bs-target="#addRoomModal">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i> Add New Room
        </button>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Filter Card -->
    <div class="card-custom p-3 mb-4">
        <form method="GET" action="{{ route('admin.rooms.index') }}">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-md-4">
                    <div class="search-input-group w-100">
                        <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                        <input type="text" name="search" class="form-control" placeholder="Search room type or hotel..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <select name="hotel_id" class="form-select" onchange="this.form.submit()">
                        <option value="">All Hotels</option>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}" {{ request('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                {{ $hotel->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <select name="is_available" class="form-select" onchange="this.form.submit()">
                        <option value="">All Room Statuses</option>
                        <option value="1" {{ request('is_available') === '1' ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ request('is_available') === '0' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-secondary-light btn-sm">Filter</button>
                    @if(request('search') || request('hotel_id') || request('is_available') !== null)
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-link text-decoration-none btn-sm">Reset</a>
                    @endif
                </div>
                <div class="col-12 col-sm-6 col-md-2 ms-auto text-end">
                    <span class="text-muted small">
                        Total Rooms: <strong class="text-dark">{{ $rooms->total() }}</strong>
                    </span>
                </div>
            </div>
        </form>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Rooms Table Card -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="roomsTable">
                <thead>
                    <tr>
                        <th style="width: 70px;">Image</th>
                        <th>Room Type / #</th>
                        <th>Hotel</th>
                        <th>Price / Night</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rooms as $room)
                        <tr>
                            <td>
                                @if ($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" class="rounded" width="55" height="40" style="object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 55px; height: 40px;">
                                        <i data-lucide="bed-double" style="width: 18px; height: 18px;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $room->type }}</div>
                                <small class="text-muted">ID: #{{ $room->id }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <i data-lucide="building" style="width: 12px; height: 12px;" class="me-1"></i>
                                    {{ $room->hotel->name ?? 'Unassigned' }}
                                </span>
                            </td>
                            <td><strong class="text-dark">${{ number_format($room->price, 2) }}</strong></td>
                            <td>
                                <span class="text-muted small">
                                    <i data-lucide="users" style="width: 13px; height: 13px;" class="me-1"></i>
                                    {{ $room->capacity }} Guests
                                </span>
                            </td>
                            <td>
                                @if ($room->is_available)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                        Available
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                                        Occupied / Unavailable
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <button class="btn btn-sm btn-outline-secondary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editRoomModal{{ $room->id }}">
                                        <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this room?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Room Modal -->
                        <div class="modal fade" id="editRoomModal{{ $room->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content shadow-lg border-0">
                                    <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title fw-bold fs-6 mb-0">Edit Room: {{ $room->type }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Hotel</label>
                                                    <select name="hotel_id" class="form-select" required>
                                                        @foreach ($hotels as $hotel)
                                                            <option value="{{ $hotel->id }}" {{ $room->hotel_id == $hotel->id ? 'selected' : '' }}>
                                                                {{ $hotel->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Room Type / Name</label>
                                                    <input type="text" name="type" class="form-control" value="{{ $room->type }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Price per Night ($)</label>
                                                    <input type="number" step="0.01" name="price" class="form-control" value="{{ $room->price }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Capacity (Guests)</label>
                                                    <input type="number" name="capacity" class="form-control" value="{{ $room->capacity }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Room Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <div class="form-check mt-4">
                                                        <input class="form-check-input" type="checkbox" name="is_available" value="1" id="isAvail{{ $room->id }}" {{ $room->is_available ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-semibold" for="isAvail{{ $room->id }}">
                                                            Is Room Available for Booking
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-semibold">Description</label>
                                                    <textarea name="description" class="form-control" rows="3">{{ $room->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary-blue">Update Room</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <div class="py-2">
                                    <i data-lucide="bed-double" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                    <p class="mb-0 small fw-semibold">No rooms available</p>
                                    <span class="small text-secondary">Added room inventory will appear here.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top">
            {{ $rooms->links() }}
        </div>
    </div>

</div>

<!-- Add Room Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0">Add New Room</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Hotel</label>
                            <select name="hotel_id" class="form-select" required>
                                <option value="">Select Hotel</option>
                                @foreach ($hotels as $hotel)
                                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Room Type / Name</label>
                            <input type="text" name="type" class="form-control" placeholder="e.g. Deluxe Sea View Suite" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Price per Night ($)</label>
                            <input type="number" step="0.01" name="price" class="form-control" placeholder="150.00" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Capacity (Guests)</label>
                            <input type="number" name="capacity" class="form-control" value="2" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Room Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" name="is_available" value="1" id="isAvailNew" checked>
                                <label class="form-check-label fw-semibold" for="isAvailNew">
                                    Is Room Available for Booking
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Room amenities, bed type, view..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection