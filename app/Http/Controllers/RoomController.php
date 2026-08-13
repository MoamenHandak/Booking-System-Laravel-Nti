<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::with('hotel');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('type', 'like', "%{$search}%")
                  ->orWhereHas('hotel', function ($hq) use ($search) {
                      $hq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('hotel_id')) {
            $query->where('hotel_id', $request->hotel_id);
        }

        if ($request->filled('is_available')) {
            $query->where('is_available', $request->is_available);
        }

        $rooms = $query->latest()->paginate(10)->withQueryString();
        $hotels = Hotel::all();

        return view('admin.rooms.index', compact('rooms', 'hotels'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        return view('admin.rooms.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id'     => 'required|exists:hotels,id',
            'type'         => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'capacity'     => 'required|integer|min:1',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_available' => 'nullable|boolean',
        ]);

        $data = $request->only('hotel_id', 'type', 'price', 'capacity', 'description');
        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($data);

        return redirect()->route('admin.rooms.index')->with('success', 'تم إضافة الغرفة بنجاح');
    }

    public function edit(Room $room)
    {
        $hotels = Hotel::all();
        return view('admin.rooms.edit', compact('room', 'hotels'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'hotel_id'     => 'required|exists:hotels,id',
            'type'         => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'capacity'     => 'required|integer|min:1',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_available' => 'nullable|boolean',
        ]);

        $data = $request->only('hotel_id', 'type', 'price', 'capacity', 'description');
        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            // احذف الصورة القديمة لو موجودة
            if ($room->image) {
                \Storage::disk('public')->delete($room->image);
            }
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        $room->update($data);

        return redirect()->route('admin.rooms.index')->with('success', 'تم تعديل الغرفة بنجاح');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('admin.rooms.index')->with('success', 'تم حذف الغرفة بنجاح');
    }
}
