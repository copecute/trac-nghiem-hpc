<!-- resources/views/kythi/create.blade.php -->
@extends('layouts.app')

@section('title', 'Thêm Kỳ Thi')

@section('content')
    <h1>Thêm Kỳ Thi</h1>

    <form action="{{ route('kythi.store') }}" method="POST">
        @csrf

        <div>
            <label for="tenKyThi">Tên Kỳ Thi:</label>
            <input type="text" name="tenKyThi" id="tenKyThi">
        </div>

        <div>
            <label for="ngayBatDau">Ngày Bắt Đầu:</label>
            <input type="date" name="ngayBatDau" id="ngayBatDau">
        </div>

        <div>
            <label for="ngayKetThuc">Ngày Kết Thúc:</label>
            <input type="date" name="ngayKetThuc" id="ngayKetThuc">
        </div>

        <button type="submit">Thêm Kỳ Thi</button>
    </form>
@endsection
