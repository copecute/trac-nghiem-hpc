@extends('layouts.app')

@section('title', 'Cập Nhật Khoa')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Cập Nhật Khoa</h1>

    <!-- Hiển thị thông báo nếu có -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('khoa.update', $khoa->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="maKhoa" class="form-label">Mã Khoa:</label>
            <input type="text" id="maKhoa" name="maKhoa" class="form-control" value="{{ $khoa->maKhoa }}" required>
        </div>

        <div class="mb-3">
            <label for="tenKhoa" class="form-label">Tên Khoa:</label>
            <input type="text" id="tenKhoa" name="tenKhoa" class="form-control" value="{{ $khoa->tenKhoa }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>

    <a href="{{ route('khoa.index') }}" class="btn btn-secondary mt-3">Trở Lại Danh Sách</a>
</div>
@endsection
