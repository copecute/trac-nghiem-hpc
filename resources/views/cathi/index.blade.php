@extends('layouts.app')

@section('title', 'Danh sách Ca Thi')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Danh sách Ca Thi</h1>
                <a href="{{ route('cathi.create', ['kythi_id' => $kythi_id]) }}" class="btn btn-primary">Thêm mới</a>
            </div>

            <!-- Lọc theo môn học -->
            <form action="{{ route('cathi.index', ['kythi_id' => $kythi_id]) }}" method="GET" class="mb-3">
                <div class="form-group">
                    <label for="monhoc_id">Lọc theo môn học:</label>
                    <select name="monhoc_id" id="monhoc_id" class="form-control">
                        <option value="">-- Chọn môn học --</option>
                        @foreach ($monhocs as $monhoc)
                            <option value="{{ $monhoc->id }}">{{ $monhoc->tenMonHoc }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-secondary mt-2">Lọc</button>
            </form>

            <!-- Thông báo -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Bảng danh sách Ca Thi -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tên Ca Thi</th>
                            <th>Môn Học</th>
                            <th>Thời Gian Bắt Đầu</th>
                            <th>Thời Gian Kết Thúc</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cathis as $cathi)
                            <tr>
                                <td>{{ $cathi->tenCa }}</td>
                                <td>{{ $cathi->monhoc->tenMonHoc }}</td>
                                <td>{{ $cathi->thoiGianBatDau }}</td>
                                <td>{{ $cathi->thoiGianKetThuc }}</td>
                                <td>
                                    <a href="{{ route('cathi.edit', ['kythi_id' => $kythi_id, 'id' => $cathi->id]) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('cathi.destroy', ['kythi_id' => $kythi_id, 'id' => $cathi->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
