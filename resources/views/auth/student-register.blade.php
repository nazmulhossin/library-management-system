@extends('layouts/auth')
@section('title') Student Registration @endsection
@section('form_container')
    <div class="form-container">
        <div class="header">
            <div>
                <h2>Student Registration</h2>
                <p>Fill out the form carefully for registration</p>
            </div>
            <img src="{{asset('assets/images/system/full-logo.png')}}" alt="logo">
        </div>

        <form>
            <!-- Full Name -->
            <div>
                <label for="first-name">Full Name</label>
                <input type="text" placeholder="Enter Full Name" required>
            </div>
            
            <div class="first group-inputs">
                <!-- Roll Number -->
                <div>
                    <label for="roll-number">Roll Number</label>
                    <input type="text" placeholder="Enter Roll Number" required>
                </div>

                <!-- Session -->
                <div>
                    <label for="session">Session</label>
                    <select name="session" required>
                        <option value="">Select Session</option>

                        {{$curr_year = date('Y')}}
                        @for ($year = $curr_year; $year >= $curr_year - 10; $year--)
                            <option value="{{ ($year - 1) . ' - ' . $year }}">{{ ($year - 1) . ' - ' . $year }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="second group-inputs">
                <!-- Email -->
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="m@example.com" required>
                </div>
                
                <!-- Phone Number -->
                <div>
                    <label for="phone">Phone Number</label>
                    <div>
                        <span class="country-code">+880</span>
                        <input type="tel" name="phone" placeholder="Phone Number" />
                    </div>
                </div>
            </div>
            
            <div class="third group-inputs">
                <!-- Password -->
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="At least 8 characters" required>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password">Confirm Password</label>
                    <input type="password" id="confirm-password" placeholder="Retype Password" required>
                </div>
            </div>

            <!-- Profile Image -->
            <div>
                <label for="profile-pic">Upload Profile Picture</label>
                <input class="form-file" type="file" id="profile-pic" accept="image/*">
            </div>
            
            <!-- Register Button -->
            <div>
                <button type="submit" class="submit-btn">Register</button>
            </div>
        </form>

        <div class="additional-links">
            <p><a href="{{route('teacher-register')}}">Register as teacher</a></p>
            <p>Already have an account? <a href="{{route('login')}}">Login</a></p>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('css/register.min.css')}}">
@endpush