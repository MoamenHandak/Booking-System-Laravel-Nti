<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'نظام حجز الفنادق')</title>

    <!-- Bootstrap 5 RTL -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
    >

    <!-- FontAwesome Icons -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    >

    <!-- Google Font (Cairo) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --bg-main: #FDF8F5;
            --card-bg: #FFFFFF;
            --nav-bg: #F8EFEA;
            --text-color: #4A3E3D;
            --text-muted: #8C7A7B;
            --primary-rose: #C88A75;
            --primary-rose-hover: #B07460;
            --accent-brown: #6F4E37;
            --border-color: #F1E4DE;
            --shadow-color: rgba(141, 91, 76, 0.08);
        }

        [data-theme="dark"] {
            --bg-main: #1C1817;
            --card-bg: #272221;
            --nav-bg: #231E1D;
            --text-color: #F3ECE8;
            --text-muted: #BDB0AA;
            --primary-rose: #D8A798;
            --primary-rose-hover: #E3B8AA;
            --accent-brown: #E8C3B9;
            --border-color: #38302E;
            --shadow-color: rgba(0, 0, 0, 0.4);
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-color);
            transition: background-color 0.4s ease, color 0.4s ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .custom-navbar {
            background-color: var(--nav-bg) !important;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 4px 15px var(--shadow-color);
            transition: background-color 0.4s ease, border-color 0.4s ease;
        }

        .custom-navbar .navbar-brand {
            color: var(--accent-brown) !important;
            font-weight: 800;
            font-size: 1.4rem;
        }

        .custom-navbar .nav-link {
            color: var(--text-color) !important;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .custom-navbar .nav-link:hover,
        .custom-navbar .nav-link.active {
            color: var(--primary-rose) !important;
            background-color: rgba(200, 138, 117, 0.1);
        }

        /* Rose Button */
        .btn-nav-rose {
            background-color: var(--primary-rose);
            color: #ffffff !important;
            font-weight: 700;
            border-radius: 10px;
            padding: 6px 18px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-nav-rose:hover {
            background-color: var(--primary-rose-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(200, 138, 117, 0.3);
        }

        /* Outline Button */
        .btn-nav-outline {
            border: 1px solid var(--primary-rose);
            color: var(--primary-rose) !important;
            font-weight: 700;
            border-radius: 10px;
            padding: 6px 18px;
            transition: all 0.3s ease;
            background-color: transparent;
        }

        .btn-nav-outline:hover {
            background-color: var(--primary-rose);
            color: #ffffff !important;
        }

        /* Language Button */
        .language-btn {
            border: 1px solid var(--primary-rose);
            color: var(--primary-rose) !important;
            background-color: transparent;
            font-weight: 700;
            border-radius: 10px;
            padding: 6px 12px;
            transition: all 0.3s ease;
        }

        .language-btn:hover {
            background-color: var(--primary-rose);
            color: #ffffff !important;
        }

        .language-btn i {
            font-size: 0.85rem;
        }

        .language-dropdown {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 8px 25px var(--shadow-color);
            min-width: 160px;
            padding: 6px;
        }

        .language-dropdown .dropdown-item {
            color: var(--text-color);
            font-weight: 600;
            border-radius: 8px;
            padding: 8px 12px;
            transition: all 0.2s ease;
        }

        .language-dropdown .dropdown-item:hover {
            background-color: rgba(200, 138, 117, 0.1);
            color: var(--primary-rose);
        }

        /* Footer */
        footer {
            background-color: var(--nav-bg);
            border-top: 1px solid var(--border-color);
            color: var(--text-muted);
            margin-top: auto;
        }

        /* Dark Mode */
        [data-theme="dark"] .navbar-toggler {
            filter: invert(1);
        }

        [data-theme="dark"] .dropdown-menu {
            background-color: var(--card-bg);
            border-color: var(--border-color);
        }

        [data-theme="dark"] .dropdown-item {
            color: var(--text-color);
        }

        /* Mobile */
        @media (max-width: 991.98px) {
            .language-switch-wrapper {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .user-actions {
                flex-wrap: wrap;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- User Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar sticky-top py-3">
        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center gap-2"
               href="{{ url('/hotels') }}">

                <i
                    class="fa-solid fa-hotel fs-3"
                    style="color: var(--primary-rose);"
                ></i>

               <span>
                    <span data-i18n="site_name">فنادقي</span>
                    <span style="color: var(--primary-rose);">.</span>
                </span>
            </a>

            <!-- Mobile Toggle -->
            <button
                class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#userNavbar"
                aria-controls="userNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="userNavbar">

                <!-- Main Links -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->is('hotels') ? 'active' : '' }}"
                            href="{{ url('/hotels') }}"
                            data-i18n="explore_hotels"
                        >
                            <i class="fa-solid fa-compass me-1"></i>
                            استكشف الفنادق
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ route('offers') }}"
                            data-i18n="offers"
                        >
                            <i class="fa-solid fa-tags me-1"></i>
                            العروض والخصومات
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ route('support') }}"
                            data-i18n="support"
                        >
                            <i class="fa-solid fa-headset me-1"></i>
                            الدعم الفني
                        </a>
                    </li>

                </ul>

                <!-- Right Actions -->
                <div class="d-flex align-items-center gap-2 user-actions">

                    <!-- Dark Mode Toggle Button -->
                    <button
                        id="userThemeToggleBtn"
                        class="language-btn d-flex align-items-center gap-2"
                        type="button"
                        title="Toggle Dark Mode"
                        aria-label="Toggle Dark Mode"
                    >
                        <i class="fa-solid fa-moon text-warning" id="userThemeIcon"></i>
                        <span id="userThemeText" data-i18n="theme_dark">المظهر الداكن</span>
                    </button>

                    <!-- Language Switcher -->
                    <div class="dropdown language-switch-wrapper">

                        <button
                            class="language-btn dropdown-toggle d-flex align-items-center gap-2"
                            type="button"
                            id="userLanguageDropdown"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="fa-solid fa-globe"></i>

                            <span id="currentUserLangText">AR</span>
                        </button>

                        <ul
                            class="dropdown-menu dropdown-menu-end language-dropdown"
                            aria-labelledby="userLanguageDropdown"
                        >

                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center gap-2"
                                    href="#"
                                    onclick="switchUserLang('en'); return false;"
                                >
                                    <span>🇬🇧</span>
                                    <span>English (EN)</span>
                                </a>
                            </li>

                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center gap-2"
                                    href="#"
                                    onclick="switchUserLang('ar'); return false;"
                                >
                                    <span>🇪🇬</span>
                                    <span>العربية (AR)</span>
                                </a>
                            </li>

                        </ul>
                    </div>

                    @guest

                        <!-- Login -->
                        <a
                            href="{{ url('/login') }}"
                            class="btn btn-nav-outline btn-sm"
                            data-i18n="login"
                        >
                            تسجيل الدخول
                        </a>

                        <!-- Register -->
                        <a
                            href="{{ url('/register') }}"
                            class="btn btn-nav-rose btn-sm"
                            data-i18n="register"
                        >
                            حساب جديد
                        </a>

                    @else

                        <!-- User Name -->
                        <span class="fw-bold small">
                            {{ auth()->user()->name }}
                        </span>

                        <!-- My Bookings -->
                        <a
                            href="{{ url('/my-bookings') }}"
                            class="btn btn-nav-outline btn-sm"
                            data-i18n="my_bookings"
                        >
                            حجوزاتي
                        </a>

                        <!-- Logout -->
                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                            class="m-0"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="btn btn-nav-rose btn-sm"
                                data-i18n="logout"
                            >
                                تسجيل الخروج
                            </button>
                        </form>

                    @endguest

                </div>

            </div>
        </div>
    </nav>

    <!-- Main Page Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-4 text-center">

        <div class="container">

            <p class="mb-0 small">

                &copy; {{ date('Y') }}

                <span data-i18n="footer_rights">
                    جميع الحقوق محفوظة
                </span>

                لـ <strong>فنادقي</strong>

                <span data-i18n="footer_description">
                    - ملاذك الأمثل للإقامة الفاخرة
                </span>

            </p>

        </div>

    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- User Language System -->
    <script src="{{ asset('js/user.js') }}"></script>

    @stack('scripts')

</body>

</html>