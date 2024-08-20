@extends('layouts.app')

@section('title', 'Danh Sách Ngành')

@section('content')
    <h1>Danh Sách Ngành</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('nganh.search') }}" method="GET">
        <input type="text" name="search" placeholder="Tìm kiếm">
        <button type="submit">Tìm kiếm</button>
    </form>

    <a href="{{ route('nganh.create') }}">Thêm Ngành Mới</a>

    <table border="1">
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
                        <a href="{{ route('nganh.edit', $nganh->id) }}">Sửa</a>
                        <form action="{{ route('nganh.destroy', $nganh->id) }}" method="POST" style="display:inline;">
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