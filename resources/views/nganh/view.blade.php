@extends('layouts.app')

@section('title', 'Chi tiết ngành')

@section('content')
    <h1>Chi Tiết Ngành</h1>
    <p>Mã Ngành: {{ $nganh->maNganh }}</p>
    <p>Tên Ngành: {{ $nganh->tenNganh }}</p>
    <p>Khoa: {{ $nganh->khoa->tenKhoa }}</p>
    <a href="/nganh">Quay lại danh sách</a>
    <a href="/nganh/{{ $nganh->id }}/edit">Chỉnh sửa</a>
@endsection
