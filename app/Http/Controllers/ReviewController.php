<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request)
    {
        // نتأكد إن المستخدم فعلاً حجز في الفندق ده قبل ما يقيمه
        $hasStayed = Booking::where('user_id', Auth::id())
            ->whereHas('room', function ($q) use ($request) {
                $q->where('hotel_id', $request->hotel_id);
            })
            ->whereIn('status', ['checked_out'])
            ->exists();

        if (! $hasStayed) {
            return back()->with('error', 'You can only review hotels you have actually stayed at.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'hotel_id' => $request->hotel_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $this->updateHotelRating($request->hotel_id);

        return back()->with('success', 'Thank you for your review!');
    }

    // تحديث متوسط تقييم الفندق تلقائيًا بعد كل تقييم جديد
    private function updateHotelRating($hotelId)
    {
        $hotel = \App\Models\Hotel::findOrFail($hotelId);
        $average = $hotel->reviews()->avg('rating');
        $hotel->update(['rating' => round($average, 1)]);
    }
}