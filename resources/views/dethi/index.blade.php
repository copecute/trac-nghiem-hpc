@extends('layouts.app')

@section('title', 'Danh Sách Đề Thi')

@section('content')
    <h1>Danh Sách Đề Thi</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('dethi.index') }}" method="GET">
        <label for="cathi_id">Chọn Ca Thi:</label>
        <select name="cathi_id" id="cathi_id">
            <option value="">--Chọn Ca Thi--</option>
            @foreach($caThis as $caThi)
                <option value="{{ $caThi->id }}" {{ $caThiId == $caThi->id ? 'selected' : '' }}>{{ $caThi->tenCa }}</option>
            @endforeach
        </select>
        <button type="submit">Lọc</button>
    </form>

    <a href="{{ route('dethi.create') }}">Thêm Đề Thi</a>

    <table>
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
                        <a href="{{ route('dethi.edit', $deThi->id) }}">Sửa</a>
                        <form action="{{ route('dethi.destroy', $deThi->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');" style="display:inline-block;">
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
