<!-- resources/views/lop/create.blade.php -->
@extends('layouts.app')

@section('title', 'Thêm Lớp Mới')

@section('content')
    <h1>Thêm Lớp Mới</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lop.store') }}" method="POST">
        @csrf
        <div>
            <label for="maLop">Mã Lớp:</label>
            <input type="text" name="maLop" id="maLop" required>
        </div>

        <div>
            <label for="tenLop">Tên Lớp:</label>
            <input type="text" name="tenLop" id="tenLop" required>
        </div>

        <div>
            <label for="nghanh_id">Ngành:</label>
            <select name="nghanh_id" id="nghanh_id" required>
                @foreach($nghanhs as $nghanh)
                    <option value="{{ $nghanh->id }}">{{ $nghanh->tenNghanh }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Thêm Lớp</button>
    </form>
@endsection
