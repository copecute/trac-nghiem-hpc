@extends('layouts.app')

@section('title', 'Danh Sách Phòng Thi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh Sách Phòng Thi</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('phongthi.index') }}" method="GET" class="mb-4">
        <div class="mb-3">
            <label for="cathi_id" class="form-label">Chọn Ca Thi:</label>
            <select name="cathi_id" id="cathi_id" class="form-select">
                <option value="">--Chọn Ca Thi--</option>
                @foreach($caThis as $caThi)
                    <option value="{{ $caThi->id }}" {{ $cathiId == $caThi->id ? 'selected' : '' }}>
                        {{ $caThi->tenCa }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Lọc</button>
    </form>

    <a href="{{ route('phongthi.create') }}" class="btn btn-success mb-3">Thêm Phòng Thi</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Phòng Thi</th>
                <th>Danh Sách Sinh Viên</th>
                <th>Ca Thi</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($phongThis as $phongThi)
                <tr>
                    <td>{{ $phongThi->id }}</td>
                    <td>{{ $phongThi->tenPhongThi }}</td>
                    <td>{{ json_encode($phongThi->danhSachSinhVien) }}</td>
                    <td>{{ $phongThi->caThi->tenCa }}</td>
                    <td>
                        <a href="{{ route('phongthi.edit', $phongThi->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('phongthi.destroy', $phongThi->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
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