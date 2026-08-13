@extends('layouts.user')

@section('title', 'العروض والخصومات')

@section('content')
<div class="container my-5">

    <div class="text-center mb-5">

        <i
            class="fa-solid fa-tags fs-1 mb-3"
            style="color: var(--primary-rose);">
        </i>

        <h2 class="fw-bold" data-i18n="offers_title">
            العروض والخصومات
        </h2>

        <p class="text-muted" data-i18n="offers_subtitle">
            أفضل العروض الحصرية على أفخم الفنادق والمنتجعات
        </p>

    </div>


    <div class="row g-4">

        <!-- Offer 1 -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">

                <i
                    class="fa-solid fa-percent fs-2 mb-3"
                    style="color: var(--primary-rose);">
                </i>

                <h5
                    class="fw-bold"
                    data-i18n="early_booking_offer">
                    خصم 20% على الحجز المبكر
                </h5>

                <p
                    class="text-muted small"
                    data-i18n="early_booking_description">
                    احجز قبل 30 يوم من موعد إقامتك واحصل على خصم فوري.
                </p>

            </div>

        </div>


        <!-- Offer 2 -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">

                <i
                    class="fa-solid fa-calendar-week fs-2 mb-3"
                    style="color: var(--primary-rose);">
                </i>

                <h5
                    class="fw-bold"
                    data-i18n="weekend_offer">
                    عروض نهاية الأسبوع
                </h5>

                <p
                    class="text-muted small"
                    data-i18n="weekend_description">
                    استمتع بإقامة مميزة بأسعار خاصة كل نهاية أسبوع.
                </p>

            </div>

        </div>


        <!-- Offer 3 -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">

                <i
                    class="fa-solid fa-users fs-2 mb-3"
                    style="color: var(--primary-rose);">
                </i>

                <h5
                    class="fw-bold"
                    data-i18n="family_offer">
                    عروض العائلات
                </h5>

                <p
                    class="text-muted small"
                    data-i18n="family_description">
                    باقات مخصصة للعائلات مع إقامة مجانية للأطفال.
                </p>

            </div>

        </div>

    </div>


    <!-- Browse Hotels Button -->
    <div class="text-center mt-5">

        <a
            href="{{ route('hotels.index') }}"
            class="btn btn-rose rounded-3 px-5 py-3 fw-bold"
            style="font-size: 1.05rem; box-shadow: 0 4px 15px rgba(200, 138, 117, 0.35); border: 2px solid var(--primary-rose); transition: all 0.3s ease;"
            onmouseover="this.style.boxShadow='0 8px 25px rgba(200, 138, 117, 0.55)'; this.style.transform='translateY(-3px) scale(1.03)';"
            onmouseout="this.style.boxShadow='0 4px 15px rgba(200, 138, 117, 0.35)'; this.style.transform='translateY(0) scale(1)';">

            <i class="fa-solid fa-arrow-left me-2"></i>

            <span data-i18n="browse_hotels_now">
                تصفح الفنادق الآن
            </span>

        </a>

    </div>

</div>
@endsection