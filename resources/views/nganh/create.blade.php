@extends('layouts.app')

@section('title', 'Thêm Ngành Mới')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Ngành Mới</h1>

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

    <form action="{{ route('nganh.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="maNganh" class="form-label">Mã Ngành:</label>
            <input type="text" name="maNganh" id="maNganh" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tenNganh" class="form-label">Tên Ngành:</label>
            <input type="text" name="tenNganh" id="tenNganh" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="khoa_id" class="form-label">Khoa:</label>
            <select name="khoa_id" id="khoa_id" class="form-select" required>
                @foreach($khoas as $khoa)
                    <option value="{{ $khoa->id }}">{{ $khoa->tenKhoa }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>

    <a href="{{ route('nganh.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
