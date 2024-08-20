@extends('layouts.app')

@section('title', 'Sửa Lớp')

@section('content')
    <h1>Sửa Lớp</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lop.update', $lop->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="maLop">Mã Lớp:</label>
            <input type="text" name="maLop" id="maLop" value="{{ $lop->maLop }}" required>
        </div>

        <div>
            <label for="tenLop">Tên Lớp:</label>
            <input type="text" name="tenLop" id="tenLop" value="{{ $lop->tenLop }}" required>
        </div>

        <div>
            <label for="nganh_id">Ngành:</label>
            <select name="nganh_id" id="nganh_id" required>
                @foreach($nganhs as $nganh)
                    <option value="{{ $nganh->id }}" {{ $nganh->id == $lop->nganh_id ? 'selected' : '' }}>
                        {{ $nganh->tenNganh }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Cập nhật Lớp</button>
    </form>
@endsection
