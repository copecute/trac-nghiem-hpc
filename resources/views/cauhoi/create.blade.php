@extends('layouts.app')

@section('title', 'Thêm Câu Hỏi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Câu Hỏi</h1>

    <!-- Form Thêm Câu Hỏi -->
    <form action="{{ route('cauhoi.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="noiDung">Nội Dung:</label>
            <textarea name="noiDung" id="noiDung" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="typeAudio">Loại Audio:</label>
            <input type="text" name="typeAudio" id="typeAudio" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="typeVideo">Loại Video:</label>
            <input type="text" name="typeVideo" id="typeVideo" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="typeImage">Loại Hình Ảnh:</label>
            <input type="text" name="typeImage" id="typeImage" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="doKho">Độ Khó:</label>
            <input type="number" name="doKho" id="doKho" class="form-control" min="1" max="5" required>
        </div>

        <div class="form-group mb-3">
            <label for="monhoc_id">Môn Học:</label>
            <select name="monhoc_id" id="monhoc_id" class="form-control" required>
                <option value="" disabled selected>-- Chọn môn học --</option>
                @foreach($monhocs as $monhoc)
                    <option value="{{ $monhoc->id }}">{{ $monhoc->tenMonHoc }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Câu Hỏi</button>
    </form>
</div>
@endsection
