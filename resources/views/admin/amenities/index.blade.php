@extends('layout.admin')

@php
    $pageTitle = 'Amenities Management';
@endphp

@section('title', 'Amenities')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1" data-i18n="amenities_title">Hotel & Room Amenities</h2>
            <p class="text-muted mb-0 small" data-i18n="amenities_subtitle">Manage global features, facility icons, and services offered across hotel properties.</p>
        </div>
        <button class="btn btn-primary-blue" data-bs-toggle="modal" data-bs-target="#addAmenityModal">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i> <span data-i18n="add_new_amenity">Add Amenity</span>
        </button>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Filter Card -->
    <div class="card-custom p-3 mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="search-input-group w-100">
                    <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                    <input type="text" class="form-control" placeholder="Search amenity name..." data-i18n-placeholder="search_amenity_placeholder" data-table-search="amenitiesTable">
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Amenities Table Card -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="amenitiesTable">
                <thead>
                    <tr>
                        <th style="width: 60px;" data-i18n="icon">Icon</th>
                        <th data-i18n="amenity_name">Amenity Name</th>
                        <th data-i18n="usage_count">Usage Count</th>
                        <th data-i18n="category">Category</th>
                        <th data-i18n="status">Status</th>
                        <th class="text-end" data-i18n="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <div class="py-2">
                                <i data-lucide="sparkles" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                <p class="mb-0 small fw-semibold" data-i18n="no_amenities_available">No amenities available</p>
                                <span class="small text-secondary" data-i18n="no_amenities_desc">Amenity records will appear here once retrieved from the database.</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <x-pagination :total="0" :perPage="10" />
    </div>

</div>

<!-- Add Amenity Modal -->
<div class="modal fade" id="addAmenityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <form action="" method="POST" class="js-dummy-form">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0" data-i18n="add_new_amenity">Add Amenity</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" data-i18n="amenity_name">Amenity Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Swimming Pool" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" data-i18n="icon">Icon</label>
                        <input type="text" name="icon" class="form-control" placeholder="e.g. wifi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal" data-i18n="cancel">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue" data-i18n="save_amenity">Save Amenity</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Amenity Modal -->
<div class="modal fade" id="editAmenityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <form action="" method="POST" class="js-dummy-form">
                @csrf
                @method('PUT')
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0" data-i18n="edit_amenity">Edit Amenity</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" data-i18n="amenity_name">Amenity Name</label>
                        <input type="text" name="name" class="form-control" value="" placeholder="Amenity Name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal" data-i18n="cancel">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue" data-i18n="update_amenity">Update Amenity</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
