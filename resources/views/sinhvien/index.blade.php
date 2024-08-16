<!-- resources/views/sinhvien/index.blade.php -->
@extends('layouts.app')

@section('title', 'Danh sách Sinh Viên')

@section('content')
    <h1>Danh sách Sinh Viên</h1>

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

    <form action="{{ route('sinhvien.search') }}" method="GET">
        <input type="text" name="search" placeholder="Tìm kiếm...">
        <button type="submit">Tìm kiếm</button>
    </form>

    <a href="{{ route('sinhvien.create') }}">Thêm Mới</a>
    
    <table border="1">
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
                        <a href="{{ route('sinhvien.edit', $sinhVien->id) }}">Sửa</a>
                        <form action="{{ route('sinhvien.destroy', $sinhVien->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
