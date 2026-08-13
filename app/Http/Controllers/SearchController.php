<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Room::with(['hotel.city']);

        // فلترة بالمدينة
        if ($request->filled('city')) {
            $query->whereHas('hotel.city', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->city . '%');
            });
        }

        // فلترة بالسعر (من - إلى)
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // فلترة بالتقييم (تقييم الفندق)
        if ($request->filled('rating')) {
            $query->whereHas('hotel', function ($q) use ($request) {
                $q->where('rating', '>=', $request->rating);
            });
        }

        // بحث بالاسم (اسم الفندق)
        if ($request->filled('keyword')) {
            $query->whereHas('hotel', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        $rooms = $query->paginate(10)->withQueryString();

        return view('search.results', compact('rooms'));
    }
}