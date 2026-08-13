@extends('layouts.admin')

@section('title', 'إضافة فندق')

@section('content')
    <h3>إضافة فندق جديد</h3>

    <form action="{{ route('admin.hotels.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label class="form-label">المدينة</label>
            <select name="city_id" class="form-select @error('city_id') is-invalid @enderror">
                <option value="">اختر المدينة</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
            @error('city_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">اسم الفندق</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">العنوان</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">التقييم (0 - 5)</label>
            <input type="number" step="0.1" min="0" max="5" name="rating" class="form-control" value="{{ old('rating', 0) }}">
        </div>

        <button type="submit" class="btn btn-success">حفظ</button>
        <a href="{{ route('admin.hotels.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
@endsection