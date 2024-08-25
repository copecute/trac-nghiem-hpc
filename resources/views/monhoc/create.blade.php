@extends('layouts.app')

@section('title', 'Thêm Môn Học')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Môn Học</h1>

    <!-- Hiển thị lỗi nếu có -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('monhoc.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="maMonHoc" class="form-label">Mã Môn Học:</label>
            <input type="text" name="maMonHoc" id="maMonHoc" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tenMonHoc" class="form-label">Tên Môn Học:</label>
            <input type="text" name="tenMonHoc" id="tenMonHoc" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nganh_id" class="form-label">Ngành:</label>
            <select name="nganh_id" id="nganh_id" class="form-select" required>
                @foreach($nganhs as $nganh)
                    <option value="{{ $nganh->id }}">{{ $nganh->tenNganh }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Môn Học</button>
    </form>
</div>
@endsection
