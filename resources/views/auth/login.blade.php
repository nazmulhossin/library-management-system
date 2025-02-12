@extends('layouts/auth')
@section('title') Login @endsection
@section('form_container')
    <div class="form-container">
        <div class="header">
            <h2>Login</h2>
            <img src="{{asset('assets/img/full-logo.png')}}" alt="logo">
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email -->
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="m@example.com" value="{{ old('email') }}" required>
            </div>
            
            <!-- Password -->
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            
            <!-- Display Error -->
            @if (session('error'))
                <div class="error-msg">{{ session('error') }}</div>
            @endif

            <!-- Login Button -->
            <div style="margin-top: 25px;">
                <button type="submit" class="submit-btn">Login</button>
            </div>
        </form>

        <div class="additional-links">
            <p><a href="{{ route('forgot-password') }}">Forgot Password?</a></p> <p>Don't have an account? <a href="{{ route('register-student') }}">Register</a></p>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('auth/css/login.min.css')}}">
@endpush