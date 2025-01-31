@extends('layouts/admin')
@section('title') Settings @endsection
@section('main_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">Settings</h1>

        <h3>Change Password</h3>
        <hr>
        <div class="change-password">
            <form method="POST" action="{{ route('admin/change-password') }}">
                @csrf
                <!-- Old Password -->
                <div>
                    <label for="password">Old password</label>
                    <input type="password" id="old_password" name="old_password" placeholder="At least 8 characters" required>
                </div>

                <!-- New Password -->
                <div>
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" placeholder="At least 8 characters" required>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="new_password_confirmation">Confirm Password</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Retype Password" required>
                </div>

                <!-- Display Error -->
                @if ($errors->any())
                    <div class="error-msg">{{ $errors->all()[0] }}</div>
                @endif

                @if (session('success'))
                    <div class="success-msg">{{ session('success') }}</div>
                @endif
                
                <!-- Register Button -->
                <div>
                    <button type="submit" class="submit-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('admin-dashboard/css/settings.min.css')}}">
@endpush