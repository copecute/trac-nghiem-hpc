<!-- resources/views/sinhvien/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Sửa Sinh Viên')

@section('content')
    <h1>Sửa Sinh Viên</h1>

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
        <div>
            <label for="maSV">Mã SV:</label>
            <input type="text" name="maSV" id="maSV" value="{{ $sinhVien->maSV }}" required>
        </div>

        <div>
            <label for="hoTen">Họ Tên:</label>
            <input type="text" name="hoTen" id="hoTen" value="{{ $sinhVien->hoTen }}" required>
        </div>

        <div>
            <label for="ngaySinh">Ngày Sinh:</label>
            <input type="date" name="ngaySinh" id="ngaySinh" value="{{ $sinhVien->ngaySinh }}" required>
        </div>

        <div>
            <label for="gioiTinh">Giới Tính:</label>
            <select name="gioiTinh" id="gioiTinh" required>
                <option value="Nam" {{ $sinhVien->gioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ $sinhVien->gioiTinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            </select>
        </div>

        <div>
            <label for="diaChi">Địa Chỉ:</label>
            <input type="text" name="diaChi" id="diaChi" value="{{ $sinhVien->diaChi }}" required>
        </div>

        <div>
            <label for="sdt">Số Điện Thoại:</label>
            <input type="text" name="sdt" id="sdt" value="{{ $sinhVien->sdt }}" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ $sinhVien->email }}" required>
        </div>

        <div>
            <label for="lop_id">Lớp:</label>
            <select name="lop_id" id="lop_id" required>
                @foreach($lops as $lop)
                    <option value="{{ $lop->id }}" {{ $sinhVien->lop_id == $lop->id ? 'selected' : '' }}>
                        {{ $lop->tenLop }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Cập nhật Sinh Viên</button>
    </form>
@endsection
