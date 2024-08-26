@extends('layouts.app')

@section('title', 'Danh sách Sinh Viên')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh sách Sinh Viên</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('sinhvien.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..." value="{{ request()->get('search') }}">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <a href="{{ route('sinhvien.create') }}" class="btn btn-success mb-3">Thêm Mới</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Ngày Sinh</th>
                <th>Giới Tính</th>
                <th>Địa Chỉ</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Lớp</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sinhViens as $sinhVien)
                <tr>
                    <td>{{ $sinhVien->id }}</td>
                    <td>{{ $sinhVien->maSV }}</td>
                    <td>{{ $sinhVien->hoTen }}</td>
                    <td>{{ $sinhVien->ngaySinh }}</td>
                    <td>{{ $sinhVien->gioiTinh }}</td>
                    <td>{{ $sinhVien->diaChi }}</td>
                    <td>{{ $sinhVien->sdt }}</td>
                    <td>{{ $sinhVien->email }}</td>
                    <td>{{ $sinhVien->lop->tenLop }}</td>
                    <td>
                        <a href="{{ route('sinhvien.edit', $sinhVien->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('sinhvien.destroy', $sinhVien->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection