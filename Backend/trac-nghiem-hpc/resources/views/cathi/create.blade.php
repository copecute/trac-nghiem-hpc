<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Ca Thi</title>
</head>
<body>
    <h1>Thêm Ca Thi</h1>
    <form action="{{ route('cathi.store', ['kythi_id' => $kythi_id]) }}" method="POST">
        @csrf
        <label for="tenCa">Tên Ca Thi:</label>
        <input type="text" name="tenCa" id="tenCa">
        <label for="thoiGianBatDau">Thời Gian Bắt Đầu:</label>
        <input type="datetime-local" name="thoiGianBatDau" id="thoiGianBatDau">
        <label for="thoiGianKetThuc">Thời Gian Kết Thúc:</label>
        <input type="datetime-local" name="thoiGianKetThuc" id="thoiGianKetThuc">
        <label for="monhoc_id">Môn Học:</label>
        <select name="monhoc_id" id="monhoc_id">
            @foreach ($monhocs as $monhoc)
                <option value="{{ $monhoc->id }}">{{ $monhoc->tenMonHoc }}</option>
            @endforeach
        </select>
        <button type="submit">Thêm</button>
    </form>
    <a href="{{ route('cathi.index', ['kythi_id' => $kythi_id]) }}">Quay lại</a>
</body>
</html>
