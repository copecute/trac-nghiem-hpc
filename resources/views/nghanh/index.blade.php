<!DOCTYPE html>
<html>
<head>
    <title>Danh Sách Ngành</title>
</head>
<body>
    <h1>Danh Sách Ngành</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('nghanh.search') }}" method="GET">
        <input type="text" name="search" placeholder="Tìm kiếm">
        <button type="submit">Tìm kiếm</button>
    </form>

    <a href="{{ route('nghanh.create') }}">Thêm Ngành Mới</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã Ngành</th>
                <th>Tên Ngành</th>
                <th>Khoa</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nghanhs as $nghanh)
                <tr>
                    <td>{{ $nghanh->id }}</td>
                    <td>{{ $nghanh->maNghanh }}</td>
                    <td>{{ $nghanh->tenNghanh }}</td>
                    <td>{{ $nghanh->khoa->tenKhoa }}</td>
                    <td>
                        <a href="{{ route('nghanh.edit', $nghanh->id) }}">Sửa</a>
                        <form action="{{ route('nghanh.destroy', $nghanh->id) }}" method="POST" style="display:inline;">
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
