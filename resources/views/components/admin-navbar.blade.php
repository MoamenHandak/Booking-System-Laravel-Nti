@props(['title' => 'Dashboard'])

<header class="top-navbar">
    <div class="d-flex align-items-center gap-3">
        <!-- Sidebar Toggle for Mobile -->
        <button id="sidebarToggle" class="btn btn-outline-secondary btn-circle border-0" type="button" aria-label="Toggle Navigation">
            <i class="fa-solid fa-bars fs-6"></i>
        </button>

        <!-- Page Title & Breadcrumb -->
        <div>
            <h1 class="page-title" data-i18n-title="{{ strtolower(str_replace(' ', '_', $title)) }}">{{ $title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom mb-0 text-muted">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted" data-i18n="admin">Admin</a></li>
                    <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page" data-i18n-title="{{ strtolower(str_replace(' ', '_', $title)) }}">{{ $title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Right Side Actions & User Menu -->
    <div class="d-flex align-items-center gap-2 gap-md-3">
        <!-- Language Switcher Dropdown -->
        <div class="dropdown">
            <button class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2 px-2.5 py-1.5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="langDropdown">
                <i class="fa-solid fa-globe fs-6"></i>
                <span id="currentLangText" class="fw-semibold small">EN</span>
                <i class="fa-solid fa-chevron-down fs-6 opacity-75 ms-1"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" style="border-radius: 12px; min-width: 140px;">
                <li>
                    <a class="dropdown-item small d-flex align-items-center gap-2 py-2" href="#" onclick="switchAdminLang('en'); return false;">
                        <span>🇬🇧</span> English (EN)
                    </a>
                </li>
                <li>
                    <a class="dropdown-item small d-flex align-items-center gap-2 py-2" href="#" onclick="switchAdminLang('ar'); return false;">
                        <span>🇪🇬</span> العربية (AR)
                    </a>
                </li>
            </ul>
        </div>

        <!-- Dark Mode Toggle Button -->
        <button id="darkModeToggle" class="btn btn-outline-secondary btn-circle border-0" type="button" title="Toggle Dark Mode" aria-label="Toggle Dark Mode">
            <i class="fa-solid fa-moon fs-6" id="themeIcon"></i>
        </button>

        <!-- Notification Bell Dropdown -->
        <div class="dropdown">
            <button class="btn btn-outline-secondary btn-circle border-0 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-bell fs-6"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-primary rounded-circle"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-0 overflow-hidden" style="width: 310px; border-radius: 14px;">
                <div class="p-3 bg-primary text-white d-flex align-items-center justify-content-between">
                    <span class="mb-0 fw-bold" style="font-size: 0.85rem;" data-i18n="notifications">Notifications</span>
                    <span class="badge bg-white text-primary fw-bold" style="font-size: 0.7rem;">
                        0 <span data-i18n="unread">Unread</span>
                    </span>
                </div>
                <div class="list-group list-group-flush small">
                    <div class="p-3 text-center text-muted small" data-i18n="no_notifications">
                        No new notifications.
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Profile Dropdown -->
        <div class="dropdown">
            <button class="btn btn-link p-0 border-0 d-flex align-items-center gap-2 text-decoration-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="btn-circle btn-circle-blue" style="width: 36px; height: 36px;">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="d-none d-xl-block text-start">
                    <span class="d-block fw-semibold text-dark lh-1" style="font-size: 0.85rem;">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </span>
                    <small class="text-muted" style="font-size: 0.725rem;" data-i18n="administrator">Administrator</small>
                </div>
                <i class="fa-solid fa-chevron-down text-muted ms-1 fs-6"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" style="border-radius: 12px;">
                <li><a class="dropdown-item small" href="{{ route('admin.dashboard') }}" data-i18n="dashboard">Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item small text-danger" data-i18n="logout">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
