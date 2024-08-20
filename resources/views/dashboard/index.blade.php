@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
        <h1 class="text-center">Dashboard</h1>
        <div class="list-group mt-4">
            <a href="{{ route('khoa.index') }}" class="list-group-item list-group-item-action">Quản lý Khoa</a>
            <a href="{{ route('nganh.index') }}" class="list-group-item list-group-item-action">Quản lý Ngành</a>
            <a href="{{ route('lop.index') }}" class="list-group-item list-group-item-action">Quản lý Lớp</a>
            <a href="{{ route('sinhvien.index') }}" class="list-group-item list-group-item-action">Quản lý Sinh viên</a>
            <a href="{{ route('monhoc.index') }}" class="list-group-item list-group-item-action">Quản lý Môn học</a>
            <a href="{{ route('cauhoi.index') }}" class="list-group-item list-group-item-action">Quản lý Câu hỏi</a>
            <a href="{{ route('dapan.index', ['cauHoiId' => 1]) }}" class="list-group-item list-group-item-action">Quản lý Đáp án</a>
            <a href="{{ route('kythi.index') }}" class="list-group-item list-group-item-action">Quản lý Kỳ thi</a>
            <a href="{{ route('cathi.index', ['kythi_id' => 1]) }}" class="list-group-item list-group-item-action">Quản lý Ca thi</a>
            <a href="{{ route('dethi.index') }}" class="list-group-item list-group-item-action">Quản lý Đề thi</a>
            <a href="{{ route('phongthi.index') }}" class="list-group-item list-group-item-action">Quản lý Phòng thi</a>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
