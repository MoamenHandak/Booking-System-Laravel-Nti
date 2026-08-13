@extends('layouts.user')

@section('title', 'استكشف أفخم الفنادق والمنتجعات')

@push('styles')
<style>
    :root {
        --bg-main: #FDF8F5;
        --card-bg: #FFFFFF;
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
        --text-color: #F3ECE8;
        --text-muted: #BDB0AA;
        --primary-rose: #D8A798;
        --primary-rose-hover: #E3B8AA;
        --accent-brown: #E8C3B9;
        --border-color: #38302E;
        --shadow-color: rgba(0, 0, 0, 0.4);
    }

    body {
        background-color: var(--bg-main);
        color: var(--text-color);
        transition: background-color 0.4s ease, color 0.4s ease;
    }

    .theme-toggle-btn {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        color: var(--text-color);
        border-radius: 50px;
        padding: 8px 18px;
        font-weight: bold;
        box-shadow: 0 4px 12px var(--shadow-color);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .theme-toggle-btn:hover {
        transform: translateY(-2px);
    }

    .hero-rose {
        background: linear-gradient(
            135deg,
            var(--accent-brown) 0%,
            var(--primary-rose) 100%
        );
        border-radius: 24px;
        box-shadow: 0 15px 35px var(--shadow-color);
    }

    .search-card {
        background-color: var(--card-bg) !important;
        border: 1px solid var(--border-color);
    }

    .hotel-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        overflow: hidden;
        transition:
            transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1),
            box-shadow 0.4s ease,
            border-color 0.4s ease;
    }

    .hotel-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 18px 30px var(--shadow-color) !important;
        border-color: var(--primary-rose);
    }

    .hotel-img-wrapper {
        position: relative;
        height: 230px;
        overflow: hidden;
    }

    .hotel-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .hotel-card:hover .hotel-img-wrapper img {
        transform: scale(1.1);
    }

    .hotel-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(
            135deg,
            var(--accent-brown),
            var(--primary-rose)
        );
        color: white;
        font-size: 50px;
    }

    .badge-price {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(111, 78, 55, 0.85);
        backdrop-filter: blur(8px);
        color: #FFF;
    }

    .btn-rose {
        background-color: var(--primary-rose);
        color: #FFF !important;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-rose:hover {
        background-color: var(--primary-rose-hover);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(200, 138, 117, 0.4);
    }

    .btn-outline-rose {
        border: 1px solid var(--primary-rose);
        color: var(--primary-rose) !important;
        background: transparent;
        transition: all 0.3s ease;
    }

    .btn-outline-rose:hover {
        background-color: var(--primary-rose);
        color: #FFF !important;
    }

    .badge-tag {
        background-color: var(--bg-main);
        color: var(--text-muted);
        border: 1px solid var(--border-color);
    }

    .hotel-description {
        color: var(--text-muted);
        min-height: 45px;
    }

    .custom-pagination .page-link {
        background-color: var(--card-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .custom-pagination .page-item.active .page-link {
        background-color: var(--primary-rose);
        border-color: var(--primary-rose);
        color: #fff;
    }

    .custom-pagination .page-link:hover {
        background-color: var(--primary-rose);
        border-color: var(--primary-rose);
        color: #fff;
    }
</style>
@endpush

@section('content')

<div class="container my-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-0" data-i18n="hotels_hero_title">
                الملاذ المثالي لراحتك
            </h3>

            <p class="text-muted small mb-0" data-i18n="hotels_hero_subtitle">
                اختر من بين تشكيلة فاخرة من الفنادق المصممة خصيصاً لأجلك
            </p>
        </div>

        {{-- Dark / Light Mode --}}
        <button
            id="themeToggleBtn"
            class="theme-toggle-btn d-flex align-items-center gap-2"
            type="button"
        >
            <i class="fa-solid fa-moon text-warning" id="themeIcon"></i>

            <span id="themeText" data-i18n="theme_dark">
                المظهر الداكن
            </span>
        </button>

    </div>

    {{-- Search --}}
    <div class="hero-rose text-white p-4 p-md-5 mb-5">

        <h2 class="fw-bold mb-2" data-i18n="search_destination">
            ابحث عن وجهتك القادمة
        </h2>

        <p class="text-white-50 mb-4 small" data-i18n="search_description">
            استمتع بتجربة إقامة تجمع بين الفخامة والراحة
        </p>

        <form
            action="{{ route('hotels.index') }}"
            method="GET"
            class="search-card p-3 p-md-4 rounded-4 shadow-sm"
        >

            <div class="row g-3 align-items-end">

                {{-- Search --}}
                <div class="col-md-5">

                    <label class="form-label fw-bold small text-muted">
                        <i
                            class="fa-solid fa-location-dot me-1"
                            style="color: var(--primary-rose);"
                        ></i>

                        <span data-i18n="city_or_hotel">
                            المدينة / اسم الفندق
                        </span>
                    </label>

                    <input
                        type="text"
                        name="query"
                        value="{{ request('query') }}"
                        class="form-control border-0 bg-body-tertiary py-2"
                        placeholder="القاهرة، شرم الشيخ، أسوان..."
                        data-i18n-placeholder="search_placeholder"
                    >

                </div>

                {{-- Check in --}}
                <div class="col-md-3">

                    <label class="form-label fw-bold small text-muted">
                        <i
                            class="fa-solid fa-calendar-days me-1"
                            style="color: var(--primary-rose);"
                        ></i>

                        <span data-i18n="check_in">
                            تاريخ الوصول
                        </span>
                    </label>

                    <input
                        type="date"
                        name="check_in"
                        value="{{ request('check_in') }}"
                        class="form-control border-0 bg-body-tertiary py-2"
                    >

                </div>

                {{-- Guests --}}
                <div class="col-md-2">

                    <label class="form-label fw-bold small text-muted">
                        <i
                            class="fa-solid fa-user-group me-1"
                            style="color: var(--primary-rose);"
                        ></i>

                        <span data-i18n="guests_count">
                            عدد الضيوف
                        </span>
                    </label>

                    <select
                        name="guests"
                        class="form-select border-0 bg-body-tertiary py-2"
                    >

                        <option
                            value="1"
                            {{ request('guests') == 1 ? 'selected' : '' }}
                            data-i18n="one_guest"
                        >
                            شخص واحد
                        </option>

                        <option
                            value="2"
                            {{ request('guests', 2) == 2 ? 'selected' : '' }}
                            data-i18n="two_guests"
                        >
                            شخصين
                        </option>

                        <option
                            value="4"
                            {{ request('guests') == 4 ? 'selected' : '' }}
                            data-i18n="four_guests"
                        >
                            4 أشخاص
                        </option>

                    </select>

                </div>

                {{-- Search Button --}}
                <div class="col-md-2">

                    <button
                        type="submit"
                        class="btn btn-rose w-100 py-2 rounded-3 fw-bold"
                    >
                        <i class="fa-solid fa-magnifying-glass me-1"></i>

                        <span data-i18n="search_button">
                            بحث
                        </span>
                    </button>

                </div>

            </div>

        </form>

    </div>

    {{-- Search Result --}}
    @if(request('query'))

        <div class="alert alert-light border mb-4">

            <i class="fa-solid fa-magnifying-glass me-2"></i>

            <span data-i18n="search_results_for">
                نتائج البحث عن:
            </span>

            <strong>
                {{ request('query') }}
            </strong>

        </div>

    @endif

    {{-- Hotels --}}
    <div class="row g-4 mb-5">

        @forelse($hotels as $hotel)

            <div class="col-md-6 col-lg-4">

                <div class="card hotel-card h-100">

                    {{-- Hotel Image --}}
                    <div class="hotel-img-wrapper">

                        @if(!empty($hotel->random_image))

                            <img
                                src="{{ $hotel->random_image }}"
                                alt="{{ $hotel->name }}"
                                loading="lazy"
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=700&q=80';"
                            >

                        @else

                            <div class="hotel-placeholder">
                                <i class="fa-solid fa-hotel"></i>
                            </div>

                        @endif

                        {{-- Price --}}
                        @if($hotel->rooms->count() > 0)

                            @php
                                $minPrice = $hotel->rooms->min('price');
                            @endphp

                            <span class="badge badge-price px-3 py-2 rounded-pill fw-bold">

                                {{ number_format($minPrice, 2) }} $

                                <span data-i18n="per_night">
                                    / ليلة
                                </span>

                            </span>

                        @endif

                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-4 d-flex flex-column justify-content-between">

                        <div>

                            {{-- Name + Rating --}}
                            <div class="d-flex justify-content-between align-items-start mb-2">

                                <h5 class="fw-bold mb-0">
                                    {{ $hotel->name }}
                                </h5>

                                @if($hotel->rating)

                                    <div class="text-warning small text-nowrap">

                                        <i class="fa-solid fa-star"></i>

                                        {{ number_format($hotel->rating, 1) }}

                                    </div>

                                @endif

                            </div>

                            {{-- City --}}
                            <p class="text-muted small mb-3">

                                <i class="fa-solid fa-location-dot me-1 text-danger"></i>

                                {{ $hotel->city->name ?? 'غير محدد' }}

                                @if($hotel->address)
                                    - {{ $hotel->address }}
                                @endif

                            </p>

                            {{-- Description --}}
                            @if($hotel->description)

                                <p class="hotel-description small mb-3">
                                    {{ Str::limit($hotel->description, 100) }}
                                </p>

                            @endif

                            {{-- Rooms --}}
                            <div class="d-flex flex-wrap gap-2 mb-3">

                                <span class="badge badge-tag px-2 py-1">

                                    <i class="fa-solid fa-bed"></i>

                                    {{ $hotel->rooms->count() }}

                                    <span data-i18n="available_room">
                                        غرفة متاحة
                                    </span>

                                </span>

                                @if($hotel->rating >= 4.5)

                                    <span class="badge badge-tag px-2 py-1">

                                        <i class="fa-solid fa-crown"></i>

                                        <span data-i18n="featured_hotel">
                                            فندق مميز
                                        </span>

                                    </span>

                                @endif

                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="pt-3 border-top border-secondary-subtle">

                            <a
                                href="{{ route('hotels.show', $hotel) }}"
                                class="btn btn-outline-rose rounded-3 w-100 fw-bold"
                            >
                                <i class="fa-solid fa-eye me-1"></i>

                                <span data-i18n="view_details">
                                    عرض التفاصيل
                                </span>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            {{-- No Hotels --}}
            <div class="col-12">

                <div class="text-center py-5">

                    <div class="mb-3">

                        <i
                            class="fa-solid fa-hotel"
                            style="
                                font-size: 60px;
                                color: var(--primary-rose);
                            "
                        ></i>

                    </div>

                    <h4 class="fw-bold" data-i18n="no_hotels">
                        لا توجد فنادق
                    </h4>

                    <p class="text-muted" data-i18n="no_hotels_match">
                        لم يتم العثور على فنادق مطابقة لبحثك.
                    </p>

                    @if(request('query'))

                        <a
                            href="{{ route('hotels.index') }}"
                            class="btn btn-rose rounded-3 px-4"
                            data-i18n="show_all_hotels"
                        >
                            عرض جميع الفنادق
                        </a>

                    @endif

                </div>

            </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    @if($hotels->hasPages())

        <nav aria-label="Page navigation">

            <div class="d-flex justify-content-center custom-pagination">
                {{ $hotels->onEachSide(1)->links() }}
            </div>

        </nav>

    @endif

</div>

@endsection

@push('scripts')

<script>

    const toggleBtn = document.getElementById('themeToggleBtn');
    const themeIcon = document.getElementById('themeIcon');

    const currentTheme =
        localStorage.getItem('theme') || 'light';

    document.documentElement.setAttribute(
        'data-theme',
        currentTheme
    );

    updateToggleUI(currentTheme);

    toggleBtn.addEventListener('click', function () {

        const theme =
            document.documentElement.getAttribute('data-theme');

        const newTheme =
            theme === 'dark' ? 'light' : 'dark';

        document.documentElement.setAttribute(
            'data-theme',
            newTheme
        );

        localStorage.setItem(
            'theme',
            newTheme
        );

        updateToggleUI(newTheme);

    });

    function updateToggleUI(theme) {

        if (theme === 'dark') {

            themeIcon.className =
                'fa-solid fa-sun text-warning';

        } else {

            themeIcon.className =
                'fa-solid fa-moon text-dark';

        }
    }

</script>

@endpush