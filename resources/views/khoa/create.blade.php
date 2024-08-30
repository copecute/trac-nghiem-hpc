@extends('layouts.app')

@section('title', 'Thêm Mới Khoa')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Mới Khoa</h1>

    <!-- Thông báo -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('khoa.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="maKhoa" class="form-label">Mã Khoa:</label>
            <input type="text" id="maKhoa" name="maKhoa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tenKhoa" class="form-label">Tên Khoa:</label>
            <input type="text" id="tenKhoa" name="tenKhoa" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Mới</button>
    </form>

    <a href="{{ route('khoa.index') }}" class="btn btn-secondary mt-3">Trở Lại Danh Sách</a>
</div>
@endsection
