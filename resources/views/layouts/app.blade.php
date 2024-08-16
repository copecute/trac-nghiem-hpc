<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trắc Nghiệm HPC')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('layouts.header')

    <div class="container">
        @yield('content')
    </div>

    @include('layouts.footer')

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
