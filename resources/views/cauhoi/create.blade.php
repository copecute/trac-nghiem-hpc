@extends('layouts.app')

@section('title', 'Thêm Câu Hỏi')

@section('content')
    <h1>Thêm Câu Hỏi</h1>

    <form action="{{ route('cauhoi.store') }}" method="POST">
        @csrf

        <div>
            <label for="noiDung">Nội Dung:</label>
            <textarea name="noiDung" id="noiDung"></textarea>
        </div>

        <div>
            <label for="typeAudio">Loại Audio:</label>
            <input type="text" name="typeAudio" id="typeAudio">
        </div>

        <div>
            <label for="typeVideo">Loại Video:</label>
            <input type="text" name="typeVideo" id="typeVideo">
        </div>

        <div>
            <label for="typeImage">Loại Hình Ảnh:</label>
            <input type="text" name="typeImage" id="typeImage">
        </div>

        <div>
            <label for="doKho">Độ Khó:</label>
            <input type="number" name="doKho" id="doKho" min="1" max="5">
        </div>

        <div>
            <label for="monhoc_id">Môn Học:</label>
            <select name="monhoc_id" id="monhoc_id" required>
                @foreach($monhocs as $monhoc)
                    <option value="{{ $monhoc->id }}">{{ $monhoc->tenMonHoc }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Thêm Câu Hỏi</button>
    </form>
@endsection