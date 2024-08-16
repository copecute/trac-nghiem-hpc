<!-- resources/views/kythi/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Sửa Kỳ Thi')

@section('content')
    <h1>Sửa Kỳ Thi</h1>

    <form action="{{ route('kythi.update', $kyThi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="tenKyThi">Tên Kỳ Thi:</label>
            <input type="text" name="tenKyThi" id="tenKyThi" value="{{ $kyThi->tenKyThi }}">
        </div>

        <div>
            <label for="ngayThi">Ngày Thi:</label>
            <input type="date" name="ngayThi" id="ngayThi" value="{{ $kyThi->ngayThi->format('Y-m-d') }}">
        </div>

        <button type="submit">Cập nhật Kỳ Thi</button>
    </form>
@endsection
