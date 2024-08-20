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
            <label for="nganh_id">Ngành:</label>
            <select name="nganh_id" id="nganh_id" required>
                @foreach($nganhs as $nganh)
                    <option value="{{ $nganh->id }}">{{ $nganh->tenNganh }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Thêm Lớp</button>
    </form>
@endsection
