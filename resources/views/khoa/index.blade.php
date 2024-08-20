@extends('layouts.app')

@section('title', 'Danh Sách Khoa')

@section('content')
    <h1>Danh sách Khoa</h1>

    <!-- Form tìm kiếm -->
    <form method="GET" action="{{ route('khoa.search') }}">
        <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">
        <button type="submit">Tìm kiếm</button>
    </form>

    <a href="{{ route('khoa.create') }}">Thêm mới</a>

    <table border="1">
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
                        <a href="{{ route('khoa.edit', $khoa->id) }}">Chỉnh sửa</a>
                        <form action="{{ route('khoa.destroy', $khoa->id) }}" method="POST" style="display:inline;">
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