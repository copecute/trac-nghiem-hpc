@extends('layouts.app')

@section('title', 'Sửa Kỳ Thi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Sửa Kỳ Thi</h1>

    <!-- Hiển thị thông báo nếu có -->
    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @elseif(session('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif

    <form action="{{ route('kythi.update', $kyThi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tenKyThi" class="form-label">Tên Kỳ Thi:</label>
            <input type="text" name="tenKyThi" id="tenKyThi" class="form-control" value="{{ $kyThi->tenKyThi }}" required>
        </div>

        <div class="mb-3">
            <label for="ngayThi" class="form-label">Ngày Thi:</label>
            <input type="date" name="ngayThi" id="ngayThi" class="form-control" value="{{ $kyThi->ngayThi->format('Y-m-d') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật Kỳ Thi</button>
    </form>

    <a href="{{ route('kythi.index') }}" class="btn btn-secondary mt-3">Trở Lại Danh Sách</a>
</div>
@endsection
