@extends('layouts.admin')

@section('title', 'تعديل مدينة')

@section('content')
    <h3>تعديل مدينة</h3>

    <form action="{{ route('admin.cities.update', $city) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">اسم المدينة</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $city->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">حفظ التعديلات</button>
        <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
@endsection