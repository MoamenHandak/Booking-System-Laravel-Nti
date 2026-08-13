# Hotel & Apartment Booking System — Admin Dashboard Documentation

## Executive Summary

This document provides a comprehensive technical guide and architecture summary of the **Admin Dashboard Frontend** built for the Laravel Hotel & Apartment Booking System.

The interface was designed to deliver a modern, human-crafted aesthetic with soft elevated cards, flat status badges, custom color tokens, borderless layout boundaries, and clean responsiveness. All demo data has been cleaned, and professional empty states with explicit `BACKEND TODO` comments have been added for seamless integration with Laravel database models.

---

## 1. Technology Stack

- **Framework**: Laravel Blade Templates
- **CSS Framework**: Bootstrap 5.3 (Grid, Modals, Dropdowns) + Custom Design Tokens (`public/css/admin.css`)
- **JavaScript**: Vanilla JS (`public/js/admin.js`) for interactive search filters, status dropdowns, modal actions, and toast notifications.
- **Icons**: Lucide Icons CDN (`https://unpkg.com/lucide@latest`)
- **Data Visualization**: Chart.js v4.4.1

---

## 2. Design System & Visual Language

### Color Palette Tokens
| Token | Hex / Value | Usage |
|---|---|---|
| `--primary-color` | `#0F62FE` | Primary action buttons, active navigation highlights, chart line/bar fills |
| `--primary-hover` | `#0353E9` | Hover states for primary buttons |
| `--secondary-color` | `#6F6E77` | Muted labels, table column headers, secondary icons |
| `--tertiary-bg` | `#F2F4F8` | Table headers, search/input background fills |
| `--body-bg` | `#F2F4F8` | Page canvas background |
| `--neutral-dark` | `#161616` | Text headings, body copy, inverted dark buttons |
| `--card-bg` | `#FFFFFF` | Background for stat boxes and section containers |

### Component Geometry & Elevation
- **Card Containers & Modals**: `14px` border radius (`.card-custom`, `.stat-card-box`, `.modal-content`)
- **Buttons & Inputs**: `8px` border radius (`.btn-primary-blue`, `.btn-secondary-light`, `.btn-inverted`, `.form-control`, `.form-select`)
- **Action Buttons**: `50%` circular icon buttons (`.btn-circle-blue`, `.btn-circle-slate`, `.btn-circle-dark`, `.btn-circle-red`)
- **Status Badges**: `20px` soft rounded flat pill badges (`.badge-pill-custom`) without outlines
- **Elevation**: Soft, subtle box shadows (`box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);`)

---

## 3. Core Admin Modules Overview

The Admin Dashboard frontend contains **8 core pages**:

### 1. Dashboard Overview (`/admin/dashboard`)
- **Header**: Action buttons for manual refresh and quick navigation to bookings.
- **KPI Cards**: 4 metric cards (Total Bookings, Total Revenue, Total Users, Available Places).
- **Interactive Charts**:
  - *Booking Statistics Over Time* (Line chart) with year filter dropdown.
  - *Most Booked Places* (Doughnut chart) for hotel distribution.
  - *Revenue Overview* (Bar chart) for quarterly earnings.
- **Recent Reservations Table**: List of latest booking records with quick status action buttons.

### 2. Cities & Destinations (`/admin/cities`)
- **Overview**: Table displaying destination cities, regional tags, associated hotel counts, and active/inactive status.
- **Features**: Live search input, status filter, pagination, Add New City modal, and Edit City modal.

### 3. Hotels & Properties (`/admin/hotels`)
- **Overview**: Property management table featuring hotel image thumbnails, addresses, city badges, star ratings, room count, and status badges.
- **Features**: Search bar, city dropdown filter, status filter, Add New Hotel modal, Edit Hotel modal, and delete confirmation modal.

### 4. Hotel Rooms (`/admin/rooms`)
- **Overview**: Room inventory table displaying room numbers, assigned hotels, room type categories, night rates ($), max guest capacity, and availability status (`Available`, `Occupied`, `Maintenance`).
- **Features**: Search input, hotel select filter, status filter, Add Room modal, Edit Room modal.

### 5. Room Types / Categories (`/admin/room-types`)
- **Overview**: Category configuration table for room types, capacity specs (bed count & sqm), detailed descriptions, base prices ($), total rooms count, and status badges.
- **Features**: Search filter, Add Category modal, Edit Category modal.

