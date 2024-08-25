@extends('layouts.app')

@section('title', 'Danh sách Lớp')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh sách Lớp</h1>

    <!-- Hiển thị thông báo nếu có -->
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

    <!-- Form tìm kiếm -->
    <form action="{{ route('lop.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <!-- Nút thêm mới -->
    <a href="{{ route('lop.create') }}" class="btn btn-success mb-3">Thêm mới</a>

    <!-- Bảng danh sách lớp -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã Lớp</th>
                <th>Tên Lớp</th>
                <th>Ngành</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lops as $lop)
                <tr>
                    <td>{{ $lop->id }}</td>
                    <td>{{ $lop->maLop }}</td>
                    <td>{{ $lop->tenLop }}</td>
                    <td>{{ $lop->nganh->tenNganh }}</td>
                    <td>
                        <a href="{{ route('lop.edit', $lop->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('lop.destroy', $lop->id) }}" method="POST" style="display:inline-block;">
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
