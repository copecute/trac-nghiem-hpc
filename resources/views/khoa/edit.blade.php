@extends('layouts.app')

@section('title', 'Update Khoa')

@section('content')
    <h1>Update Khoa</h1>
    
    <!-- Hiển thị thông báo nếu có -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    
    <form action="{{ route('khoa.update', $khoa->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="maKhoa">Mã Khoa:</label>
        <input type="text" id="maKhoa" name="maKhoa" value="{{ $khoa->maKhoa }}" required>
        
        <br><br>
        
        <label for="tenKhoa">Tên Khoa:</label>
        <input type="text" id="tenKhoa" name="tenKhoa" value="{{ $khoa->tenKhoa }}" required>
        
        <br><br>
        
        <button type="submit">Update</button>
    </form>
    
    <a href="{{ route('khoa.index') }}">Back to list</a>
@endsection