@extends('layouts.user')

@section('title', 'تفاصيل الفندق - ' . $hotel->name)

@push('styles')
<style>
    .hotel-gallery-main {
        height: 410px;
        object-fit: cover;
        width: 100%;
        border-radius: 20px;
        transition: transform 0.3s ease;
    }

    .hotel-gallery-side {
        height: 195px;
        object-fit: cover;
        width: 100%;
        border-radius: 20px;
    }

    .hotel-gallery-main:hover,
    .hotel-gallery-side:hover {
        transform: scale(1.02);
    }

    .detail-card {
        border: 0;
        border-radius: 20px;
    }

    .amenity-item {
        padding: 10px;
        border-radius: 12px;
        background: #f8f9fa;
    }

    .booking-box {
        top: 20px;
    }
</style>
@endpush

@section('content')

<div class="container my-5">

    {{-- Hotel Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                {{ $hotel->name }}
            </h2>

            <p class="text-muted mb-0">
                <i class="fa-solid fa-location-dot text-danger me-1"></i>

                {{ $hotel->city->name ?? 'غير محدد' }}

                @if($hotel->address)
                    ، {{ $hotel->address }}
                @endif
            </p>
        </div>

        <div class="mt-3 mt-md-0 text-md-end">

            @if($hotel->rooms->count() > 0)

                @php
                    $minPrice = $hotel->rooms->min('price');
                @endphp

                <span class="fs-3 fw-bold text-primary">
                    {{ number_format($minPrice, 2) }}$
                </span>

                <span
                    class="text-muted"
                    data-i18n="per_night">
                    / ليلة
                </span>

            @endif

            <div class="text-warning mt-1">
                <i class="fa-solid fa-star"></i>

                {{ number_format($hotel->rating ?? 0, 1) }}
            </div>

        </div>

    </div>

    {{-- Image Gallery --}}
    @php

        $hotelImages = [

            [
                'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=85',
                'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=700&q=85',
                'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=700&q=85',
            ],

            [
                'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=1000&q=85',
                'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=700&q=85',
                'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=700&q=85',
            ],

            [
                'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&w=1000&q=85',
                'https://images.unsplash.com/photo-1601918774946-25832a4be0d6?auto=format&fit=crop&w=700&q=85',
                'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=700&q=85',
            ],

            [
                'https://images.unsplash.com/photo-1549294413-26f195200c16?auto=format&fit=crop&w=1000&q=85',
                'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=700&q=85',
                'https://images.unsplash.com/photo-1584132967334-10e028bd69f7?auto=format&fit=crop&w=700&q=85',
            ],

            [
                'https://images.unsplash.com/photo-1563911302283-d2bc129e7570?auto=format&fit=crop&w=1000&q=85',
                'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?auto=format&fit=crop&w=700&q=85',
                'https://images.unsplash.com/photo-1562790351-d273a961e0e9?auto=format&fit=crop&w=700&q=85',
            ],

            [
                'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1000&q=85',
                'https://images.unsplash.com/photo-1540518614846-7eded433c457?auto=format&fit=crop&w=700&q=85',
                'https://images.unsplash.com/photo-1560185127-6ed189bf02f4?auto=format&fit=crop&w=700&q=85',
            ],

        ];

        $images = $hotelImages[($hotel->id - 1) % count($hotelImages)];

    @endphp

    <div class="row g-3 mb-5">

        <div class="col-md-8">
            <img
                src="{{ $images[0] }}"
                class="hotel-gallery-main shadow-sm"
                alt="{{ $hotel->name }}"
            >
        </div>

        <div class="col-md-4 d-flex flex-column gap-3">

            <img
                src="{{ $images[1] }}"
                class="hotel-gallery-side shadow-sm"
                alt="{{ $hotel->name }}"
            >

            <img
                src="{{ $images[2] }}"
                class="hotel-gallery-side shadow-sm"
                alt="{{ $hotel->name }}"
            >

        </div>

    </div>

    {{-- Details --}}
    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card detail-card shadow-sm p-4 mb-4">

                <h4 class="fw-bold mb-3" data-i18n="about_hotel">
                    عن الفندق
                </h4>

                <p class="text-muted lh-lg">
                    {{ $hotel->description ?? 'استمتع بإقامة مميزة ومريحة في هذا الفندق، مع خدمات متكاملة وموقع رائع يوفر لك تجربة إقامة لا تُنسى.' }}
                </p>

                <h5 class="fw-bold mt-4 mb-3" data-i18n="amenities">
                    الخدمات والمرافق
                </h5>

                <div class="row g-3">

                    <div class="col-6 col-md-4">
                        <div class="amenity-item">
                            <i class="fa-solid fa-wifi text-primary me-2"></i>
                            <span data-i18n="free_wifi">
                                إنترنت سريع مجاني
                            </span>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="amenity-item">
                            <i class="fa-solid fa-water-ladder text-primary me-2"></i>
                            <span data-i18n="swimming_pool">
                                حمام سباحة
                            </span>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="amenity-item">
                            <i class="fa-solid fa-square-parking text-primary me-2"></i>
                            <span data-i18n="parking">
                                موقف سيارات
                            </span>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="amenity-item">
                            <i class="fa-solid fa-utensils text-primary me-2"></i>
                            <span data-i18n="restaurant">
                                مطعم فاخر
                            </span>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="amenity-item">
                            <i class="fa-solid fa-dumbbell text-primary me-2"></i>
                            <span data-i18n="gym">
                                صالة ألعاب رياضية
                            </span>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="amenity-item">
                            <i class="fa-solid fa-ban-smoking text-primary me-2"></i>
                            <span data-i18n="non_smoking_rooms">
                                غرف لغير التدخين
                            </span>
                        </div>
                    </div>

                </div>

            </div>

            {{-- Available Rooms --}}
            <div class="card detail-card shadow-sm p-4">

                <h4 class="fw-bold mb-4" data-i18n="available_rooms">
                    الغرف المتاحة
                </h4>

                @forelse($hotel->rooms as $room)

                    <div class="border rounded-4 p-3 mb-3">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h6 class="fw-bold mb-1">
                                    {{ $room->name ?? 'غرفة فندقية' }}
                                </h6>

                                <small class="text-muted">
                                    <i class="fa-solid fa-bed me-1"></i>

                                    <span data-i18n="available_room">
                                        غرفة متاحة
                                    </span>
                                </small>

                            </div>

                            <div class="text-end">

                                <div class="fw-bold text-primary">
                                    {{ number_format($room->price, 2) }}$
                                </div>

                                <small class="text-muted" data-i18n="per_night">
                                    / ليلة
                                </small>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center text-muted py-4">

                        <i class="fa-solid fa-bed fs-2 mb-2"></i>

                        <p class="mb-0" data-i18n="no_available_rooms">
                            لا توجد غرف متاحة حالياً.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

        {{-- Booking Box --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top booking-box">

                <h5 class="fw-bold mb-3" data-i18n="book_room">
                    حجز الغرفة
                </h5>

                <form id="detailsBookingForm">

                    <div class="mb-3">

                        <label
                            class="form-label small fw-bold"
                            data-i18n="check_in">
                            تاريخ الوصول
                        </label>

                        <input
                            type="date"
                            name="check_in_date"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label
                            class="form-label small fw-bold"
                            data-i18n="check_out">
                            تاريخ المغادرة
                        </label>

                        <input
                            type="date"
                            name="check_out_date"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label
                            class="form-label small fw-bold"
                            data-i18n="room_type">
                            نوع الغرفة
                        </label>

                        <select
                            name="room_id"
                            class="form-select"
                            required
                        >

                            @forelse($hotel->rooms as $room)

                                <option value="{{ $room->id }}">
                                    {{ $room->name ?? 'غرفة فندقية' }}
                                    -
                                    {{ number_format($room->price, 2) }}$
                                </option>

                            @empty

                                <option disabled data-i18n="no_available_rooms">
                                    لا توجد غرف متاحة
                                </option>

                            @endforelse

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary btn-lg w-100 rounded-3 fw-bold mt-2"
                        @if($hotel->rooms->count() === 0) disabled @endif
                    >

                        <i class="fa-solid fa-calendar-check me-1"></i>

                        <span data-i18n="confirm_booking">
                            تأكيد الحجز الآن
                        </span>

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

    document
        .getElementById('detailsBookingForm')
        .addEventListener('submit', function(e) {

            e.preventDefault();

            const formData = new FormData(this);

            fetch('{{ route("bookings.store") }}', {

                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },

                body: formData

            })

            .then(response => {

                if (response.status === 401) {

                    const isArabic =
                        document.documentElement.lang === 'ar';

                    Swal.fire({

                        title: isArabic
                            ? 'محتاج تسجل دخول'
                            : 'Login Required',

                        text: isArabic
                            ? 'لازم تسجل دخول الأول عشان تقدر تحجز.'
                            : 'You need to login first to make a booking.',

                        icon: 'warning',

                        confirmButtonText: isArabic
                            ? 'تسجيل الدخول'
                            : 'Login'

                    }).then(() => {

                        window.location.href = '{{ url("/login") }}';

                    });

                    return null;
                }

                return response.json();

            })

            .then(data => {

                if (!data) return;

                const isArabic =
                    document.documentElement.lang === 'ar';

                if (data.success !== false) {

                    Swal.fire({

                        title: isArabic
                            ? 'تم استلام طلب الحجز!'
                            : 'Booking Request Received!',

                        text: isArabic
                            ? 'شكراً لك، تم إرسال تفاصيل حجزك بنجاح.'
                            : 'Thank you, your booking details have been submitted successfully.',

                        icon: 'success',

                        confirmButtonColor: '#0d6efd',

                        confirmButtonText: isArabic
                            ? 'موافق'
                            : 'OK'

                    });

                    document
                        .getElementById('detailsBookingForm')
                        .reset();

                } else {

                    Swal.fire({

                        title: isArabic
                            ? 'حصل خطأ'
                            : 'Something Went Wrong',

                        text: data.message ||
                            (
                                isArabic
                                    ? 'مقدرناش نكمل الحجز.'
                                    : 'We could not complete the booking.'
                            ),

                        icon: 'error'

                    });

                }

            })

            .catch(() => {

                const isArabic =
                    document.documentElement.lang === 'ar';

                Swal.fire({

                    title: isArabic
                        ? 'حصل خطأ'
                        : 'Something Went Wrong',

                    text: isArabic
                        ? 'حصلت مشكلة، حاول تاني.'
                        : 'Something went wrong, please try again.',

                    icon: 'error'

                });

            });

        });

</script>

@endpush