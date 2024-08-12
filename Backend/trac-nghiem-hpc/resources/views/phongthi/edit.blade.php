<!-- resources/views/phongthi/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Sửa Phòng Thi')

@section('content')
    <h1>Sửa Phòng Thi</h1>

    <form action="{{ route('phongthi.update', $phongThi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="tenPhongThi">Tên Phòng Thi:</label>
            <input type="text" name="tenPhongThi" id="tenPhongThi" value="{{ old('tenPhongThi', $phongThi->tenPhongThi) }}">
        </div>

        <div>
            <label for="danhSachSinhVien">Danh Sách Sinh Viên (JSON):</label>
            <textarea name="danhSachSinhVien" id="danhSachSinhVien">{{ old('danhSachSinhVien', $phongThi->danhSachSinhVien) }}</textarea>
        </div>

        <div>
            <label for="cathi_id">Ca Thi:</label>
            <select name="cathi_id" id="cathi_id">
                @foreach($caThis as $caThi)
                    <option value="{{ $caThi->id }}" {{ $phongThi->cathi_id == $caThi->id ? 'selected' : '' }}>{{ $caThi->tenCa }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Cập Nhật Phòng Thi</button>
    </form>
@endsection
