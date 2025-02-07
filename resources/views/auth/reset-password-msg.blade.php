@extends('layouts/auth')
@section('title') Password Reset Message @endsection
@section('form_container')
    <div class="form-container" style="width: 40vw">
        <div class="header">
            <h2>Password Reset Message</h2>
            <img src="{{asset('assets/img/full-logo.png')}}" alt="logo">
        </div>

        <p class="password-reset-msg">
            A password reset link has been sent to your registered email address. Please check your inbox (and spam folder if necessary) and follow the instructions to reset your password. If you do not receive the email within a few minutes, please try again or contact support for assistance.
        </p>

        <div class="additional-links">
            <p><a href="{{ route('forgot-password') }}">Send Again</a></p> <p><a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
@endsection