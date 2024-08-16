<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="taiKhoan">Tài khoản:</label>
        <input type="text" name="taiKhoan" required>
        <br>
        <label for="matKhau">Mật khẩu:</label>
        <input type="password" name="matKhau" required>
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
