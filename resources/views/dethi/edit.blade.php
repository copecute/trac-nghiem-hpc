@extends('layouts.app')

@section('title', 'Sửa Đề Thi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Sửa Đề Thi</h1>

    <form action="{{ route('dethi.update', $deThi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tenDe" class="form-label">Tên Đề Thi:</label>
            <input type="text" name="tenDe" id="tenDe" class="form-control" value="{{ $deThi->tenDe }}" required>
        </div>

        <div class="mb-3">
            <label for="soLuongCauHoi" class="form-label">Số Lượng Câu Hỏi:</label>
            <input type="number" name="soLuongCauHoi" id="soLuongCauHoi" class="form-control" value="{{ $deThi->soLuongCauHoi }}" required>
        </div>

        <div class="mb-3">
            <label for="tiLeKho" class="form-label">Tỉ Lệ Khó:</label>
            <input type="number" name="tiLeKho" id="tiLeKho" class="form-control" value="{{ $deThi->tiLeKho }}" required>
        </div>

        <div class="mb-3">
            <label for="tiLeTrungBinh" class="form-label">Tỉ Lệ Trung Bình:</label>
            <input type="number" name="tiLeTrungBinh" id="tiLeTrungBinh" class="form-control" value="{{ $deThi->tiLeTrungBinh }}" required>
        </div>

        <div class="mb-3">
            <label for="tiLeDe" class="form-label">Tỉ Lệ Đề:</label>
            <input type="number" name="tiLeDe" id="tiLeDe" class="form-control" value="{{ $deThi->tiLeDe }}" required>
        </div>

        <div class="mb-3">
            <label for="cauHoi" class="form-label">Câu Hỏi (JSON):</label>
            <textarea name="cauHoi" id="cauHoi" class="form-control" rows="4" required>{{ $deThi->cauHoi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="thoiGian" class="form-label">Thời Gian (phút):</label>
            <input type="number" name="thoiGian" id="thoiGian" class="form-control" value="{{ $deThi->thoiGian }}" required>
        </div>

        <div class="mb-3">
            <label for="monhoc_id" class="form-label">Môn Học:</label>
            <select name="monhoc_id" id="monhoc_id" class="form-select" required>
                @foreach($monHocs as $monHoc)
                    <option value="{{ $monHoc->id }}" {{ $deThi->monhoc_id == $monHoc->id ? 'selected' : '' }}>
                        {{ $monHoc->tenMonHoc }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cathi_id" class="form-label">Ca Thi:</label>
            <select name="cathi_id" id="cathi_id" class="form-select" required>
                @foreach($caThis as $caThi)
                    <option value="{{ $caThi->id }}" {{ $deThi->cathi_id == $caThi->id ? 'selected' : '' }}>
                        {{ $caThi->tenCa }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật Đề Thi</button>
    </form>
</div>
@endsection
