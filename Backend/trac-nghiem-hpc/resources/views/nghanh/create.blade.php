<!DOCTYPE html>
<html>
<head>
    <title>Thêm Ngành Mới</title>
</head>
<body>
    <h1>Thêm Ngành Mới</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('nghanh.store') }}" method="POST">
        @csrf
        <label for="maNghanh">Mã Ngành:</label>
        <input type="text" name="maNghanh" id="maNghanh" required>

        <label for="tenNghanh">Tên Ngành:</label>
        <input type="text" name="tenNghanh" id="tenNghanh" required>

        <label for="khoa_id">Khoa:</label>
        <select name="khoa_id" id="khoa_id" required>
            @foreach($khoas as $khoa)
                <option value="{{ $khoa->id }}">{{ $khoa->tenKhoa }}</option>
            @endforeach
        </select>

        <button type="submit">Thêm</button>
    </form>

    <a href="{{ route('nghanh.index') }}">Quay lại</a>
</body>
</html>
