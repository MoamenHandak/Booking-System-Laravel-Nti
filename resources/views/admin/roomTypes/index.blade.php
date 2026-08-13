@extends('layout.admin')

@php
    $pageTitle = 'Room Types Management';
@endphp

@section('title', 'Room Types')

@section('content')
<div class="container-fluid p-0">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="h4 fw-bold text-dark mb-1" data-i18n="room_categories">Room Categories</h2>
            <p class="text-muted mb-0 small" data-i18n="room_categories_subtitle">Configure standard room categories, descriptions, and base rates.</p>
        </div>
        <button class="btn btn-primary-blue" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">
            <i data-lucide="plus" style="width: 15px; height: 15px;"></i> <span data-i18n="add_new_category">Add Category</span>
        </button>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Filter Card -->
    <div class="card-custom p-3 mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="search-input-group w-100">
                    <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                    <input type="text" class="form-control" placeholder="Search room type name..." data-i18n-placeholder="search_category_placeholder" data-table-search="roomTypesTable">
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4 text-secondary opacity-25">

    <!-- Room Types Table Card -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="roomTypesTable">
                <thead>
                    <tr>
                        <th data-i18n="type_name">Type Name</th>
                        <th data-i18n="description">Description</th>
                        <th data-i18n="base_price">Base Price</th>
                        <th data-i18n="number_of_rooms">Number of Rooms</th>
                        <th data-i18n="status">Status</th>
                        <th class="text-end" data-i18n="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <div class="py-2">
                                <i data-lucide="layers-3" style="width: 28px; height: 28px;" class="mb-2 opacity-50"></i>
                                <p class="mb-0 small fw-semibold" data-i18n="no_categories_available">No room categories available</p>
                                <span class="small text-secondary" data-i18n="no_categories_desc">Room category records will appear here once retrieved from the database.</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <x-pagination :total="0" :perPage="10" />
    </div>

</div>

<!-- Add Room Type Modal -->
<div class="modal fade" id="addRoomTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <form action="" method="POST" class="js-dummy-form">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0" data-i18n="add_new_category">Add Category</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" data-i18n="type_name">Type Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Deluxe Suite" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" data-i18n="base_price">Base Price ($)</label>
                        <input type="number" name="base_price" class="form-control" placeholder="200" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal" data-i18n="cancel">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue" data-i18n="save_category">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Room Type Modal -->
<div class="modal fade" id="editRoomTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <form action="" method="POST" class="js-dummy-form">
                @csrf
                @method('PUT')
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold fs-6 mb-0" data-i18n="edit_category">Edit Category</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" data-i18n="base_price">Base Price ($)</label>
                        <input type="number" name="base_price" class="form-control" value="" placeholder="Base Price" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal" data-i18n="cancel">Cancel</button>
                    <button type="submit" class="btn btn-primary-blue" data-i18n="update_category">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
