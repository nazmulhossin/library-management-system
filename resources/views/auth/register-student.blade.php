@extends('layouts/auth')
@section('title') Student Registration @endsection
@section('form_container')
    <div class="form-container">
        <div class="header">
            <div>
                <h2>Student Registration</h2>
                <p>Fill out the form carefully for registration</p>
            </div>
            <img src="{{asset('assets/img/full-logo.png')}}" alt="logo">
        </div>

        <form method="POST" action="{{ route('register-student') }}" enctype="multipart/form-data">
            @csrf
            <!-- Full Name -->
            <div>
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Full Name" value="{{ old('name') }}" required>
            </div>
            
            <div class="first group-inputs">
                <!-- Roll Number -->
                <div>
                    <label for="roll_number">Roll Number</label>
                    <input type="text" id="roll_number" name="roll_number" placeholder="Enter Roll Number" value="{{ old('roll_number') }}" required>
                </div>

                <!-- Session -->
                <div>
                    <label for="session">Session</label>
                    <select id="session" name="session" value="{{ old('session') }}" required>
                        <option value="">Select Session</option>

                        {{$curr_year = date('Y')}}
                        @for ($year = $curr_year; $year >= $curr_year - 10; $year--)
                            <option value="{{ ($year - 1) . '-' . $year }}">{{ ($year - 1) . ' - ' . $year }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="second group-inputs">
                <!-- Email -->
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="m@example.com" value="{{ old('email') }}" required>
                </div>
                
                <!-- Phone Number -->
                <div>
                    <label for="phone_number">Phone Number</label>
                    <div>
                        <span class="country-code">+880</span>
                        <input type="tel" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" required/>
                    </div>
                </div>
            </div>
            
            <div class="third group-inputs">
                <!-- Password -->
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="At least 8 characters" required>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Retype Password" required>
                </div>
            </div>

            <!-- Profile Image -->
            <div>
                <label for="profile-pic">Upload Profile Picture (Max. Size: 2MB)</label>
                <input class="form-file" type="file" id="photo" name="photo" accept=".jpg,.png,.jpeg" required>
            </div>

            <!-- Display Error -->
            @if ($errors->any())
                <div class="error-msg">{{ $errors->all()[0] }}</div>
            @endif
            
            <!-- Register Button -->
            <div>
                <button type="submit" class="submit-btn">Register</button>
            </div>
        </form>

        <div class="additional-links">
            <p><a href="{{route('register-teacher')}}">Register as teacher</a></p>
            <p>Already have an account? <a href="{{route('login')}}">Login</a></p>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('auth/css/register.min.css')}}">
@endpush