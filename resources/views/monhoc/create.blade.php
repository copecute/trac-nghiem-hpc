@extends('layouts.app')

@section('title', 'Thêm Môn Học')

@section('content')
    <h1>Thêm Môn Học</h1>

    <form action="{{ route('monhoc.store') }}" method="POST">
        @csrf

        <div>
            <label for="maMonHoc">Mã Môn Học:</label>
            <input type="text" name="maMonHoc" id="maMonHoc" required>
        </div>

        <div>
            <label for="tenMonHoc">Tên Môn Học:</label>
            <input type="text" name="tenMonHoc" id="tenMonHoc" required>
        </div>

        <div>
            <label for="nganh_id">Ngành:</label>
            <select name="nganh_id" id="nganh_id" required>
                @foreach($nganhs as $nganh)
                    <option value="{{ $nganh->id }}">{{ $nganh->tenNganh }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Thêm Môn Học</button>
    </form>
@endsection
