@extends('layouts/auth')
@section('title') Reset Password @endsection
@section('form_container')
    <div class="form-container">
        <div class="header">
            <h2>Reset Password</h2>
            <img src="{{asset('assets/img/full-logo.png')}}" alt="logo">
        </div>

        <form action="{{ route('update-password') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">        
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Retype Password" required>
            </div>

            <!-- Display Error -->
            @if (session('error'))
                <div class="error-msg">{{ session('error') }}</div>
            @endif

            <!-- Login Button -->
            <div>
                <button type="submit" class="submit-btn">Reset Password</button>
            </div>
        </form>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('auth/css/login.min.css')}}">
@endpush