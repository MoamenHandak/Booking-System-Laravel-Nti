/**
 * Admin Dashboard UI Interactions (FontAwesome 6 + Theme & i18n Translation)
 */

const i18nDict = {
    ar: {
        overview: "نظرة عامة",
        management: "الإدارة",
        operations: "العمليات",
        dashboard: "لوحة التحكم",
        cities: "المدن",
        hotels: "الفنادق",
        rooms: "الغرف",
        bookings: "الحجوزات",
        reports: "التقارير والإحصائيات",
        admin: "المدير",
        administrator: "مدير النظام",
        logout: "تسجيل الخروج",
        notifications: "الإشعارات",
        unread: "غير مقروء",
        no_notifications: "لا توجد إشعارات جديدة.",

        welcome_back: "مرحباً بعودتك",
        dashboard_subtitle: "إليك ملخص نشاط الفنادق والحجوزات اليوم.",
        refresh: "تحديث",
        manage_bookings: "إدارة الحجوزات",
        total_bookings: "إجمالي الحجوزات",
        total_revenue: "إجمالي الإيرادات",
        total_users: "إجمالي المستخدمين",
        available_places: "الأماكن المتاحة",
        vs_last_month: "مقارنة بالشهر الماضي",
        booking_statistics: "إحصائيات الحجوزات عبر الزمن",
        monthly_volume: "حجم الحجوزات الشهرية",
        this_year: "هذا العام (2026)",
        most_booked_places: "أكثر الأماكن حجزاً",
        distribution_by_hotel: "التوزيع حسب أفضل الفنادق",
        revenue_overview: "نظرة عامة على الإيرادات",
        quarterly_earnings: "الأرباح الربع سنوية ($)",
        recent_reservations: "أحدث الحجوزات",
        latest_guest_activity: "أحدث نشاط للنزلاء",
        view_all: "عرض الكل",

        financial_booking_reports: "التقارير المالية والحجوزات",
        print_save_report: "طباعة / حفظ التقرير",
        monthly_revenue: "الإيرادات الشهرية",
        avg_booking_value: "متوسط قيمة الحجز",
        current_month: "الشهر الحالي",
        per_reservation: "لكل حجز",
        confirmed: "مؤكد",
        all_time: "كل الأوقات",
        top_booked_hotels: "أفضل الفنادق حجزاً",
        top_booked_room_types: "أفضل أنواع الغرف حجزاً",

        guest_name: "اسم النزيل",
        hotel_room: "الفندق / الغرفة",
        dates: "التواريخ",
        total: "الإجمالي",
        status: "الحالة",
        actions: "الإجراءات",
        hotel_name: "اسم الفندق",
        city: "المدينة",
        rating: "التقييم",
        bookings_count: "الحجوزات",
        room_type: "نوع الغرفة",
        hotel: "الفندق",
        night_rate: "سعر الليلة",
        total_stays: "إجمالي الإقامات",
        room_number: "رقم الغرفة",
        price: "السعر",
        capacity: "السعة",
        availability: "التوفر",

        approve: "موافقة",
        reject: "رفض",
        check_in: "تسجيل دخول",
        check_out: "تسجيل خروج",
        add_city: "إضافة مدينة جديدة",
        add_hotel: "إضافة فندق جديد",
        add_room: "إضافة غرفة جديدة",
        edit: "تعديل",
        delete: "حذف",
        search: "البحث في النظام...",

        status_pending: "قيد الانتظار",
        status_confirmed: "مؤكد",
        status_approved: "مقبول",
        status_checked_in: "تم الدخول",
        status_checked_out: "تم الخروج",
        status_rejected: "مرفوض",
        status_cancelled: "ملغى",
        status_available: "متاح",
        status_occupied: "مشغول",
        status_maintenance: "صيانة"
    },
    en: {
        overview: "Overview",
        management: "Management",
        operations: "Operations",
        dashboard: "Dashboard",
        cities: "Cities",
        hotels: "Hotels",
        rooms: "Rooms",
        bookings: "Bookings",
        reports: "Reports & Analytics",
        admin: "Admin",
        administrator: "Administrator",
        logout: "Logout",
        notifications: "Notifications",
        unread: "Unread",
        no_notifications: "No new notifications.",

        welcome_back: "Welcome back",
        dashboard_subtitle: "Here is what is happening with your hotels & bookings today.",
        refresh: "Refresh",
        manage_bookings: "Manage Bookings",
        total_bookings: "Total Bookings",
        total_revenue: "Total Revenue",
        total_users: "Total Users",
        available_places: "Available Places",
        vs_last_month: "vs last month",
        booking_statistics: "Booking Statistics Over Time",
        monthly_volume: "Monthly reservation volume",
        this_year: "This Year (2026)",
        most_booked_places: "Most Booked Places",
        distribution_by_hotel: "Distribution by Top Hotel",
        revenue_overview: "Revenue Overview",
        quarterly_earnings: "Quarterly earnings ($)",
        recent_reservations: "Recent Reservations",
        latest_guest_activity: "Latest guest activity",
        view_all: "View All",

        financial_booking_reports: "Financial & Booking Reports",
        print_save_report: "Print / Save Report",
        monthly_revenue: "MONTHLY REVENUE",
        avg_booking_value: "AVG BOOKING VALUE",
        current_month: "Current Month",
        per_reservation: "Per Reservation",
        confirmed: "Confirmed",
        all_time: "All Time",
        top_booked_hotels: "Top Booked Hotels",
        top_booked_room_types: "Top Booked Room Types",

        guest_name: "GUEST NAME",
        hotel_room: "HOTEL / ROOM",
        dates: "DATES",
        total: "TOTAL",
        status: "STATUS",
        actions: "ACTIONS",
        hotel_name: "HOTEL NAME",
        city: "CITY",
        rating: "RATING",
        bookings_count: "BOOKINGS",
        room_type: "ROOM TYPE",
        hotel: "HOTEL",
        night_rate: "NIGHT RATE",
        total_stays: "TOTAL STAYS",
        room_number: "ROOM NUMBER",
        price: "PRICE",
        capacity: "CAPACITY",
        availability: "AVAILABILITY",

        approve: "Approve",
        reject: "Reject",
        check_in: "Check In",
        check_out: "Check Out",
        add_city: "Add New City",
        add_hotel: "Add New Hotel",
        add_room: "Add New Room",
        edit: "Edit",
        delete: "Delete",
        search: "Search system...",

        status_pending: "Pending",
        status_confirmed: "Confirmed",
        status_approved: "Approved",
        status_checked_in: "Checked In",
        status_checked_out: "Checked Out",
        status_rejected: "Rejected",
        status_cancelled: "Cancelled",
        status_available: "Available",
        status_occupied: "Occupied",
        status_maintenance: "Maintenance"
    }
};

