<!-- resources/views/monhoc/create.blade.php -->
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
            <label for="nghanh_id">Ngành:</label>
            <select name="nghanh_id" id="nghanh_id" required>
                @foreach($nghanhs as $nghanh)
                    <option value="{{ $nghanh->id }}">{{ $nghanh->tenNghanh }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Thêm Môn Học</button>
    </form>
@endsection
