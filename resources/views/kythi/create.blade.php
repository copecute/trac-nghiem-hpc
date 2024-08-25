@extends('layouts.app')

@section('title', 'Thêm Kỳ Thi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Kỳ Thi</h1>

    <!-- Hiển thị thông báo nếu có -->
    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @elseif(session('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif

    <form action="{{ route('kythi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tenKyThi" class="form-label">Tên Kỳ Thi:</label>
            <input type="text" name="tenKyThi" id="tenKyThi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ngayBatDau" class="form-label">Ngày Bắt Đầu:</label>
            <input type="date" name="ngayBatDau" id="ngayBatDau" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ngayKetThuc" class="form-label">Ngày Kết Thúc:</label>
            <input type="date" name="ngayKetThuc" id="ngayKetThuc" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Kỳ Thi</button>
    </form>

    <a href="{{ route('kythi.index') }}" class="btn btn-secondary mt-3">Trở Lại Danh Sách</a>
</div>
@endsection
