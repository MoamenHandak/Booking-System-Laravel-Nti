<aside class="admin-sidebar">
    <!-- Sidebar Brand -->
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand text-decoration-none d-flex align-items-center gap-2">
        <div class="brand-icon">
            <i class="fa-solid fa-hotel fs-6"></i>
        </div>
        <span>GrandStay</span>
    </a>

    <!-- Navigation -->
    <div class="sidebar-menu">
        <div class="sidebar-heading" data-i18n="overview">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link-custom {{ request()->is('admin/dashboard') || request()->is('admin') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high me-2"></i>
            <span data-i18n="dashboard">Dashboard</span>
        </a>

        <div class="sidebar-heading mt-2" data-i18n="management">Management</div>
        <a href="{{ route('admin.cities.index') }}" class="nav-link-custom {{ request()->is('admin/cities*') ? 'active' : '' }}">
            <i class="fa-solid fa-location-dot me-2"></i>
            <span data-i18n="cities">Cities</span>
        </a>
        <a href="{{ route('admin.hotels.index') }}" class="nav-link-custom {{ request()->is('admin/hotels*') ? 'active' : '' }}">
            <i class="fa-solid fa-hotel me-2"></i>
            <span data-i18n="hotels">Hotels</span>
        </a>
        <a href="{{ route('admin.rooms.index') }}" class="nav-link-custom {{ request()->is('admin/rooms*') ? 'active' : '' }}">
            <i class="fa-solid fa-bed me-2"></i>
            <span data-i18n="rooms">Rooms</span>
        </a>

        <div class="sidebar-heading mt-2" data-i18n="operations">Operations</div>
        <a href="{{ route('admin.bookings.index') }}" class="nav-link-custom {{ request()->is('admin/bookings*') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-check me-2"></i>
            <span data-i18n="bookings">Bookings</span>
        </a>
        <a href="{{ route('admin.reports.index') }}" class="nav-link-custom {{ request()->is('admin/reports*') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-pie me-2"></i>
            <span data-i18n="reports">Reports & Analytics</span>
        </a>
    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <div class="admin-profile-card">
            <div class="btn-circle btn-circle-slate" style="width: 38px; height: 38px;">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="admin-info overflow-hidden">
                <p class="admin-name text-truncate">
                    {{ auth()->user()->name ?? 'Admin' }}
                </p>
                <p class="admin-role" data-i18n="administrator">
                    Administrator
                </p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="d-inline ms-auto">
                @csrf
                <button type="submit" class="btn btn-link text-secondary p-0 text-decoration-none" title="Logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
