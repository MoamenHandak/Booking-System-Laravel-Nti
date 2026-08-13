@extends('layouts.user')

@section('title', 'حجوزاتي')

@section('content')
<div class="container my-4">

    <h3 class="fw-bold mb-4" data-i18n="my_bookings_title">
        حجوزاتي
    </h3>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">

            <thead>
                <tr>
                    <th>#</th>

                    <th data-i18n="hotel">
                        الفندق
                    </th>

                    <th data-i18n="room">
                        الغرفة
                    </th>

                    <th data-i18n="check_in">
                        تاريخ الوصول
                    </th>

                    <th data-i18n="check_out">
                        تاريخ المغادرة
                    </th>

                    <th data-i18n="total_price">
                        السعر الإجمالي
                    </th>

                    <th data-i18n="status">
                        الحالة
                    </th>

                    <th data-i18n="actions">
                        إجراءات
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse ($bookings as $booking)

                    <tr>

                        <td>
                            {{ $booking->id }}
                        </td>

                        <td>
                            {{ $booking->room->hotel->name ?? '-' }}
                        </td>

                        <td>
                            {{ $booking->room->type ?? '-' }}
                        </td>

                        <td>
                            {{ $booking->check_in_date }}
                        </td>

                        <td>
                            {{ $booking->check_out_date }}
                        </td>

                        <td>
                            {{ number_format($booking->total_price, 2) }}$
                        </td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $booking->status }}
                            </span>
                        </td>

                        <td>

                            @if (in_array($booking->status, ['pending', 'approved']))

                                <form
                                    action="{{ route('bookings.cancel', $booking->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm(
                                        document.documentElement.lang === 'ar'
                                            ? 'هل أنت متأكد من إلغاء الحجز؟'
                                            : 'Are you sure you want to cancel this booking?'
                                    )"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        data-i18n="cancel">
                                        إلغاء
                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td
                            colspan="8"
                            class="text-center py-4 text-muted"
                            data-i18n="no_bookings">
                            لا توجد حجوزات حتى الآن
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>

    {{ $bookings->links() }}

</div>
@endsection