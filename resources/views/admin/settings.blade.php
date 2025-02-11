@extends('layouts/admin')
@section('title') Settings @endsection
@section('main_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">Settings</h1>

        <h3>Change Password</h3>
        <hr>
        <div class="change-password">
            <form id="change-password-form">
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

                <!-- Display Messages -->
                <div id="error-msg" class="error-msg"></div>
                <div id="success-msg" class="success-msg"></div>
                
                <div>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('admin-dashboard/css/settings.min.css')}}">
@endpush