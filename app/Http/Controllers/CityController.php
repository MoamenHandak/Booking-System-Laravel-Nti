<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    // عرض كل المدن
    public function index(Request $request)
    {
        $query = City::withCount('hotels');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $cities = $query->latest()->paginate(10)->withQueryString();
        return view('admin.cities.index', compact('cities'));
    }

    // عرض فورم إضافة مدينة جديدة
    public function create()
    {
        return view('admin.cities.create');
    }

    // حفظ المدينة الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
        ]);

        City::create($request->only('name'));

        return redirect()->route('admin.cities.index')->with('success', 'تم إضافة المدينة بنجاح');
    }

    // عرض فورم تعديل مدينة
    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));
    }

    // تحديث المدينة
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,' . $city->id,
        ]);

        $city->update($request->only('name'));

        return redirect()->route('admin.cities.index')->with('success', 'تم تعديل المدينة بنجاح');
    }

    // حذف المدينة (Soft Delete)
    public function destroy(City $city)
    {
        $city->delete();

        return redirect()->route('admin.cities.index')->with('success', 'تم حذف المدينة بنجاح');
    }
}