document.addEventListener('DOMContentLoaded', function () {
    // 1. Sidebar Toggle Mobile Behavior
    const sidebarToggle = document.getElementById('sidebarToggle');
    const adminSidebar = document.querySelector('.admin-sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggle && adminSidebar) {
        sidebarToggle.addEventListener('click', function () {
            adminSidebar.classList.toggle('show');
            if (sidebarOverlay) {
                sidebarOverlay.classList.toggle('show');
            }
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function () {
            adminSidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });
    }

    // 2. Client-side Table Search Filter
    const searchInputs = document.querySelectorAll('[data-table-search]');
    searchInputs.forEach(input => {
        input.addEventListener('keyup', function () {
            const targetTableId = this.getAttribute('data-table-search');
            const table = document.getElementById(targetTableId);
            if (!table) return;

            const query = this.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    });

    // 3. Client-side Status Filter Dropdown
    const statusFilters = document.querySelectorAll('[data-table-filter="status"]');
    statusFilters.forEach(filter => {
        filter.addEventListener('change', function () {
            const targetTableId = this.getAttribute('data-table-target');
            const table = document.getElementById(targetTableId);
            if (!table) return;

            const filterValue = this.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const statusCell = row.querySelector('[data-status]');
                if (!statusCell) return;

                const status = statusCell.getAttribute('data-status').toLowerCase();
                if (filterValue === 'all' || filterValue === '' || status === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    // 4. Dark Mode Persistence & Initialization
    const currentTheme = localStorage.getItem('admin_theme') || 'light';
    document.documentElement.setAttribute('data-theme', currentTheme);
    updateThemeIcon(currentTheme);

    const themeToggleBtn = document.getElementById('darkModeToggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function () {
            const activeTheme = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', activeTheme);
            localStorage.setItem('admin_theme', activeTheme);
            updateThemeIcon(activeTheme);
            showToast('Theme Updated', `Switched to ${activeTheme} mode`, 'info');
        });
    }

    function updateThemeIcon(theme) {
        const iconEl = document.getElementById('themeIcon');
        if (iconEl) {
            iconEl.className = theme === 'dark' ? 'fa-solid fa-sun fs-6' : 'fa-solid fa-moon fs-6';
        }
    }

    // 5. Language Switcher Initialization
    const currentLang = localStorage.getItem('admin_lang') || 'en';
    switchAdminLang(currentLang, false);
});

/**
 * Language Switcher Helper (Dynamic Translation & Direction Toggle)
 */
function switchAdminLang(lang, showNotification = true) {
    localStorage.setItem('admin_lang', lang);
    document.documentElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
    document.documentElement.setAttribute('lang', lang);

    const langTextEl = document.getElementById('currentLangText');
    if (langTextEl) {
        langTextEl.textContent = lang === 'ar' ? 'AR' : 'EN';
    }

    const dict = i18nDict[lang] || i18nDict['en'];

    // Translate all elements with data-i18n
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.getAttribute('data-i18n');
        if (dict[key]) {
            el.textContent = dict[key];
        }
    });

    // Translate elements with data-i18n-status
    document.querySelectorAll('[data-i18n-status]').forEach(el => {
        const statusKey = 'status_' + el.getAttribute('data-i18n-status');
        if (dict[statusKey]) {
            el.textContent = dict[statusKey];
        }
    });

    // Translate placeholders
    document.querySelectorAll('input[placeholder]').forEach(el => {
        if (el.getAttribute('placeholder').toLowerCase().includes('search')) {
            el.setAttribute('placeholder', dict['search'] || 'Search...');
        }
    });

    if (showNotification) {
        showToast('Language Changed', `Switched to ${lang === 'ar' ? 'العربية' : 'English'}`, 'info');
    }
}

/**
 * Toast Notification Helper
 */
function showToast(title, message, type = 'primary') {
    const container = document.getElementById('toastContainer');
    if (!container) return;

    const toastId = 'toast-' + Date.now();
    const bgHeaderClass = type === 'success' ? 'bg-primary text-white' :
                          type === 'danger' ? 'bg-danger text-white' :
                          type === 'warning' ? 'bg-warning text-dark' : 'bg-dark text-white';

    const toastHtml = `
        <div id="${toastId}" class="toast shadow-lg border-0 mb-2 overflow-hidden" style="border-radius: 12px;" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header ${bgHeaderClass} py-2 px-3">
                <i class="fa-solid fa-bell me-2"></i>
                <strong class="me-auto" style="font-size: 0.85rem;">${title}</strong>
                <small class="opacity-75">Just now</small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-white py-2 px-3 text-dark" style="font-size: 0.85rem;">
                ${message}
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', toastHtml);
    const toastEl = document.getElementById(toastId);
    if (toastEl && window.bootstrap) {
        const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
        toast.show();
        toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
    }
}
