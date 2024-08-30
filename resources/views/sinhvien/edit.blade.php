@extends('layouts.app')

@section('title', 'Sửa Sinh Viên')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Sửa Sinh Viên</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sinhvien.update', $sinhVien->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="maSV" class="form-label">Mã SV:</label>
            <input type="text" name="maSV" id="maSV" class="form-control" value="{{ old('maSV', $sinhVien->maSV) }}" required>
        </div>

        <div class="mb-3">
            <label for="hoTen" class="form-label">Họ Tên:</label>
            <input type="text" name="hoTen" id="hoTen" class="form-control" value="{{ old('hoTen', $sinhVien->hoTen) }}" required>
        </div>

        <div class="mb-3">
            <label for="ngaySinh" class="form-label">Ngày Sinh:</label>
            <input type="date" name="ngaySinh" id="ngaySinh" class="form-control" value="{{ old('ngaySinh', $sinhVien->ngaySinh) }}" required>
        </div>

        <div class="mb-3">
            <label for="gioiTinh" class="form-label">Giới Tính:</label>
            <select name="gioiTinh" id="gioiTinh" class="form-select" required>
                <option value="Nam" {{ old('gioiTinh', $sinhVien->gioiTinh) == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ old('gioiTinh', $sinhVien->gioiTinh) == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="diaChi" class="form-label">Địa Chỉ:</label>
            <input type="text" name="diaChi" id="diaChi" class="form-control" value="{{ old('diaChi', $sinhVien->diaChi) }}" required>
        </div>

        <div class="mb-3">
            <label for="sdt" class="form-label">Số Điện Thoại:</label>
            <input type="text" name="sdt" id="sdt" class="form-control" value="{{ old('sdt', $sinhVien->sdt) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $sinhVien->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="lop_id" class="form-label">Lớp:</label>
            <select name="lop_id" id="lop_id" class="form-select" required>
                @foreach($lops as $lop)
                    <option value="{{ $lop->id }}" {{ old('lop_id', $sinhVien->lop_id) == $lop->id ? 'selected' : '' }}>
                        {{ $lop->tenLop }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật Sinh Viên</button>
    </form>
</div>
@endsection
