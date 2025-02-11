@extends('layouts/user')
@section('main_content')
    <div class="user-section">
        @include('partials/user-sidebar')
    
        <section class="user-section-right">
            <h2 class="page-heading">Personal Information</h2>

            <div class="personal-info">
                <form>
                    <!-- Full Name -->
                    <div>
                        <label for="name">Full Name</label>
                        <input type="text" id="name" value="{{ session('user')->name }}" disabled>
                    </div>

                    <!-- Roll Number -->
                    <div>
                        @if (session('user')->user_type == 'Student')
                            <label for="roll_number">Roll Number</label>
                        @elseif (session('user')->user_type == 'Teacher')
                            <label for="roll_number">Teacher ID</label>
                        @endif
                        
                        <input type="text" id="roll_number" value="{{ session('user')->registration_number }}" disabled>
                    </div>

                    <!-- Session -->
                    @if (session('user')->user_type == 'Student')
                        <div>
                            <label for="Session">Session</label>
                            <input type="text" id="Session" value="{{ session('user')->session }}" disabled>
                        </div>
                    @endif
        
                    <!-- Email -->
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" value="{{ session('user')->email }}" disabled>
                    </div>
                    
                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number">Phone Number</label>
                        <input type="tel" id="phone_number" value="{{ session('user')->phone_number }}" disabled/>
                    </div>

                    <!-- Profile Image -->
                    <div>
                        <label for="profile-pic">Profile Picture</label>
                        <img src="{{ asset('storage/' . session('user')->image) }}" alt="{{ session('user')->name }}">
                    </div>
                    
                    
                </form>
            </div>

            <h2 class="page-heading">Change Password</h2>

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
                        <button type="submit" class="submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('style')
    <link href="{{ asset('user/css/user-section.min.css') }}" rel="stylesheet">
@endpush