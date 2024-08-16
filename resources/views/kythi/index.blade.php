<!-- resources/views/kythi/index.blade.php -->
@extends('layouts.app')

@section('title', 'Danh sách Kỳ Thi')

@section('content')
    <h1>Danh sách Kỳ Thi</h1>

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

    <a href="{{ route('kythi.create') }}">Thêm Kỳ Thi</a>

    <form action="{{ route('kythi.search') }}" method="GET">
        <input type="text" name="search" placeholder="Tìm kiếm...">
        <button type="submit">Tìm kiếm</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Kỳ Thi</th>
                <th>Ngày Bắt Đầu</th>
                <th>Ngày Kết Thúc</th>
                <th>Hành động</th>
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
                        <a href="{{ route('cathi.index', $kyThi->id) }}">Xem ca thi</a>
                        <a href="{{ route('kythi.edit', $kyThi->id) }}">Sửa</a>
                        <form action="{{ route('kythi.destroy', $kyThi->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');" style="display:inline-block;">
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
