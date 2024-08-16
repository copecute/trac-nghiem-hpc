<!-- resources/views/monhoc/index.blade.php -->
@extends('layouts.app')

@section('title', 'Danh sách Môn Học')

@section('content')
    <h1>Danh sách Môn Học</h1>

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

    <a href="{{ route('monhoc.create') }}">Thêm Môn Học</a>

    <form action="{{ route('monhoc.search') }}" method="GET">
        <input type="text" name="search" placeholder="Tìm kiếm...">
        <button type="submit">Tìm kiếm</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã Môn Học</th>
                <th>Tên Môn Học</th>
                <th>Ngành</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monHocs as $monHoc)
                <tr>
                    <td>{{ $monHoc->id }}</td>
                    <td>{{ $monHoc->maMonHoc }}</td>
                    <td>{{ $monHoc->tenMonHoc }}</td>
                    <td>{{ $monHoc->nghanh->tenNghanh }}</td>
                    <td>
                        <a href="{{ route('monhoc.edit', $monHoc->id) }}">Sửa</a>
                        <form action="{{ route('monhoc.destroy', $monHoc->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');" style="display:inline-block;">
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
