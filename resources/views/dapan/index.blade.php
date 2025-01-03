@extends('layouts.app')

@section('title', 'Danh sách Đáp Án')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh sách Đáp Án của Câu Hỏi: <strong>{{ $cauHoi->noiDung }}</strong></h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('dapan.create', $cauHoi->id) }}" class="btn btn-primary mb-3">Thêm Đáp Án</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Text</th>
                <th>Audio</th>
                <th>Hình Ảnh</th>
                <th>Đáp Án Đúng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dapAns as $dapAn)
                <tr>
                    <td>{{ $dapAn->id }}</td>
                    <td>{{ $dapAn->typeText }}</td>
                    <td>{{ $dapAn->typeAudio }}</td>
                    <td>{{ $dapAn->typeImage }}</td>
                    <td>{{ $dapAn->dapAnDung ? 'Đúng' : 'Sai' }}</td>
                    <td>
                        <a href="{{ route('dapan.edit', [$cauHoi->id, $dapAn->id]) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('dapan.destroy', [$cauHoi->id, $dapAn->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');" style="display:inline;">
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
@endsection
