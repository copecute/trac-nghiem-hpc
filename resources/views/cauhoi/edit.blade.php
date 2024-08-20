@extends('layouts.app')

@section('title', 'Sửa Câu Hỏi')

@section('content')
    <h1>Sửa Câu Hỏi</h1>

    <form action="{{ route('cauhoi.update', $cauHoi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="noiDung">Nội Dung:</label>
            <textarea name="noiDung" id="noiDung">{{ $cauHoi->noiDung }}</textarea>
        </div>

        <div>
            <label for="typeAudio">Loại Audio:</label>
            <input type="text" name="typeAudio" id="typeAudio" value="{{ $cauHoi->typeAudio }}">
        </div>

        <div>
            <label for="typeVideo">Loại Video:</label>
            <input type="text" name="typeVideo" id="typeVideo" value="{{ $cauHoi->typeVideo }}">
        </div>

        <div>
            <label for="typeImage">Loại Hình Ảnh:</label>
            <input type="text" name="typeImage" id="typeImage" value="{{ $cauHoi->typeImage }}">
        </div>

        <div>
            <label for="doKho">Độ Khó:</label>
            <input type="number" name="doKho" id="doKho" min="1" max="5" value="{{ $cauHoi->doKho }}">
        </div>

        <div>
            <label for="monhoc_id">Môn Học:</label>
            <select name="monhoc_id" id="monhoc_id" required>
                @foreach($monhocs as $monhoc)
                    <option value="{{ $monhoc->id }}" {{ $cauHoi->monhoc_id == $monhoc->id ? 'selected' : '' }}>
                        {{ $monhoc->tenMonHoc }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Cập nhật Câu Hỏi</button>
    </form>
@endsection
