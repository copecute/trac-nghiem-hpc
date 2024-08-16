<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả</title>
</head>
<body>
    <h1>Kết Quả</h1>
    <p><strong>Điểm số:</strong> {{ $ketQua->diemSo }}</p>
    <p><strong>Danh sách đáp án:</strong> {{ json_encode($ketQua->danhSachDapAn) }}</p>
</body>
</html>
