@extends('layouts.app')

@section('title', 'Danh sách Câu Hỏi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh sách Câu Hỏi</h1>

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
        <a href="{{ route('cauhoi.create') }}" class="btn btn-primary">Thêm Câu Hỏi</a>
    </div>

    <form action="{{ route('cauhoi.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm...">
            <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
        </div>
    </form>

    <table class="table table-striped table-bordered">
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
                        <a href="{{ route('dapan.index', $cauHoi->id) }}" class="btn btn-info btn-sm">Xem Đáp Án</a>
                        <a href="{{ route('cauhoi.edit', $cauHoi->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('cauhoi.destroy', $cauHoi->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');" style="display:inline;">
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
