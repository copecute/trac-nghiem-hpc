<!DOCTYPE html>
<html>
<head>
    <title>Chi Tiết Ngành</title>
</head>
<body>
    <h1>Chi Tiết Ngành</h1>
    <p>Mã Ngành: {{ $nghanh->maNghanh }}</p>
    <p>Tên Ngành: {{ $nghanh->tenNghanh }}</p>
    <p>Khoa: {{ $nghanh->khoa->tenKhoa }}</p>
    <a href="/nghanh">Quay lại danh sách</a>
    <a href="/nghanh/{{ $nghanh->id }}/edit">Chỉnh sửa</a>
</body>
</html>
