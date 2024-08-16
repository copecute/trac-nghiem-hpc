<!DOCTYPE html>
<html>
<head>
    <title>Sửa Ngành</title>
</head>
<body>
    <h1>Sửa Ngành</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('nghanh.update', $nghanh->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="maNghanh">Mã Ngành:</label>
        <input type="text" name="maNghanh" id="maNghanh" value="{{ $nghanh->maNghanh }}" required>

        <label for="tenNghanh">Tên Ngành:</label>
        <input type="text" name="tenNghanh" id="tenNghanh" value="{{ $nghanh->tenNghanh }}" required>

        <label for="khoa_id">Khoa:</label>
        <select name="khoa_id" id="khoa_id" required>
            @foreach($khoas as $khoa)
                <option value="{{ $khoa->id }}" {{ $khoa->id == $nghanh->khoa_id ? 'selected' : '' }}>
                    {{ $khoa->tenKhoa }}
                </option>
            @endforeach
        </select>

        <button type="submit">Cập Nhật</button>
    </form>

    <a href="{{ route('nghanh.index') }}">Quay lại</a>
</body>
</html>
