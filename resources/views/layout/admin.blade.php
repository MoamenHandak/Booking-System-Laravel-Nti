<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') — GrandStay System</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- FontAwesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Custom Editorial Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebarOverlay" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50" style="z-index: 1035; display: none;"></div>

    <!-- Admin Sidebar -->
    <x-admin-sidebar />

    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <x-admin-navbar :title="$pageTitle ?? 'Dashboard'" />

        <!-- Dynamic Content Body -->
        <main class="content-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i data-lucide="check-circle" style="width: 18px; height: 18px;" class="me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i data-lucide="alert-circle" style="width: 18px; height: 18px;" class="me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="admin-footer">
            <div>
                &copy; {{ date('Y') }} <span class="fw-semibold text-dark">GrandStay Hotels</span>. Editorial Booking Dashboard.
            </div>
            <div class="d-flex gap-4">
                <a href="#" class="text-secondary text-decoration-none">Privacy Policy</a>
                <a href="#" class="text-secondary text-decoration-none">Terms</a>
                <a href="#" class="text-secondary text-decoration-none">System Support</a>
            </div>
        </footer>
    </div>

    <!-- Reusable Toast & Delete Modal -->
    <x-toast />
    <x-delete-modal />

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Chart.js CDN for Analytics & Dashboard -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom Admin JS -->
    <script src="{{ asset('js/admin.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
