<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\City;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // =========================
    // Public Hotels
    // =========================

    // عرض الفنادق للمستخدم
    public function publicIndex(Request $request)
    {
        $query = Hotel::with(['city', 'rooms']);

        // صور الفنادق التلقائية
        $hotelImages = [
            'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=700&q=80',
            'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=700&q=80',
            'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=700&q=80',
            'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=700&q=80',
            'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=700&q=80',
            'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=700&q=80',
        ];

        // البحث باسم الفندق أو المدينة
        if ($request->filled('query')) {
            $search = $request->query('query');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhereHas('city', function ($cityQuery) use ($search) {
                        $cityQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $hotels = $query
            ->latest()
            ->paginate(6)
            ->withQueryString();

        // إعطاء كل فندق صورة تلقائية ثابتة حسب ID الفندق
        $hotels->getCollection()->transform(function ($hotel) use ($hotelImages) {

            $hotel->random_image =
                $hotelImages[($hotel->id - 1) % count($hotelImages)];

            return $hotel;
        });

        return view('hotels.index', compact('hotels'));
    }

    // =========================
    // Public Hotel Details
    // =========================

    // تفاصيل الفندق للمستخدم
    public function publicShow(Hotel $hotel)
    {
        $hotel->load([
            'city',
            'rooms' => function ($query) {
                $query->where('is_available', true);
            }
        ]);

        // صور الفنادق
        $hotelImages = [
            'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1200&q=80',
        ];

        // اختيار صور مختلفة حسب رقم الفندق
        $index = ($hotel->id - 1) % count($hotelImages);

        $mainImage = $hotelImages[$index];

        $secondImage = $hotelImages[($index + 1) % count($hotelImages)];

        $thirdImage = $hotelImages[($index + 2) % count($hotelImages)];

        return view('hotels.show', compact(
            'hotel',
            'mainImage',
            'secondImage',
            'thirdImage'
        ));
    }

    // =========================
    // Admin Hotels
    // =========================

    public function index(Request $request)
    {
        $query = Hotel::with('city')->withCount('rooms');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $hotels = $query->latest()->paginate(10)->withQueryString();
        $cities = City::all();

        return view('admin.hotels.index', compact('hotels', 'cities'));
    }

    public function create()
    {
        $cities = City::all();

        return view('admin.hotels.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        Hotel::create(
            $request->only(
                'city_id',
                'name',
                'description',
                'address',
                'rating'
            )
        );

        return redirect()
            ->route('admin.hotels.index')
            ->with('success', 'تم إضافة الفندق بنجاح');
    }

    public function edit(Hotel $hotel)
    {
        $cities = City::all();

        return view('admin.hotels.edit', compact('hotel', 'cities'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $hotel->update(
            $request->only(
                'city_id',
                'name',
                'description',
                'address',
                'rating'
            )
        );

        return redirect()
            ->route('admin.hotels.index')
            ->with('success', 'تم تعديل الفندق بنجاح');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()
            ->route('admin.hotels.index')
            ->with('success', 'تم حذف الفندق بنجاح');
    }
}