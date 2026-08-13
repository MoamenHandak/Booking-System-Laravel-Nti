@props(['status' => 'Pending'])

@php
    $statusLower = strtolower(trim($status));
    $badgeClass = 'badge-pending';
    $faIcon = 'fa-solid fa-clock';

    switch($statusLower) {
        case 'approved':
        case 'confirmed':
            $badgeClass = 'badge-confirmed';
            $faIcon = 'fa-solid fa-circle-check';
            break;
        case 'checked_in':
        case 'checked in':
        case 'checked-in':
            $badgeClass = 'badge-checked-in';
            $faIcon = 'fa-solid fa-door-open';
            break;
        case 'checked_out':
        case 'checked out':
        case 'checked-out':
            $badgeClass = 'badge-checked-out';
            $faIcon = 'fa-solid fa-right-from-bracket';
            break;
        case 'rejected':
            $badgeClass = 'badge-rejected';
            $faIcon = 'fa-solid fa-circle-xmark';
            break;
        case 'cancelled':
        case 'canceled':
            $badgeClass = 'badge-cancelled';
            $faIcon = 'fa-solid fa-ban';
            break;
        case 'available':
        case 'active':
            $badgeClass = 'badge-available';
            $faIcon = 'fa-solid fa-check';
            break;
        case 'occupied':
            $badgeClass = 'badge-occupied';
            $faIcon = 'fa-solid fa-user-check';
            break;
        case 'maintenance':
        case 'inactive':
            $badgeClass = 'badge-maintenance';
            $faIcon = 'fa-solid fa-wrench';
            break;
    }
@endphp

<span class="badge-pill-custom {{ $badgeClass }}" data-status="{{ $statusLower }}">
    <i class="{{ $faIcon }} me-1" style="font-size: 0.8rem;"></i>
    <span data-i18n-status="{{ $statusLower }}">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
</span>
