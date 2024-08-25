@extends('layouts.app')

@section('title', 'Danh Sách Ngành')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh Sách Ngành</h1>

    <!-- Hiển thị thông báo nếu có -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form tìm kiếm -->
    <form action="{{ route('nganh.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <!-- Nút thêm mới -->
    <a href="{{ route('nganh.create') }}" class="btn btn-success mb-3">Thêm Ngành Mới</a>

    <!-- Bảng danh sách -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã Ngành</th>
                <th>Tên Ngành</th>
                <th>Khoa</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nganhs as $nganh)
                <tr>
                    <td>{{ $nganh->id }}</td>
                    <td>{{ $nganh->maNganh }}</td>
                    <td>{{ $nganh->tenNganh }}</td>
                    <td>{{ $nganh->khoa->tenKhoa }}</td>
                    <td>
                        <a href="{{ route('nganh.edit', $nganh->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('nganh.destroy', $nganh->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
