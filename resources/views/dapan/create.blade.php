<!-- resources/views/dapan/create.blade.php -->
@extends('layouts.app')

@section('title', 'Thêm Đáp Án')

@section('content')
    <h1>Thêm Đáp Án cho Câu Hỏi: {{ $cauHoi->noiDung }}</h1>

    <form action="{{ route('dapan.store', $cauHoi->id) }}" method="POST">
        @csrf

        <div>
            <label for="typeText">Text:</label>
            <input type="text" name="typeText" id="typeText">
        </div>

        <div>
            <label for="typeAudio">Audio:</label>
            <input type="text" name="typeAudio" id="typeAudio">
        </div>

        <div>
            <label for="typeImage">Hình Ảnh:</label>
            <input type="text" name="typeImage" id="typeImage">
        </div>

        <div>
            <label for="dapAnDung">Đáp Án Đúng:</label>
            <input type="checkbox" name="dapAnDung" id="dapAnDung" value="1">
        </div>

        <button type="submit">Thêm Đáp Án</button>
    </form>
@endsection
