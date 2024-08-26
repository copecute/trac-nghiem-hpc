@extends('layouts.app')

@section('title', 'Chi Tiết Ngành')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Chi Tiết Ngành</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Thông Tin Ngành</h5>
            <p class="card-text"><strong>Mã Ngành:</strong> {{ $nganh->maNganh }}</p>
            <p class="card-text"><strong>Tên Ngành:</strong> {{ $nganh->tenNganh }}</p>
            <p class="card-text"><strong>Khoa:</strong> {{ $nganh->khoa->tenKhoa }}</p>

            <a href="{{ route('nganh.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <a href="{{ route('nganh.edit', $nganh->id) }}" class="btn btn-warning">Chỉnh sửa</a>
        </div>
    </div>
</div>
@endsection