### 6. Amenities (`/admin/amenities`)
- **Overview**: Global features and facility table showcasing Lucide icon previews, amenity names, hotel/room usage count, category badges (`In-Room`, `General`, `Hotel Facility`), and status badges.
- **Features**: Search filter, Add Amenity modal, Edit Amenity modal.

### 7. Bookings & Reservations (`/admin/bookings`)
- **Overview**: Central booking management table displaying Booking ID (`#BK-XXXX`), guest contact info, hotel, room number, check-in/out dates, guest count, total price ($), and status badges.
- **Supported Statuses**: `Pending`, `Confirmed`, `Checked In`, `Checked Out`, `Rejected`, `Cancelled`.
- **Interactive Actions**: Circular action buttons for Accepting (`check`), Rejecting (`x`), Check-In (`door-open`), Check-Out (`log-out`), and Viewing Details (`eye`).
- **Features**: Search input, status dropdown filter, hotel dropdown filter, date range filter, Export CSV action, and Booking Details modal.

### 8. Reports & Analytics (`/admin/reports`)
- **Overview**: Business intelligence page with date range filters, city/hotel filters, 4 financial KPI cards, 2 Chart.js analytics graphs (Bookings Over Time, Revenue Over Time), and a Most Booked Places ranking summary table.
- **Features**: PDF Report Export button.

---

## 4. Backend Integration Guide for Developers

All hardcoded static demo data has been removed. The frontend is prepared with clean empty states and explicit comments.

### Comment Convention Standard
- **Blade Files**: `{{-- BACKEND TODO: Instruction for developer --}}`
- **JavaScript Files**: `// BACKEND TODO: Instruction for developer`

### Key Integration Points for Backend Developers

1. **Looping Records**: Replace empty state rows in table bodies (`<tbody>`) with Blade loops:
   ```blade
   {{-- BACKEND TODO: Replace empty state with loop --}}
   @foreach ($bookings as $booking)
       <tr>...</tr>
   @endforeach
   ```

2. **KPI Card Values**: Bind real controller variables or database aggregation queries:
   ```blade
   <x-stat-card 
       title="Total Bookings" 
       :value="$totalBookingsCount" 
       icon="calendar-check" 
   />
   ```

3. **Form Actions & Submissions**: Update form `action` URLs and HTTP methods (`POST`/`PUT`):
   ```blade
   <form action="{{ route('admin.cities.store') }}" method="POST">
       @csrf
       ...
   </form>
   ```

4. **Chart Datasets**: Feed dynamic arrays from your Laravel controller into the JS chart initialization functions:
   ```javascript
   // BACKEND TODO: Pass dynamic array from controller
   const bookingTrendsData = @json($monthlyBookingsData);
   ```

5. **Pagination**: Replace dummy `<x-pagination>` components with dynamic Laravel links:
   ```blade
   {{ $records->links() }}
   ```

---

## 5. Directory & File Structure

```text
Larvel_Booking_System/
├── public/
│   ├── css/
│   │   └── admin.css          # Design system tokens & custom UI styles
│   └── js/
│       └── admin.js            # Table search, filters, modal triggers, toasts
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── amenities/
│       │   │   └── index.blade.php
│       │   ├── bookings/
│       │   │   └── index.blade.php
│       │   ├── cities/
│       │   │   └── index.blade.php
│       │   ├── hotels/
│       │   │   └── index.blade.php
│       │   ├── reports/
│       │   │   └── index.blade.php
│       │   ├── roomTypes/
│       │   │   └── index.blade.php
│       │   ├── rooms/
│       │   │   └── index.blade.php
│       │   └── dashboard.blade.php
│       ├── components/
│       │   ├── admin-navbar.blade.php
│       │   ├── admin-sidebar.blade.php
│       │   ├── delete-modal.blade.php
│       │   ├── pagination.blade.php
│       │   ├── stat-card.blade.php
│       │   ├── status-badge.blade.php
│       │   └── toast.blade.php
│       └── layout/
│           └── admin.blade.php
└── routes/
    └── web.php                 # Admin routes definitions
```

---

## 6. Git Repository Information

- **Repository**: [`https://github.com/Mariaebrahem/Larvel_Booking_System.git`](https://github.com/Mariaebrahem/Larvel_Booking_System.git)
- **Active Branch**: `frontend-admin`
- **Latest Commit**: `feat: add hotel booking admin dashboard frontend UI`
