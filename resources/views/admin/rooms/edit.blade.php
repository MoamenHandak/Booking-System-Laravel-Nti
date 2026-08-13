@extends('layouts.admin')

@section('title', 'تعديل غرفة')

@section('content')
    <h3>تعديل الغرفة</h3>

    <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">الفندق</label>
            <select name="hotel_id" class="form-select @error('hotel_id') is-invalid @enderror">
                @foreach ($hotels as $hotel)
                    <option value="{{ $hotel->id }}" {{ old('hotel_id', $room->hotel_id) == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">نوع الغرفة</label>
            <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $room->type) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">السعر</label>
            <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $room->price) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">السعة (عدد الأشخاص)</label>
            <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity', $room->capacity) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">صورة الغرفة</label>
            @if ($room->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $room->image) }}" width="120">
                </div>
            @endif
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            <small class="text-muted">اتركه فارغًا لو مش عايز تغيّر الصورة</small>
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $room->description) }}</textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_available" class="form-check-input" id="is_available"
                   {{ old('is_available', $room->is_available) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_available">الغرفة متاحة</label>
        </div>

        <button type="submit" class="btn btn-success">حفظ التعديلات</button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
@endsection