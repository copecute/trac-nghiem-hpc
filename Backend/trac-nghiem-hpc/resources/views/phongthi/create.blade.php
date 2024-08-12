<!-- resources/views/phongthi/create.blade.php -->
@extends('layouts.app')

@section('title', 'Thêm Phòng Thi')

@section('content')
    <h1>Thêm Phòng Thi</h1>

    <form action="{{ route('phongthi.store') }}" method="POST">
        @csrf
        <div>
            <label for="tenPhongThi">Tên Phòng Thi:</label>
            <input type="text" name="tenPhongThi" id="tenPhongThi" value="{{ old('tenPhongThi') }}">
        </div>

        <div>
            <label for="danhSachSinhVien">Danh Sách Sinh Viên (JSON):</label>
            <textarea name="danhSachSinhVien" id="danhSachSinhVien">{{ old('danhSachSinhVien') }}</textarea>
        </div>

        <div>
            <label for="cathi_id">Ca Thi:</label>
            <select name="cathi_id" id="cathi_id">
                @foreach($caThis as $caThi)
                    <option value="{{ $caThi->id }}">{{ $caThi->tenCa }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Thêm Phòng Thi</button>
    </form>
@endsection
