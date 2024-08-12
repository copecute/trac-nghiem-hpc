<!-- resources/views/dethi/create.blade.php -->
@extends('layouts.app')

@section('title', 'Thêm Đề Thi')

@section('content')
    <h1>Thêm Đề Thi</h1>

    <form action="{{ route('dethi.store') }}" method="POST">
        @csrf

        <div>
            <label for="tenDe">Tên Đề Thi:</label>
            <input type="text" name="tenDe" id="tenDe">
        </div>

        <div>
            <label for="soLuongCauHoi">Số Lượng Câu Hỏi:</label>
            <input type="number" name="soLuongCauHoi" id="soLuongCauHoi">
        </div>

        <div>
            <label for="tiLeKho">Tỉ Lệ Khó:</label>
            <input type="number" name="tiLeKho" id="tiLeKho">
        </div>

        <div>
            <label for="tiLeTrungBinh">Tỉ Lệ Trung Bình:</label>
            <input type="number" name="tiLeTrungBinh" id="tiLeTrungBinh">
        </div>

        <div>
            <label for="tiLeDe">Tỉ Lệ Đề:</label>
            <input type="number" name="tiLeDe" id="tiLeDe">
        </div>

        <div>
            <label for="cauHoi">Câu Hỏi (JSON):</label>
            <textarea name="cauHoi" id="cauHoi"></textarea>
        </div>

        <div>
            <label for="thoiGian">Thời Gian:</label>
            <input type="number" name="thoiGian" id="thoiGian">
        </div>

        <div>
            <label for="monhoc_id">Môn Học:</label>
            <select name="monhoc_id" id="monhoc_id">
                @foreach($monHocs as $monHoc)
                    <option value="{{ $monHoc->id }}">{{ $monHoc->tenMonHoc }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="cathi_id">Ca Thi:</label>
            <select name="cathi_id" id="cathi_id">
                @foreach($caThis as $caThi)
                    <option value="{{ $caThi->id }}">{{ $caThi->tenCa }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Thêm Đề Thi</button>
    </form>
@endsection
