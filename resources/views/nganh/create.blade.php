@extends('layouts.app')

@section('title', 'Thêm Ngành Mới')

@section('content')
    <h1>Thêm Ngành Mới</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('nganh.store') }}" method="POST">
        @csrf
        <label for="maNganh">Mã Ngành:</label>
        <input type="text" name="maNganh" id="maNganh" required>

        <label for="tenNganh">Tên Ngành:</label>
        <input type="text" name="tenNganh" id="tenNganh" required>

        <label for="khoa_id">Khoa:</label>
        <select name="khoa_id" id="khoa_id" required>
            @foreach($khoas as $khoa)
                <option value="{{ $khoa->id }}">{{ $khoa->tenKhoa }}</option>
            @endforeach
        </select>

        <button type="submit">Thêm</button>
    </form>

    <a href="{{ route('nganh.index') }}">Quay lại</a>
@endsection