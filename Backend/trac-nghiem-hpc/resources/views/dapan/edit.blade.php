<!-- resources/views/dapan/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Sửa Đáp Án')

@section('content')
    <h1>Sửa Đáp Án của Câu Hỏi: {{ $cauHoi->noiDung }}</h1>

    <form action="{{ route('dapan.update', [$cauHoi->id, $dapAn->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="typeText">Text:</label>
            <input type="text" name="typeText" id="typeText" value="{{ $dapAn->typeText }}">
        </div>

        <div>
            <label for="typeAudio">Audio:</label>
            <input type="text" name="typeAudio" id="typeAudio" value="{{ $dapAn->typeAudio }}">
        </div>

        <div>
            <label for="typeImage">Hình Ảnh:</label>
            <input type="text" name="typeImage" id="typeImage" value="{{ $dapAn->typeImage }}">
        </div>

        <div>
            <label for="dapAnDung">Đáp Án Đúng:</label>
            <input type="checkbox" name="dapAnDung" id="dapAnDung" value="1" {{ $dapAn->dapAnDung ? 'checked' : '' }}>
        </div>

        <button type="submit">Cập nhật Đáp Án</button>
    </form>
@endsection
