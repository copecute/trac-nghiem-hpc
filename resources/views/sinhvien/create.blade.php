@extends('layouts.app')

@section('title', 'Thêm Sinh Viên Mới')

@section('content')
    <h1>Thêm Sinh Viên Mới</h1>

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
        <div>
            <label for="maSV">Mã SV:</label>
            <input type="text" name="maSV" id="maSV" required>
        </div>

        <div>
            <label for="matKhau">Mật khẩu:</label>
            <input type="password" name="matKhau" id="matKhau" required>
        </div>

        <div>
            <label for="hoTen">Họ Tên:</label>
            <input type="text" name="hoTen" id="hoTen" required>
        </div>

        <div>
            <label for="ngaySinh">Ngày Sinh:</label>
            <input type="date" name="ngaySinh" id="ngaySinh" required>
        </div>

        <div>
            <label for="gioiTinh">Giới Tính:</label>
            <select name="gioiTinh" id="gioiTinh" required>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>

        <div>
            <label for="diaChi">Địa Chỉ:</label>
            <input type="text" name="diaChi" id="diaChi" required>
        </div>

        <div>
            <label for="sdt">Số Điện Thoại:</label>
            <input type="text" name="sdt" id="sdt" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="lop_id">Lớp:</label>
            <select name="lop_id" id="lop_id" required>
                @foreach($lops as $lop)
                    <option value="{{ $lop->id }}">{{ $lop->tenLop }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Thêm Sinh Viên</button>
    </form>
@endsection
