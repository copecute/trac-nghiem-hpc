<!-- resources/views/cauhoi/index.blade.php -->
@extends('layouts.app')

@section('title', 'Danh sách Câu Hỏi')

@section('content')
    <h1>Danh sách Câu Hỏi</h1>

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

    <a href="{{ route('cauhoi.create') }}">Thêm Câu Hỏi</a>

    <form action="{{ route('cauhoi.search') }}" method="GET">
        <input type="text" name="search" placeholder="Tìm kiếm...">
        <button type="submit">Tìm kiếm</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nội Dung</th>
                <th>Audio</th>
                <th>Video</th>
                <th>Hình Ảnh</th>
                <th>Độ Khó</th>
                <th>Môn Học</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cauHois as $cauHoi)
                <tr>
                    <td>{{ $cauHoi->id }}</td>
                    <td>{{ $cauHoi->noiDung }}</td>
                    <td>{{ $cauHoi->typeAudio }}</td>
                    <td>{{ $cauHoi->typeVideo }}</td>
                    <td>{{ $cauHoi->typeImage }}</td>
                    <td>{{ $cauHoi->doKho }}</td>
                    <td>{{ $cauHoi->monhoc->tenMonHoc }}</td>
                    <td>
                            <a href="{{ route('dapan.index', $cauHoi->id) }}">Xem Đáp Án</a>
                        <a href="{{ route('cauhoi.edit', $cauHoi->id) }}">Sửa</a>
                        <form action="{{ route('cauhoi.destroy', $cauHoi->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');" style="display:inline-block;">
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
