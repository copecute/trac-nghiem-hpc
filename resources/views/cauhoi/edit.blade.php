@extends('layouts.app')

@section('title', 'Sửa Câu Hỏi')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Sửa Câu Hỏi</h1>

    <form action="{{ route('cauhoi.update', $cauHoi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="noiDung">Nội Dung:</label>
            <textarea name="noiDung" id="noiDung" class="form-control" rows="4" required>{{ $cauHoi->noiDung }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="typeAudio">Loại Audio:</label>
            <input type="text" name="typeAudio" id="typeAudio" class="form-control" value="{{ $cauHoi->typeAudio }}">
        </div>

        <div class="form-group mb-3">
            <label for="typeVideo">Loại Video:</label>
            <input type="text" name="typeVideo" id="typeVideo" class="form-control" value="{{ $cauHoi->typeVideo }}">
        </div>

        <div class="form-group mb-3">
            <label for="typeImage">Loại Hình Ảnh:</label>
            <input type="text" name="typeImage" id="typeImage" class="form-control" value="{{ $cauHoi->typeImage }}">
        </div>

        <div class="form-group mb-3">
            <label for="doKho">Độ Khó:</label>
            <input type="number" name="doKho" id="doKho" class="form-control" min="1" max="5" value="{{ $cauHoi->doKho }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="monhoc_id">Môn Học:</label>
            <select name="monhoc_id" id="monhoc_id" class="form-control" required>
                @foreach($monhocs as $monhoc)
                    <option value="{{ $monhoc->id }}" {{ $cauHoi->monhoc_id == $monhoc->id ? 'selected' : '' }}>
                        {{ $monhoc->tenMonHoc }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật Câu Hỏi</button>
    </form>
</div>
@endsection
