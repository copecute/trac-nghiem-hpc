@extends('layouts.app')

@section('title', 'Sửa Phòng Thi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Sửa Phòng Thi</h1>

    <form action="{{ route('phongthi.update', $phongThi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tenPhongThi" class="form-label">Tên Phòng Thi:</label>
            <input type="text" name="tenPhongThi" id="tenPhongThi" class="form-control" value="{{ old('tenPhongThi', $phongThi->tenPhongThi) }}" required>
        </div>

        <div class="mb-3">
            <label for="danhSachSinhVien" class="form-label">Danh Sách Sinh Viên (JSON):</label>
            <textarea name="danhSachSinhVien" id="danhSachSinhVien" class="form-control" rows="5">{{ old('danhSachSinhVien', $phongThi->danhSachSinhVien) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cathi_id" class="form-label">Ca Thi:</label>
            <select name="cathi_id" id="cathi_id" class="form-select" required>
                @foreach($caThis as $caThi)
                    <option value="{{ $caThi->id }}" {{ $phongThi->cathi_id == $caThi->id ? 'selected' : '' }}>
                        {{ $caThi->tenCa }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật Phòng Thi</button>
    </form>
</div>
@endsection
