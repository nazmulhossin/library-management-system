@extends('layouts/auth')
@section('title') Email Verification @endsection
@section('form_container')
    <div class="form-container" style="width: 40vw">
        <div class="header">
            <h2>Verify Your Email</h2>
            <img src="{{asset('assets/img/full-logo.png')}}" alt="logo">
        </div>

        <p class="email-verification-msg">
            A verification link has been sent to your registered email address. Please check your inbox (and spam folder if necessary) and follow the instructions to verify your email. If you do not receive the email within a few minutes, please try again or contact support for assistance.
            {{ $email }}
        </p>

        <div class="additional-links">
            <p><a href="{{ route('resend-verification-email', ['email'=>$email]) }}">Send Again</a></p> <p><a href="{{ route('register-student') }}">Register</a></p>
        </div>
    </div>
@endsection