@extends('layouts.app')

@section('title', 'Sửa Đáp Án')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Sửa Đáp Án của Câu Hỏi: <strong>{{ $cauHoi->noiDung }}</strong></h1>

    <form action="{{ route('dapan.update', [$cauHoi->id, $dapAn->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="typeText" class="form-label">Text:</label>
            <input type="text" name="typeText" id="typeText" class="form-control" value="{{ $dapAn->typeText }}">
        </div>

        <div class="mb-3">
            <label for="typeAudio" class="form-label">Audio:</label>
            <input type="text" name="typeAudio" id="typeAudio" class="form-control" value="{{ $dapAn->typeAudio }}">
        </div>

        <div class="mb-3">
            <label for="typeImage" class="form-label">Hình Ảnh:</label>
            <input type="text" name="typeImage" id="typeImage" class="form-control" value="{{ $dapAn->typeImage }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="dapAnDung" id="dapAnDung" class="form-check-input" value="1" {{ $dapAn->dapAnDung ? 'checked' : '' }}>
            <label for="dapAnDung" class="form-check-label">Đáp Án Đúng</label>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật Đáp Án</button>
    </form>
</div>
@endsection
