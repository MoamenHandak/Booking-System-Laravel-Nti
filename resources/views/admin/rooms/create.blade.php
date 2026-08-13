@extends('layouts.admin')

@section('title', 'إضافة غرفة')

@section('content')
    <h3>إضافة غرفة جديدة</h3>

    {{-- enctype ضروري جداً عشان رفع الملفات يشتغل --}}
    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf

        <div class="mb-3">
            <label class="form-label">الفندق</label>
            <select name="hotel_id" class="form-select @error('hotel_id') is-invalid @enderror">
                <option value="">اختر الفندق</option>
                @foreach ($hotels as $hotel)
                    <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->name }}
                    </option>
                @endforeach
            </select>
            @error('hotel_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">نوع الغرفة</label>
            <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}" placeholder="مثال: Single, Double, Suite">
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">السعر</label>
            <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">السعة (عدد الأشخاص)</label>
            <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity', 1) }}">
            @error('capacity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">صورة الغرفة</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_available" class="form-check-input" id="is_available" checked>
            <label class="form-check-label" for="is_available">الغرفة متاحة</label>
        </div>

        <button type="submit" class="btn btn-success">حفظ</button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
@endsection