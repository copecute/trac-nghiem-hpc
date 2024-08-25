@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Dashboard</h1>
        <div class="row">
            @php
                $cards = [
                    ['route' => 'khoa.index', 'title' => 'Quản lý Khoa', 'description' => 'Quản lý các khoa của trường.'],
                    ['route' => 'nganh.index', 'title' => 'Quản lý Ngành', 'description' => 'Quản lý các ngành học của trường.'],
                    ['route' => 'lop.index', 'title' => 'Quản lý Lớp', 'description' => 'Quản lý các lớp học của trường.'],
                    ['route' => 'sinhvien.index', 'title' => 'Quản lý Sinh viên', 'description' => 'Quản lý thông tin sinh viên.'],
                    ['route' => 'monhoc.index', 'title' => 'Quản lý Môn học', 'description' => 'Quản lý các môn học của trường.'],
                    ['route' => 'cauhoi.index', 'title' => 'Quản lý Câu hỏi', 'description' => 'Quản lý các câu hỏi của đề thi.'],
                    // ['route' => 'dapan.index', 'title' => 'Quản lý Đáp án', 'description' => 'Quản lý đáp án cho các câu hỏi.'],
                    ['route' => 'kythi.index', 'title' => 'Quản lý Kỳ thi', 'description' => 'Quản lý các kỳ thi của trường.'],
                    // ['route' => 'cathi.index', 'title' => 'Quản lý Ca thi', 'description' => 'Quản lý các ca thi trong kỳ thi.'],
                    ['route' => 'dethi.index', 'title' => 'Quản lý Đề thi', 'description' => 'Quản lý các đề thi của kỳ thi.'],
                    ['route' => 'phongthi.index', 'title' => 'Quản lý Phòng thi', 'description' => 'Quản lý các phòng thi của trường.']
                ];
            @endphp

            @foreach($cards as $card)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card hover-card">
                        <a href="{{ route($card['route']) }}" class="card-link">
                            <div class="card-body">
                                <h5 class="card-title">{{ $card['title'] }}</h5>
                                <p class="card-text">{{ $card['description'] }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card-body {
            padding: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1rem;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
