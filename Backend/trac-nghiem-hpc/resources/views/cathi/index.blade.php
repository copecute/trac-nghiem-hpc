<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Ca Thi</title>
</head>
<body>
    <h1>Danh sách Ca Thi</h1>
    <a href="{{ route('cathi.create', ['kythi_id' => $kythi_id]) }}">Thêm mới</a>
    <form action="{{ route('cathi.index', ['kythi_id' => $kythi_id]) }}" method="GET">
        <label for="monhoc_id">Lọc theo môn học:</label>
        <select name="monhoc_id" id="monhoc_id">
            <option value="">-- Chọn môn học --</option>
            @foreach ($monhocs as $monhoc)
                <option value="{{ $monhoc->id }}">{{ $monhoc->tenMonHoc }}</option>
            @endforeach
        </select>
        <button type="submit">Lọc</button>
    </form>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>Tên Ca Thi</th>
                <th>Môn Học</th>
                <th>Thời Gian Bắt Đầu</th>
                <th>Thời Gian Kết Thúc</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cathis as $cathi)
                <tr>
                    <td>{{ $cathi->tenCa }}</td>
                    <td>{{ $cathi->monhoc->tenMonHoc }}</td>
                    <td>{{ $cathi->thoiGianBatDau }}</td>
                    <td>{{ $cathi->thoiGianKetThuc }}</td>
                    <td>
                        <a href="{{ route('cathi.edit', ['kythi_id' => $kythi_id, 'id' => $cathi->id]) }}">Sửa</a>
                        <form action="{{ route('cathi.destroy', ['kythi_id' => $kythi_id, 'id' => $cathi->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
