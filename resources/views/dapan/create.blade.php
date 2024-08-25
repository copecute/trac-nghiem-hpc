@extends('layouts.app')

@section('title', 'Thêm Đáp Án')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Đáp Án cho Câu Hỏi: <strong>{{ $cauHoi->noiDung }}</strong></h1>

    <form action="{{ route('dapan.store', $cauHoi->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="typeText" class="form-label">Text:</label>
            <input type="text" name="typeText" id="typeText" class="form-control">
        </div>

        <div class="mb-3">
            <label for="typeAudio" class="form-label">Audio:</label>
            <input type="text" name="typeAudio" id="typeAudio" class="form-control">
        </div>

        <div class="mb-3">
            <label for="typeImage" class="form-label">Hình Ảnh:</label>
            <input type="text" name="typeImage" id="typeImage" class="form-control">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="dapAnDung" id="dapAnDung" class="form-check-input" value="1">
            <label for="dapAnDung" class="form-check-label">Đáp Án Đúng</label>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Đáp Án</button>
    </form>
</div>
@endsection
