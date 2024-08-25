@extends('layouts.app')

@section('title', 'Danh sách Môn Học')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh sách Môn Học</h1>

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

    <div class="mb-4">
        <a href="{{ route('monhoc.create') }}" class="btn btn-primary">Thêm Môn Học</a>
    </div>

    <form action="{{ route('monhoc.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
        </div>
    </form>

    <table class="table table-striped">
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
                    <td>{{ $monHoc->nganh->tenNganh }}</td>
                    <td>
                        <a href="{{ route('monhoc.edit', $monHoc->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('monhoc.destroy', $monHoc->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');" style="display:inline;">
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
