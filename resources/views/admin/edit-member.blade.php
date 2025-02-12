@extends('layouts/admin')
@section('title') Edit Member @endsection
@section('main_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">Edit Member</h1>

        <div class="form-container mb-4">    
            <form method="POST" action="{{ route('admin/update-member', $member->user_id) }}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Full Name -->
                <div>
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter Full Name" value="{{ $member->name }}" required>
                </div>
                
                @if ($member->user_type === 'Student')
                    <div class="first group-inputs">
                        <!-- Roll Number -->
                        <div>
                            <label for="reg_number">Roll Number</label>
                            <input type="text" id="reg_number" name="reg_number" placeholder="Enter Roll Number" value="{{ $member->registration_number }}" required>
                        </div>
                        
                        <!-- Session -->
                        <div>
                            <label for="session">Session</label>
                            <select id="session" name="session" value="{{ old('session') }}" required>
                                <option value="">Select Session</option>
        
                                {{$curr_year = date('Y')}}
                                @for ($year = $curr_year; $year >= $curr_year - 10; $year--)
                                    <option value="{{ ($year - 1) . '-' . $year }}" 
                                        {{ old('session', $member->session) == ($year - 1) . '-' . $year ? 'selected' : '' }}>
                                        {{ ($year - 1) . ' - ' . $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                @else
                    
                    <div class="first group-inputs">
                        <!-- Title -->
                        <div>
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" placeholder="i.e., Professor" value="{{ $member->title }}" required>
                        </div>
        
                        <!-- Teacher ID -->
                        <div>
                            <label for="reg_number">Teacher ID</label>
                            <input type="text" id="reg_number" name="reg_number" placeholder="Enter your teacher ID" value="{{ $member->registration_number }}" required>
                        </div>
                    </div>
                @endif

                <div class="second group-inputs">
                    <!-- Email -->
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="m@example.com" value="{{ $member->email }}" required>
                    </div>
                    
                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number">Phone Number</label>
                        <div>
                            <span class="country-code">+880</span>
                            <input type="tel" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{ substr($member->phone_number, 1) }}" required/>
                        </div>
                    </div>
                </div>
    
                <!-- Profile Image -->
                <div>
                    <label for="profile-pic">Change Profile Picture (Max. Size: 2MB)</label>
                    <p><img src="{{ asset('storage/' . $member->image) }}" alt="Cover" width="100"></p>
                    <input class="form-file" type="file" id="photo" name="photo" accept=".jpg,.png,.jpeg">
                </div>
    
                <!-- Display Error -->
                @if ($errors->any())
                    <div class="error-msg">{{ $errors->all()[0] }}</div>
                @endif
                
                <div class="submit-btn-container">
                    <a class="btn btn-outline-danger" href="{{ route('admin/member-list') }}">Cancel</a> <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('admin-dashboard/css/edit-member.min.css')}}">
@endpush