@extends('layouts.app')

@section('title', 'Danh Sách Khoa')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh Sách Khoa</h1>

    <!-- Form tìm kiếm -->
    <form method="GET" action="{{ route('khoa.search') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </div>
    </form>

    <a href="{{ route('khoa.create') }}" class="btn btn-success mb-3">Thêm mới</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã Khoa</th>
                <th>Tên Khoa</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($khoas as $khoa)
                <tr>
                    <td>{{ $khoa->id }}</td>
                    <td>{{ $khoa->maKhoa }}</td>
                    <td>{{ $khoa->tenKhoa }}</td>
                    <td>
                        <a href="{{ route('khoa.edit', $khoa->id) }}" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                        <form action="{{ route('khoa.destroy', $khoa->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
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
