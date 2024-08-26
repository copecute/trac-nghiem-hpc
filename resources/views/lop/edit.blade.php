@extends('layouts.app')

@section('title', 'Sửa Lớp')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Sửa Lớp</h1>

    <!-- Hiển thị thông báo lỗi nếu có -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form sửa lớp -->
    <form action="{{ route('lop.update', $lop->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="maLop" class="form-label">Mã Lớp:</label>
            <input type="text" name="maLop" id="maLop" class="form-control" value="{{ old('maLop', $lop->maLop) }}" required>
        </div>

        <div class="mb-3">
            <label for="tenLop" class="form-label">Tên Lớp:</label>
            <input type="text" name="tenLop" id="tenLop" class="form-control" value="{{ old('tenLop', $lop->tenLop) }}" required>
        </div>

        <div class="mb-3">
            <label for="nganh_id" class="form-label">Ngành:</label>
            <select name="nganh_id" id="nganh_id" class="form-select" required>
                @foreach($nganhs as $nganh)
                    <option value="{{ $nganh->id }}" {{ $nganh->id == $lop->nganh_id ? 'selected' : '' }}>
                        {{ $nganh->tenNganh }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật Lớp</button>
    </form>

    <a href="{{ route('lop.index') }}" class="btn btn-secondary mt-3">Trở về danh sách</a>
</div>
@endsection
