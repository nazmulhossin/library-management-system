@extends('layouts/auth')
@section('title') Password Reset @endsection
@section('form_container')
    <div class="form-container">
        <div class="header">
            <h2>Password Reset</h2>
            <img src="{{asset('assets/img/full-logo.png')}}" alt="logo">
        </div>

        <form action="{{ route('send-reset-link') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="m@example.com" value="{{ old('email') }}" required>
            </div>

            @if (session('error'))
                <div class="error-msg">{{ session('error') }}</div>
            @endif

            <div>
                <button type="submit" class="submit-btn">Send Reset Link</button>
            </div>
        </form>

        <div class="additional-links">
            <p><a href="{{ route('login') }}">Login</a></p> <p>Don't have an account? <a href="{{ route('register-student') }}">Register</a></p>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('auth/css/login.min.css')}}">
@endpush