@extends('layouts.app')

@section('title', 'Kết Quả')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Kết Quả</h1>

    <div class="card">
        <div class="card-header">
            Thông Tin Kết Quả
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Điểm số:</strong> {{ $ketQua->diemSo }}</p>
            <p class="card-text"><strong>Danh sách đáp án:</strong></p>
            <ul>
                @foreach(json_decode($ketQua->danhSachDapAn) as $dapAn)
                    <li>{{ $dapAn }}</li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
@endsection
