<!-- resources/views/lop/index.blade.php -->
@extends('layouts.app')

@section('title', 'Danh sách Lớp')

@section('content')
    <h1>Danh sách Lớp</h1>

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

    <form action="{{ route('lop.search') }}" method="GET">
        <input type="text" name="search" placeholder="Tìm kiếm...">
        <button type="submit">Tìm kiếm</button>
    </form>
    <a href="{{ route('lop.create') }}">Thêm mới</a>
    <table border="1">
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
                    <td>{{ $lop->nghanh->tenNghanh }}</td>
                    <td>
                        <a href="{{ route('lop.edit', $lop->id) }}">Sửa</a>
                        <form action="{{ route('lop.destroy', $lop->id) }}" method="POST" style="display:inline-block;">
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
