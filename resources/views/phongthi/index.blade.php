<!-- resources/views/phongthi/index.blade.php -->
@extends('layouts.app')

@section('title', 'Danh Sách Phòng Thi')

@section('content')
    <h1>Danh Sách Phòng Thi</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('phongthi.index') }}" method="GET">
        <label for="cathi_id">Chọn Ca Thi:</label>
        <select name="cathi_id" id="cathi_id">
            <option value="">--Chọn Ca Thi--</option>
            @foreach($caThis as $caThi)
                <option value="{{ $caThi->id }}" {{ $cathiId == $caThi->id ? 'selected' : '' }}>{{ $caThi->tenCa }}</option>
            @endforeach
        </select>
        <button type="submit">Lọc</button>
    </form>

    <a href="{{ route('phongthi.create') }}">Thêm Phòng Thi</a>

    <table>
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
                        <a href="{{ route('phongthi.edit', $phongThi->id) }}">Sửa</a>
                        <form action="{{ route('phongthi.destroy', $phongThi->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');" style="display:inline-block;">
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
