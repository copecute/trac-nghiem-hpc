@extends('layouts.app')

@section('title', 'Kết Quả')

@section('content')
    <h1>Kết Quả</h1>
    <p><strong>Điểm số:</strong> {{ $ketQua->diemSo }}</p>
    <p><strong>Danh sách đáp án:</strong> {{ json_encode($ketQua->danhSachDapAn) }}</p>
@endsection