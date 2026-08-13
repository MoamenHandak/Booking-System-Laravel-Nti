@extends('layout.admin')

@php
    $pageTitle = 'Cities Management';
@endphp

@section('title', 'Cities')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1">Cities & Destinations</h2>
            <p class="text-muted mb-0 small">Manage destination cities where hotel properties and accommodations are located.</p>
        </div>
        <button class="btn btn-primary-blue" data-bs-toggle="modal" data-bs-target="#addCityModal">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i> Add New City
        </button>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Filter Card -->
    <div class="card-custom p-3 mb-4">
        <form method="GET" action="{{ route('admin.cities.index') }}">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="search-input-group w-100">
                        <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                        <input type="text" name="search" class="form-control" placeholder="Search city by name..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-secondary-light btn-sm">Search</button>
                    @if(request('search'))
                        <a href="{{ route('admin.cities.index') }}" class="btn btn-link text-decoration-none btn-sm">Reset</a>
                    @endif
                </div>
                <div class="col-12 col-sm-6 col-md-3 ms-auto text-end">
                    <span class="text-muted small">
                        Total Cities: <strong class="text-dark">{{ $cities->total() }}</strong>
                    </span>
                </div>
            </div>
        </form>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Cities Table Card -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="citiesTable">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>City Name</th>
                        <th>Hotels Count</th>
                        <th>Created At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cities as $city)
                        <tr>
                            <td><strong class="text-dark">#{{ $city->id }}</strong></td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $city->name }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border fw-medium px-2 py-1">
                                    <i data-lucide="building" style="width: 13px; height: 13px;" class="me-1"></i>
                                    {{ $city->hotels_count ?? 0 }} Hotels
                                </span>
                            </td>
                            <td><span class="text-muted small">{{ $city->created_at ? $city->created_at->format('Y-m-d') : 'N/A' }}</span></td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <button class="btn btn-sm btn-outline-secondary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editCityModal{{ $city->id }}">
                                        <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this city?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit City Modal -->
                        <div class="modal fade" id="editCityModal{{ $city->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow-lg border-0">
                                    <form action="{{ route('admin.cities.update', $city) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title fw-bold fs-6 mb-0">Edit City: {{ $city->name }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">City Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $city->name }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary-blue">Update City</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <div class="py-2">
                                    <i data-lucide="map-pin" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                    <p class="mb-0 small fw-semibold">No cities available</p>
                                    <span class="small text-secondary">Added city records will appear here.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top">
            {{ $cities->links() }}
        </div>
    </div>

</div>

<!-- Add City Modal -->
<div class="modal fade" id="addCityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <form action="{{ route('admin.cities.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0">Add New City</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">City Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Cairo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue">Save City</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection