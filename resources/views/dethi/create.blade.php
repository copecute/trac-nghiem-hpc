@extends('layouts.app')

@section('title', 'Thêm Đề Thi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Đề Thi</h1>

    <form action="{{ route('dethi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tenDe" class="form-label">Tên Đề Thi:</label>
            <input type="text" name="tenDe" id="tenDe" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="soLuongCauHoi" class="form-label">Số Lượng Câu Hỏi:</label>
            <input type="number" name="soLuongCauHoi" id="soLuongCauHoi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tiLeKho" class="form-label">Tỉ Lệ Khó:</label>
            <input type="number" name="tiLeKho" id="tiLeKho" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tiLeTrungBinh" class="form-label">Tỉ Lệ Trung Bình:</label>
            <input type="number" name="tiLeTrungBinh" id="tiLeTrungBinh" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tiLeDe" class="form-label">Tỉ Lệ Đề:</label>
            <input type="number" name="tiLeDe" id="tiLeDe" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="cauHoi" class="form-label">Câu Hỏi (JSON):</label>
            <textarea name="cauHoi" id="cauHoi" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="thoiGian" class="form-label">Thời Gian (phút):</label>
            <input type="number" name="thoiGian" id="thoiGian" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="monhoc_id" class="form-label">Môn Học:</label>
            <select name="monhoc_id" id="monhoc_id" class="form-select" required>
                @foreach($monHocs as $monHoc)
                    <option value="{{ $monHoc->id }}">{{ $monHoc->tenMonHoc }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cathi_id" class="form-label">Ca Thi:</label>
            <select name="cathi_id" id="cathi_id" class="form-select" required>
                @foreach($caThis as $caThi)
                    <option value="{{ $caThi->id }}">{{ $caThi->tenCa }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Đề Thi</button>
    </form>
</div>
@endsection
