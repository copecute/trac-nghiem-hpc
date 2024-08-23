<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/dashboard') }}">
            <i class="bi bi-grid-1x2-fill"></i> HPC
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/dashboard') }}">
                        <i class="bi bi-house-door-fill"></i> Home
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="khoaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-building"></i> Khoa
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="khoaDropdown">
                        <li><a class="dropdown-item" href="{{ route('khoa.index') }}">Danh sách Khoa</a></li>
                        <li><a class="dropdown-item" href="{{ route('khoa.create') }}">Thêm Khoa</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nganhDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-briefcase-fill"></i> Ngành
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="nganhDropdown">
                        <li><a class="dropdown-item" href="{{ route('nganh.index') }}">Danh sách Ngành</a></li>
                        <li><a class="dropdown-item" href="{{ route('nganh.create') }}">Thêm Ngành</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->taiKhoan }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#">Quyền: {{ Auth::user()->phanQuyenHienThi }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus-fill"></i> Register</a></li>
                @endauth
            </ul>            
        </div>
    </div>
</nav>
<div class="container mt-4">