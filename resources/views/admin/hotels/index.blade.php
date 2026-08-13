@extends('layout.admin')

@php
    $pageTitle = 'Hotels Management';
@endphp

@section('title', 'Hotels')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">Hotels & Properties</h2>
            <p class="text-muted mb-0 small">Manage registered hotel properties, resort listings, and addresses.</p>
        </div>
        <button class="btn btn-primary-blue" data-bs-toggle="modal" data-bs-target="#addHotelModal">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i> Add New Hotel
        </button>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Filter Card -->
    <div class="card-custom p-3 mb-4">
        <form method="GET" action="{{ route('admin.hotels.index') }}">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-md-5 col-lg-4">
                    <div class="search-input-group w-100">
                        <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                        <input type="text" name="search" class="form-control" placeholder="Search hotel name or address..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <select name="city_id" class="form-select" onchange="this.form.submit()">
                        <option value="">All Cities</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-secondary-light btn-sm">Filter</button>
                    @if(request('search') || request('city_id'))
                        <a href="{{ route('admin.hotels.index') }}" class="btn btn-link text-decoration-none btn-sm">Reset</a>
                    @endif
                </div>
                <div class="col-12 col-sm-6 col-md-3 ms-auto text-end">
                    <span class="text-muted small">
                        Total Hotels: <strong class="text-dark">{{ $hotels->total() }}</strong>
                    </span>
                </div>
            </div>
        </form>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Hotels Table Card -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="hotelsTable">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Hotel Name</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Rating</th>
                        <th>Rooms</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hotels as $hotel)
                        <tr>
                            <td><strong class="text-dark">#{{ $hotel->id }}</strong></td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $hotel->name }}</div>
                                @if($hotel->description)
                                    <small class="text-muted text-truncate d-inline-block" style="max-width: 250px;">{{ $hotel->description }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <i data-lucide="map-pin" style="width: 12px; height: 12px;" class="me-1"></i>
                                    {{ $hotel->city->name ?? 'Unassigned' }}
                                </span>
                            </td>
                            <td><span class="text-muted small">{{ $hotel->address ?? 'N/A' }}</span></td>
                            <td>
                                <div class="d-flex align-items-center text-warning fw-semibold small">
                                    <i data-lucide="star" style="width: 14px; height: 14px;" class="fill-current me-1"></i>
                                    {{ number_format($hotel->rating ?? 0, 1) }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                    {{ $hotel->rooms_count ?? 0 }} Rooms
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <button class="btn btn-sm btn-outline-secondary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editHotelModal{{ $hotel->id }}">
                                        <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this hotel?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Hotel Modal -->
                        <div class="modal fade" id="editHotelModal{{ $hotel->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content shadow-lg border-0">
                                    <form action="{{ route('admin.hotels.update', $hotel) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title fw-bold fs-6 mb-0">Edit Hotel: {{ $hotel->name }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Hotel Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $hotel->name }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">City</label>
                                                    <select name="city_id" class="form-select" required>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}" {{ $hotel->city_id == $city->id ? 'selected' : '' }}>
                                                                {{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Address</label>
                                                    <input type="text" name="address" class="form-control" value="{{ $hotel->address }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Rating (0 - 5)</label>
                                                    <input type="number" step="0.1" min="0" max="5" name="rating" class="form-control" value="{{ $hotel->rating }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-semibold">Description</label>
                                                    <textarea name="description" class="form-control" rows="3">{{ $hotel->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary-blue">Update Hotel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <div class="py-2">
                                    <i data-lucide="building-2" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                    <p class="mb-0 small fw-semibold">No hotels available</p>
                                    <span class="small text-secondary">Added hotel listings will appear here.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top">
            {{ $hotels->links() }}
        </div>
    </div>

</div>

<!-- Add Hotel Modal -->
<div class="modal fade" id="addHotelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <form action="{{ route('admin.hotels.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0">Add New Hotel Listing</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Hotel Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Grand Hotel Cairo" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">City</label>
                            <select name="city_id" class="form-select" required>
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="e.g. 123 Nile Corniche">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Rating (0 - 5)</label>
                            <input type="number" step="0.1" min="0" max="5" name="rating" class="form-control" value="4.5">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Hotel summary and features..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue">Create Hotel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection