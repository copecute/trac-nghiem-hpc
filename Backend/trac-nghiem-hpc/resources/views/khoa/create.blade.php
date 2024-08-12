<!DOCTYPE html>
<html>
<head>
    <title>Thêm Mới Khoa</title>
</head>
<body>
    <h1>Thêm Mới Khoa</h1>

    <!-- thông báo -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('khoa.store') }}" method="POST">
        @csrf
        
        <label for="maKhoa">Mã Khoa:</label>
        <input type="text" id="maKhoa" name="maKhoa" required>
        
        <br><br>
        
        <label for="tenKhoa">Tên Khoa:</label>
        <input type="text" id="tenKhoa" name="tenKhoa" required>
        
        <br><br>
        
        <button type="submit">Thêm Mới</button>
    </form>

    <a href="{{ route('khoa.index') }}">Trở Lại Danh Sách</a>
</body>
</html>
