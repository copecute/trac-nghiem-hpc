@extends('layouts.app')

@section('title', 'Sửa Môn Học')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Sửa Môn Học</h1>

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

    <form action="{{ route('monhoc.update', $monHoc->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="maMonHoc" class="form-label">Mã Môn Học:</label>
            <input type="text" name="maMonHoc" id="maMonHoc" class="form-control" value="{{ old('maMonHoc', $monHoc->maMonHoc) }}" required>
        </div>

        <div class="mb-3">
            <label for="tenMonHoc" class="form-label">Tên Môn Học:</label>
            <input type="text" name="tenMonHoc" id="tenMonHoc" class="form-control" value="{{ old('tenMonHoc', $monHoc->tenMonHoc) }}" required>
        </div>

        <div class="mb-3">
            <label for="nganh_id" class="form-label">Ngành:</label>
            <select name="nganh_id" id="nganh_id" class="form-select" required>
                @foreach($nganhs as $nganh)
                    <option value="{{ $nganh->id }}" {{ old('nganh_id', $monHoc->nganh_id) == $nganh->id ? 'selected' : '' }}>
                        {{ $nganh->tenNganh }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật Môn Học</button>
    </form>
</div>
@endsection
