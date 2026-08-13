<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;

class ReportController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();

        // إجمالي الإيرادات (من الحجوزات المؤكدة/المكتملة بس)
        $totalRevenue = Booking::whereIn('status', ['approved', 'checked_in', 'checked_out'])
            ->sum('total_price');

        $avgBookingValue = Booking::whereIn('status', ['approved', 'checked_in', 'checked_out'])->avg('total_price') ?? 0;

        // إيرادات الشهر الحالي
        $monthlyRevenue = Booking::whereIn('status', ['approved', 'checked_in', 'checked_out'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        // أكتر 5 فنادق حجزًا
        $topHotels = Hotel::withCount(['rooms as bookings_count' => function ($query) {
                $query->join('bookings', 'bookings.room_id', '=', 'rooms.id');
            }])
            ->orderByDesc('bookings_count')
            ->take(5)
            ->get();

        // أكتر 5 غرف حجزًا
        $topRooms = Room::withCount('bookings')
            ->with('hotel')
            ->orderByDesc('bookings_count')
            ->take(5)
            ->get();

        // توزيع الحجوزات حسب الحالة
        $bookingsByStatus = Booking::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $cities = \App\Models\City::all();
        $hotels = Hotel::all();

        return view('admin.reports.index', compact(
            'totalBookings',
            'totalRevenue',
            'avgBookingValue',
            'monthlyRevenue',
            'topHotels',
            'topRooms',
            'bookingsByStatus',
            'cities',
            'hotels'
        ));
    }
}