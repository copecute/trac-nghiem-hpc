@extends('layouts.app')

@section('title', 'Thêm Phòng Thi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Phòng Thi</h1>

    <form action="{{ route('phongthi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tenPhongThi" class="form-label">Tên Phòng Thi:</label>
            <input type="text" name="tenPhongThi" id="tenPhongThi" class="form-control" value="{{ old('tenPhongThi') }}" required>
        </div>

        <div class="mb-3">
            <label for="danhSachSinhVien" class="form-label">Danh Sách Sinh Viên (JSON):</label>
            <textarea name="danhSachSinhVien" id="danhSachSinhVien" class="form-control" rows="5">{{ old('danhSachSinhVien') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cathi_id" class="form-label">Ca Thi:</label>
            <select name="cathi_id" id="cathi_id" class="form-select" required>
                @foreach($caThis as $caThi)
                    <option value="{{ $caThi->id }}">{{ $caThi->tenCa }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Phòng Thi</button>
    </form>
</div>
@endsection
