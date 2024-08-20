@extends('layouts.app')

@section('title', 'Sửa Ngành')

@section('content')
    <h1>Sửa Ngành</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('nganh.update', $nganh->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="maNganh">Mã Ngành:</label>
        <input type="text" name="maNganh" id="maNganh" value="{{ $nganh->maNganh }}" required>

        <label for="tenNganh">Tên Ngành:</label>
        <input type="text" name="tenNganh" id="tenNganh" value="{{ $nganh->tenNganh }}" required>

        <label for="khoa_id">Khoa:</label>
        <select name="khoa_id" id="khoa_id" required>
            @foreach($khoas as $khoa)
                <option value="{{ $khoa->id }}" {{ $khoa->id == $nganh->khoa_id ? 'selected' : '' }}>
                    {{ $khoa->tenKhoa }}
                </option>
            @endforeach
        </select>

        <button type="submit">Cập Nhật</button>
    </form>

    <a href="{{ route('nganh.index') }}">Quay lại</a>
@endsection