@extends('layouts.app')

@section('title', 'Danh Sách Kỳ Thi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh Sách Kỳ Thi</h1>

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

    <div class="mb-3">
        <a href="{{ route('kythi.create') }}" class="btn btn-primary">Thêm Kỳ Thi</a>
    </div>

    <!-- Form tìm kiếm -->
    <form action="{{ route('kythi.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
        </div>
    </form>

    <!-- Bảng danh sách kỳ thi -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Kỳ Thi</th>
                <th>Ngày Bắt Đầu</th>
                <th>Ngày Kết Thúc</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kyThis as $kyThi)
                <tr>
                    <td>{{ $kyThi->id }}</td>
                    <td>{{ $kyThi->tenKyThi }}</td>
                    <td>{{ $kyThi->ngayBatDau }}</td>
                    <td>{{ $kyThi->ngayKetThuc }}</td>
                    <td>
                        <a href="{{ route('cathi.index', $kyThi->id) }}" class="btn btn-info btn-sm">Xem Ca Thi</a>
                        <a href="{{ route('kythi.edit', $kyThi->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('kythi.destroy', $kyThi->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');" style="display:inline;">
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
