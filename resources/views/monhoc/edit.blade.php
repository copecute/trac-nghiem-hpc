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
            <label for="nganh_id">Ngành:</label>
            <select name="nganh_id" id="nganh_id" required>
                @foreach($nganhs as $nganh)
                    <option value="{{ $nganh->id }}" {{ $monHoc->nganh_id == $nganh->id ? 'selected' : '' }}>
                        {{ $nganh->tenNganh }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Cập nhật Môn Học</button>
    </form>
@endsection
