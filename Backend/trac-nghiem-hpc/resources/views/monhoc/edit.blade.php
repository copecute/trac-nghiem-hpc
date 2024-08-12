<!-- resources/views/monhoc/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Sửa Môn Học')

@section('content')
    <h1>Sửa Môn Học</h1>

    <form action="{{ route('monhoc.update', $monHoc->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="maMonHoc">Mã Môn Học:</label>
            <input type="text" name="maMonHoc" id="maMonHoc" value="{{ $monHoc->maMonHoc }}" required>
        </div>

        <div>
            <label for="tenMonHoc">Tên Môn Học:</label>
            <input type="text" name="tenMonHoc" id="tenMonHoc" value="{{ $monHoc->tenMonHoc }}" required>
        </div>

        <div>
            <label for="nghanh_id">Ngành:</label>
            <select name="nghanh_id" id="nghanh_id" required>
                @foreach($nghanhs as $nghanh)
                    <option value="{{ $nghanh->id }}" {{ $monHoc->nghanh_id == $nghanh->id ? 'selected' : '' }}>
                        {{ $nghanh->tenNghanh }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Cập nhật Môn Học</button>
    </form>
@endsection
