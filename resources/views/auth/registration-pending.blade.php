@extends('layouts/auth')
@section('title') Login @endsection
@section('form_container')
    <div class="form-container">
        <div class="header">
            <h2>Registration Pending</h2>
            <img src="{{asset('assets/images/system/full-logo.png')}}" alt="logo">
        </div>

        <form>
            <div>
                Dear [User's Name], <br><br>
                Thank you for registering. Your account has been successfully created, but it is currently pending approval. 
                Please visit the library authority to verify your details and complete the account activation process. 
                Once your account is verified, you'll be able to access all library services. <br><br>
                If you have any questions or concerns, please contact our support team at [Insert Contact Information].
            </div>
        </form>

        <div class="additional-links">
            <p>Already approved? <a href="{{route('login')}}">Login</a></p>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('css/registration-pending.min.css')}}">
@endpush

