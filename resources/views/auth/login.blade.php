@extends('layouts/auth')
@section('title') Login @endsection
@section('form_container')
    <div class="form-container">
        <div class="header">
            <h2>Login</h2>
            <img src="{{asset('assets/images/system/full-logo.png')}}" alt="logo">
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
            <div>
                <button type="submit" class="submit-btn">Login</button>
            </div>
        </form>

        <div class="additional-links">
            <p>Don't have an account? <a href="{{route('register-student')}}">Register</a></p>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('css/login.min.css')}}">
@endpush