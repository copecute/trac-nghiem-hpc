@extends('layouts.app')

@section('title', 'Danh Sách Đề Thi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh Sách Đề Thi</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('dethi.index') }}" method="GET" class="mb-4">
        <div class="mb-3">
            <label for="cathi_id" class="form-label">Chọn Ca Thi:</label>
            <select name="cathi_id" id="cathi_id" class="form-select">
                <option value="">--Chọn Ca Thi--</option>
                @foreach($caThis as $caThi)
                <option value="{{ $caThi->id }}" {{ $caThiId == $caThi->id ? 'selected' : '' }}>{{ $caThi->tenCa }}</option>
            @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Lọc</button>
    </form>

    <a href="{{ route('dethi.create') }}" class="btn btn-success mb-3">Thêm Đề Thi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Đề</th>
                <th>Số Lượng Câu Hỏi</th>
                <th>Tỉ Lệ Khó</th>
                <th>Tỉ Lệ Trung Bình</th>
                <th>Tỉ Lệ Đề</th>
                <th>Thời Gian</th>
                <th>Môn Học</th>
                <th>Ca Thi</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deThis as $deThi)
                <tr>
                    <td>{{ $deThi->id }}</td>
                    <td>{{ $deThi->tenDe }}</td>
                    <td>{{ $deThi->soLuongCauHoi }}</td>
                    <td>{{ $deThi->tiLeKho }}</td>
                    <td>{{ $deThi->tiLeTrungBinh }}</td>
                    <td>{{ $deThi->tiLeDe }}</td>
                    <td>{{ $deThi->thoiGian }}</td>
                    <td>{{ $deThi->monHoc->tenMonHoc }}</td>
                    <td>{{ $deThi->caThi->tenCa }}</td>
                    <td>
                        <a href="{{ route('dethi.edit', $deThi->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('dethi.destroy', $deThi->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');" style="display:inline-block;">
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
