@extends('layouts.app')

@section('title', 'Sửa Ngành')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Sửa Ngành</h1>

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

    <form action="{{ route('nganh.update', $nganh->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="maNganh" class="form-label">Mã Ngành:</label>
            <input type="text" name="maNganh" id="maNganh" class="form-control" value="{{ $nganh->maNganh }}" required>
        </div>

        <div class="mb-3">
            <label for="tenNganh" class="form-label">Tên Ngành:</label>
            <input type="text" name="tenNganh" id="tenNganh" class="form-control" value="{{ $nganh->tenNganh }}" required>
        </div>

        <div class="mb-3">
            <label for="khoa_id" class="form-label">Khoa:</label>
            <select name="khoa_id" id="khoa_id" class="form-select" required>
                @foreach($khoas as $khoa)
                    <option value="{{ $khoa->id }}" {{ $khoa->id == $nganh->khoa_id ? 'selected' : '' }}>
                        {{ $khoa->tenKhoa }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>

    <a href="{{ route('nganh.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
