@extends('layouts.app')

@section('title', 'Thêm Ca Thi')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Thêm Ca Thi</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('cathi.store', ['kythi_id' => $kythi_id]) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="tenCa">Tên Ca Thi:</label>
                            <input type="text" class="form-control" name="tenCa" id="tenCa" required>
                        </div>

                        <div class="form-group">
                            <label for="thoiGianBatDau">Thời Gian Bắt Đầu:</label>
                            <input type="datetime-local" class="form-control" name="thoiGianBatDau" id="thoiGianBatDau" required>
                        </div>

                        <div class="form-group">
                            <label for="thoiGianKetThuc">Thời Gian Kết Thúc:</label>
                            <input type="datetime-local" class="form-control" name="thoiGianKetThuc" id="thoiGianKetThuc" required>
                        </div>

                        <div class="form-group">
                            <label for="monhoc_id">Môn Học:</label>
                            <select name="monhoc_id" id="monhoc_id" class="form-control" required>
                                @foreach ($monhocs as $monhoc)
                                    <option value="{{ $monhoc->id }}">{{ $monhoc->tenMonHoc }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Thêm</button>
                        <a href="{{ route('cathi.index', ['kythi_id' => $kythi_id]) }}" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
