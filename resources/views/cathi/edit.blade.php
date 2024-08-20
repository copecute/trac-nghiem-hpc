@extends('layouts.app')

@section('title', 'Sửa Cá Thi')

@section('content')
    <h1>Sửa Ca Thi</h1>
    <form action="{{ route('cathi.update', ['kythi_id' => $kythi_id, 'id' => $cathi->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="tenCa">Tên Ca Thi:</label>
        <input type="text" name="tenCa" id="tenCa" value="{{ $cathi->tenCa }}">
        <label for="thoiGianBatDau">Thời Gian Bắt Đầu:</label>
        <input type="datetime-local" name="thoiGianBatDau" id="thoiGianBatDau" value="{{ $cathi->thoiGianBatDau->format('Y-m-d\TH:i') }}">
        <label for="thoiGianKetThuc">Thời Gian Kết Thúc:</label>
        <input type="datetime-local" name="thoiGianKetThuc" id="thoiGianKetThuc" value="{{ $cathi->thoiGianKetThuc->format('Y-m-d\TH:i') }}">
        <label for="monhoc_id">Môn Học:</label>
        <select name="monhoc_id" id="monhoc_id">
            @foreach ($monhocs as $monhoc)
                <option value="{{ $monhoc->id }}" {{ $cathi->monhoc_id == $monhoc->id ? 'selected' : '' }}>{{ $monhoc->tenMonHoc }}</option>
            @endforeach
        </select>
        <button type="submit">Cập Nhật</button>
    </form>
    <a href="{{ route('cathi.index', ['kythi_id' => $kythi_id]) }}">Quay lại</a>
@endsection