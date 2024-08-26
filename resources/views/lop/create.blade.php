@extends('layouts.app')

@section('title', 'Thêm Lớp Mới')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Lớp Mới</h1>

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

    <!-- Form thêm lớp mới -->
    <form action="{{ route('lop.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="maLop" class="form-label">Mã Lớp:</label>
            <input type="text" name="maLop" id="maLop" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tenLop" class="form-label">Tên Lớp:</label>
            <input type="text" name="tenLop" id="tenLop" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nganh_id" class="form-label">Ngành:</label>
            <select name="nganh_id" id="nganh_id" class="form-select" required>
                @foreach($nganhs as $nganh)
                    <option value="{{ $nganh->id }}">{{ $nganh->tenNganh }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Lớp</button>
    </form>
</div>
@endsection
