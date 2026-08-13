/**
 * Admin Dashboard UI Interactions (FontAwesome 6 + Theme & i18n Translation)
 */

const i18nDict = {
    ar: {
        // Navigation & General
        grandstay: "فنادقي",
        overview: "نظرة عامة",
        management: "الإدارة",
        operations: "العمليات",
        dashboard: "لوحة التحكم",
        dashboard_overview: "لوحة التحكم الرئيسية",
        cities: "المدن",
        cities_management: "إدارة المدن",
        hotels: "الفنادق",
        hotels_management: "إدارة الفنادق",
        rooms: "الغرف",
        rooms_management: "إدارة الغرف",
        room_types: "أنواع الغرف",
        room_types_management: "إدارة أنواع الغرف",
        amenities: "المرافق والخدمات",
        amenities_management: "إدارة المرافق والخدمات",
        bookings: "الحجوزات",
        bookings_management: "إدارة الحجوزات",
        reports: "التقارير والإحصائيات",
        reports_analytics: "التقارير والإحصائيات",
        admin: "المدير",
        administrator: "مدير النظام",
        logout: "تسجيل الخروج",
        notifications: "الإشعارات",
        unread: "غير مقروء",
        no_notifications: "لا توجد إشعارات جديدة.",

        // Headers & Actions
        welcome_back: "مرحباً بعودتك",
        dashboard_subtitle: "إليك ملخص نشاط الفنادق والحجوزات اليوم.",
        refresh: "تحديث",
        manage_bookings: "إدارة الحجوزات",
        filter: "تصفية",
        reset: "إعادة ضبط",
        search: "بحث...",
        search_button: "بحث",
        cancel: "إلغاء",
        save: "حفظ",
        update: "تحديث",
        delete: "حذف",
        edit: "تعديل",
        actions: "الإجراءات",
        details: "التفاصيل",

        // KPI Cards & Trends
        total_bookings: "إجمالي الحجوزات",
        total_revenue: "إجمالي الإيرادات",
        total_users: "إجمالي المستخدمين",
        available_places: "الأماكن المتاحة",
        monthly_revenue: "الإيرادات الشهرية",
        avg_booking_value: "متوسط قيمة الحجز",
        vs_last_month: "مقارنة بالشهر الماضي",
        all_time: "كل الأوقات",
        confirmed: "مؤكد",
        per_reservation: "لكل حجز",
        current_month: "الشهر الحالي",
        live: "مباشر",

        // Dashboard Charts & Lists
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
        no_recent_reservations: "لا توجد حجوزات حديثة متاحة",
        no_recent_reservations_desc: "ستظهر سجلات الحجز الجديدة هنا عند إنشائها.",

        // Cities Module
        cities_destinations: "المدن والوجهات",
        cities_subtitle: "إدارة المدن والوجهات التي تقع فيها الفنادق والمقرات الإقامية.",
        add_new_city: "إضافة مدينة جديدة",
        search_city_placeholder: "ابحث عن المدينة باسمها...",
        total_cities: "إجمالي المدن:",
        city_id: "المعرف",
        city_name: "اسم المدينة",
        hotels_count: "عدد الفنادق",
        created_at: "تاريخ الإنشاء",
        edit_city: "تعديل المدينة",
        save_city: "حفظ المدينة",
        update_city: "تحديث المدينة",
        no_cities_available: "لا توجد مدن متاحة حالياً",
        no_cities_desc: "ستظهر سجلات المدن المضافة هنا.",

        // Hotels Module
        hotels_properties: "الفنادق والعقارات",
        hotels_subtitle: "إدارة الفنادق المسجلة، المنتجات، والعناوين التفصيلية.",
        add_new_hotel: "إضافة فندق جديد",
        search_hotel_placeholder: "ابحث باسم الفندق أو العنوان...",
        all_cities: "جميع المدن",
        total_hotels: "إجمالي الفنادق:",
        hotel_id: "المعرف",
        hotel_name: "اسم الفندق",
        city: "المدينة",
        address: "العنوان",
        rating: "التقييم",
        rooms_count: "الغرف",
        edit_hotel: "تعديل الفندق",
        save_hotel: "حفظ الفندق",
        update_hotel: "تحديث الفندق",
        unassigned: "غير محدد",
        no_hotels_available: "لا توجد فنادق متاحة حالياً",
        no_hotels_desc: "ستظهر سجلات الفنادق المضافة هنا.",

        // Rooms Module
        hotel_rooms: "غرف الفنادق",
        rooms_subtitle: "إدارة مخزون الغرف، أسعار الليالي، والتوافر والأسرة.",
        add_new_room: "إضافة غرفة جديدة",
        search_room_placeholder: "ابحث عن الغرفة برقمها أو نوعها...",
        all_hotels: "جميع الفنادق",
        all_statuses: "جميع الحالات",
        total_rooms: "إجمالي الغرف:",
        room_id: "المعرف",
        room_number: "رقم الغرفة",
        room_type: "نوع الغرفة",
        hotel: "الفندق",
        night_rate: "سعر الليلة",
        capacity: "السعة (الأفراد)",
        availability: "التوفر",
        edit_room: "تعديل الغرفة",
        save_room: "حفظ الغرفة",
        update_room: "تحديث الغرفة",
        no_rooms_available: "لا توجد غرف متاحة حالياً",
        no_rooms_desc: "ستظهر سجلات الغرف المضافة هنا.",

        // Room Categories Module
        room_categories: "أنواع وفئات الغرف",
        room_categories_subtitle: "تهيئة الفئات المعيارية للغرف، الوصف، والأسعار الأساسية.",
        add_new_category: "إضافة فئة جديدة",
        search_category_placeholder: "ابحث عن فئة الغرفة...",
        type_name: "اسم الفئة",
        description: "الوصف",
        base_price: "السعر الأساسي ($)",
        number_of_rooms: "عدد الغرف",
        edit_category: "تعديل الفئة",
        save_category: "حفظ الفئة",
        update_category: "تحديث الفئة",
        no_categories_available: "لا توجد فئات غرف متاحة",
        no_categories_desc: "ستظهر فئات الغرف هنا عند استرجاعها من قاعدة البيانات.",

        // Amenities Module
        amenities_title: "المرافق والخدمات",
        amenities_subtitle: "إدارة المرافق العامة، أيقونات الخدمات، والمميزات المقدمة.",
        add_new_amenity: "إضافة مرفق جديد",
        search_amenity_placeholder: "ابحث عن المرفق باسمه...",
        amenity_name: "اسم المرفق",
        icon: "الأيقونة",
        usage_count: "عدد الاستخدامات",
        category: "الفئة",
        edit_amenity: "تعديل المرفق",
        save_amenity: "حفظ المرفق",
        update_amenity: "تحديث المرفق",
        no_amenities_available: "لا توجد مرافق متاحة",
        no_amenities_desc: "ستظهر سجلات المرافق هنا عند استرجاعها من قاعدة البيانات.",

        // Bookings Module
        bookings_reservations: "الحجوزات والحجوزات الفندقية",
        bookings_subtitle: "متابعة نشاط الحجوزات، إجراءات تسجيل الدخول، والموافقات.",
        search_booking_placeholder: "ابحث برقم الحجز أو اسم النزيل...",
        booking_id: "رقم الحجز",
        guest_name: "اسم النزيل",
        guest: "النزيل",
        guest_info: "بيانات النزيل",
        hotel_room: "الفندق / الغرفة",
        check_in: "تاريخ الوصول",
        check_out: "تاريخ المغادرة",
        dates: "التواريخ",
        total_price: "السعر الإجمالي",
        total: "الإجمالي",
        status: "الحالة",
        accept: "قبول",
        approve: "موافقة",
        reject: "رفض",
        check_in_btn: "تسجيل دخول",
        check_out_btn: "تسجيل خروج",
        no_bookings_available: "لا توجد حجوزات متاحة حالياً",
        no_bookings_desc: "ستظهر حجوزات النزلاء هنا فور إتمامها.",

        // Reports Module
        financial_booking_reports: "التقارير المالية والحجوزات",
        reports_subtitle: "إحصائيات الأداء، مؤشرات الإشغال، ومؤشرات الإيرادات.",
        print_save_report: "طباعة / حفظ التقرير",
        top_booked_hotels: "أفضل الفنادق حجزاً",
        top_booked_room_types: "أفضل أنواع الغرف حجزاً",
        no_reports_data: "لا توجد بيانات متاحة للتقارير حالياً.",

        // Footer & Common Modals
        footer_copyright: "جميع الحقوق محفوظة - لوحة تحكم إدارية",
        privacy_policy: "سياسة الخصوصية",
        terms: "الشروط والأحكام",
        system_support: "الدعم الفني للنظام",
        confirm_delete_title: "تأكيد الحذف",
        confirm_delete_text: "هل أنت تأكد من رغبتك في حذف هذا العنصر؟ لا يمكنك التراجع عن هذا الإجراء.",
        yes_delete: "نعم، احذف",

        // Status Translation Keys
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
        // Navigation & General
        grandstay: "GrandStay",
        overview: "Overview",
        management: "Management",
        operations: "Operations",
        dashboard: "Dashboard",
        dashboard_overview: "Dashboard Overview",
        cities: "Cities",
        cities_management: "Cities Management",
        hotels: "Hotels",
        hotels_management: "Hotels Management",
        rooms: "Rooms",
        rooms_management: "Rooms Management",
        room_types: "Room Types",
        room_types_management: "Room Types Management",
        amenities: "Amenities",
        amenities_management: "Amenities Management",
        bookings: "Bookings",
        bookings_management: "Bookings Management",
        reports: "Reports & Analytics",
        reports_analytics: "Reports & Analytics",
        admin: "Admin",
        administrator: "Administrator",
        logout: "Logout",
        notifications: "Notifications",
        unread: "Unread",
        no_notifications: "No new notifications.",

        // Headers & Actions
        welcome_back: "Welcome back",
        dashboard_subtitle: "Here is what is happening with your hotels & bookings today.",
        refresh: "Refresh",
        manage_bookings: "Manage Bookings",
        filter: "Filter",
        reset: "Reset",
        search: "Search...",
        search_button: "Search",
        cancel: "Cancel",
        save: "Save",
        update: "Update",
        delete: "Delete",
        edit: "Edit",
        actions: "Actions",
        details: "Details",

        // KPI Cards & Trends
        total_bookings: "Total Bookings",
        total_revenue: "Total Revenue",
        total_users: "Total Users",
        available_places: "Available Places",
        monthly_revenue: "Monthly Revenue",
        avg_booking_value: "Avg Booking Value",
        vs_last_month: "vs last month",
        all_time: "All Time",
        confirmed: "Confirmed",
        per_reservation: "Per Reservation",
        current_month: "Current Month",
        live: "Live",

        // Dashboard Charts & Lists
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
        no_recent_reservations: "No recent reservations available",
        no_recent_reservations_desc: "New booking records will appear here once created.",

        // Cities Module
        cities_destinations: "Cities & Destinations",
        cities_subtitle: "Manage destination cities where hotel properties and accommodations are located.",
        add_new_city: "Add New City",
        search_city_placeholder: "Search city by name...",
        total_cities: "Total Cities:",
        city_id: "ID",
        city_name: "City Name",
        hotels_count: "Hotels Count",
        created_at: "Created At",
        edit_city: "Edit City",
        save_city: "Save City",
        update_city: "Update City",
        no_cities_available: "No cities available",
        no_cities_desc: "Added city records will appear here.",

        // Hotels Module
        hotels_properties: "Hotels & Properties",
        hotels_subtitle: "Manage registered hotel properties, resort listings, and addresses.",
        add_new_hotel: "Add New Hotel",
        search_hotel_placeholder: "Search hotel name or address...",
        all_cities: "All Cities",
        total_hotels: "Total Hotels:",
        hotel_id: "ID",
        hotel_name: "Hotel Name",
        city: "City",
        address: "Address",
        rating: "Rating",
        rooms_count: "Rooms",
        edit_hotel: "Edit Hotel",
        save_hotel: "Save Hotel",
        update_hotel: "Update Hotel",
        unassigned: "Unassigned",
        no_hotels_available: "No hotels available",
        no_hotels_desc: "Added hotel records will appear here.",

        // Rooms Module
        hotel_rooms: "Hotel Rooms",
        rooms_subtitle: "Manage room inventory, night rates, capacity, and availability.",
        add_new_room: "Add New Room",
        search_room_placeholder: "Search room number or type...",
        all_hotels: "All Hotels",
        all_statuses: "All Statuses",
        total_rooms: "Total Rooms:",
        room_id: "ID",
        room_number: "Room Number",
        room_type: "Room Type",
        hotel: "Hotel",
        night_rate: "Night Rate",
        capacity: "Capacity",
        availability: "Availability",
        edit_room: "Edit Room",
        save_room: "Save Room",
        update_room: "Update Room",
        no_rooms_available: "No rooms available",
        no_rooms_desc: "Added room records will appear here.",

        // Room Categories Module
        room_categories: "Room Categories",
        room_categories_subtitle: "Configure standard room categories, descriptions, and base rates.",
        add_new_category: "Add Category",
        search_category_placeholder: "Search room type name...",
        type_name: "Type Name",
        description: "Description",
        base_price: "Base Price ($)",
        number_of_rooms: "Number of Rooms",
        edit_category: "Edit Category",
        save_category: "Save Category",
        update_category: "Update Category",
        no_categories_available: "No room categories available",
        no_categories_desc: "Room category records will appear here once retrieved from the database.",

        // Amenities Module
        amenities_title: "Hotel & Room Amenities",
        amenities_subtitle: "Manage global features, facility icons, and services offered across hotel properties.",
        add_new_amenity: "Add Amenity",
        search_amenity_placeholder: "Search amenity name...",
        amenity_name: "Amenity Name",
        icon: "Icon",
        usage_count: "Usage Count",
        category: "Category",
        edit_amenity: "Edit Amenity",
        save_amenity: "Save Amenity",
        update_amenity: "Update Amenity",
        no_amenities_available: "No amenities available",
        no_amenities_desc: "Amenity records will appear here once retrieved from the database.",

        // Bookings Module
        bookings_reservations: "Bookings & Reservations",
        bookings_subtitle: "Monitor reservation activity, process guest check-ins, and manage status approvals.",
        search_booking_placeholder: "Search Guest or Booking ID...",
        booking_id: "Booking ID",
        guest_name: "Guest Name",
        guest: "Guest",
        guest_info: "Guest Info",
        hotel_room: "Hotel / Room",
        check_in: "Check-In",
        check_out: "Check-Out",
        dates: "Dates",
        total_price: "Total Price",
        total: "Total",
        status: "Status",
        accept: "Accept",
        approve: "Approve",
        reject: "Reject",
        check_in_btn: "Check In",
        check_out_btn: "Check Out",
        no_bookings_available: "No bookings available",
        no_bookings_desc: "Guest booking records will appear here once created.",

        // Reports Module
        financial_booking_reports: "Financial & Booking Reports",
        reports_subtitle: "Performance intelligence, occupancy metrics, and gross revenue reports.",
        print_save_report: "Print / Save Report",
        top_booked_hotels: "Top Booked Hotels",
        top_booked_room_types: "Top Booked Room Types",
        no_reports_data: "No report data available.",

        // Footer & Common Modals
        footer_copyright: "All Rights Reserved - Editorial Booking Dashboard",
        privacy_policy: "Privacy Policy",
        terms: "Terms",
        system_support: "System Support",
        confirm_delete_title: "Confirm Delete",
        confirm_delete_text: "Are you sure you want to delete this item? This action cannot be undone.",
        yes_delete: "Yes, Delete",

        // Status Translation Keys
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
            showToast(
                localStorage.getItem('admin_lang') === 'ar' ? 'المظهر' : 'Theme Updated',
                localStorage.getItem('admin_lang') === 'ar' 
                    ? `تم التغيير إلى المظهر ${activeTheme === 'dark' ? 'الداكن' : 'الفاتح'}`
                    : `Switched to ${activeTheme} mode`,
                'info'
            );
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

    // 1. Translate all elements with data-i18n
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.getAttribute('data-i18n');
        if (dict[key]) {
            el.textContent = dict[key];
        }
    });

    // 2. Translate elements with data-i18n-title
    document.querySelectorAll('[data-i18n-title]').forEach(el => {
        const key = el.getAttribute('data-i18n-title');
        if (dict[key]) {
            el.textContent = dict[key];
        }
    });

    // 3. Translate elements with data-i18n-status
    document.querySelectorAll('[data-i18n-status]').forEach(el => {
        const rawStatus = el.getAttribute('data-i18n-status');
        const statusKey = 'status_' + rawStatus.toLowerCase().replace('-', '_').replace(' ', '_');
        if (dict[statusKey]) {
            el.textContent = dict[statusKey];
        }
    });

    // 4. Translate elements with data-i18n-placeholder
    document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
        const key = el.getAttribute('data-i18n-placeholder');
        if (dict[key]) {
            el.setAttribute('placeholder', dict[key]);
        }
    });

    // 5. Fallback search inputs placeholder translation
    document.querySelectorAll('input[placeholder]').forEach(el => {
        const ph = el.getAttribute('placeholder');
        if (ph && ph.toLowerCase().includes('search')) {
            el.setAttribute('placeholder', dict['search'] || 'Search...');
        }
    });

    if (showNotification) {
        showToast(
            lang === 'ar' ? 'تم تغيير اللغة' : 'Language Changed',
            lang === 'ar' ? 'تم التحويل إلى اللغة العربية' : 'Switched to English',
            'success'
        );
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

