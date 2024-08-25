@extends('layouts.app')

@section('title', 'Thêm Sinh Viên Mới')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Sinh Viên Mới</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sinhvien.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="maSV" class="form-label">Mã SV:</label>
            <input type="text" name="maSV" id="maSV" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="matKhau" class="form-label">Mật khẩu:</label>
            <input type="password" name="matKhau" id="matKhau" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hoTen" class="form-label">Họ Tên:</label>
            <input type="text" name="hoTen" id="hoTen" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ngaySinh" class="form-label">Ngày Sinh:</label>
            <input type="date" name="ngaySinh" id="ngaySinh" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="gioiTinh" class="form-label">Giới Tính:</label>
            <select name="gioiTinh" id="gioiTinh" class="form-select" required>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="diaChi" class="form-label">Địa Chỉ:</label>
            <input type="text" name="diaChi" id="diaChi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="sdt" class="form-label">Số Điện Thoại:</label>
            <input type="text" name="sdt" id="sdt" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="lop_id" class="form-label">Lớp:</label>
            <select name="lop_id" id="lop_id" class="form-select" required>
                @foreach($lops as $lop)
                    <option value="{{ $lop->id }}">{{ $lop->tenLop }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Sinh Viên</button>
    </form>
</div>
@endsection
