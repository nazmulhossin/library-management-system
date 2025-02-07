@extends('layouts/admin')
@section('title') Assign Book Manually @endsection
@section('main_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">Assign Book Manually</h1>

        <div class="form-container mb-4">    
            <form id="assignBookForm" style="padding: 0">
                @csrf
                <div class="group-inputs">
                    <!-- Book ID -->
                    <div>
                        <label for="book_id">Book ID <span>*</span></label>
                        <input type="text" id="book_id" name="book_id" placeholder="Enter Book ID" value="{{ old('book_id') }}" required>
                    </div>

                    <!-- Book ID -->
                    <div>
                        <label for="reg_no">Member's Reg. No: <span>*</span></label>
                        <input type="text" id="reg_no" name="reg_no" placeholder="Enter Member's Reg. No" value="{{ old('reg_no') }}" required>
                    </div>
                </div>
    
                <!-- Display Error -->
                <div id="error-msg" class="error-msg" style="display: none;"></div>
                
                <!-- Register Button -->
                <div class="submit-btn-container">
                    <button type="submit" class="btn btn-success">Check</button>
                </div>
            </form>
        </div>

        <!-- Display Book & User Info -->
        <div id="info-container" class="mb-4 info-container" style="display: none;">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Book's Image</th>
                        <th>Book's Info</th>
                        <th>User's Image</th>
                        <th>User's Info</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="table-col-center"><img id="book-cover" src="" alt="Book Cover"/></div></td>
                        <td><strong>Book ID:</strong> <span id="book-id"></span> <br> <strong>Book Title:</strong> <span id="book-title"></span> <br> <strong>Book Author:</strong> <span id="book-author"></span> <br> <strong>Available Copies:</strong> <span id="book-copies"></span></td>
                        <td><div class="table-col-center"><img id="user-image" src="" alt="User Image" /></div></td>
                        <td><strong>Name:</strong> <span id="user-name"></span> <br> <strong>Reg No:</strong> <span id="user-regno"></span></td>
                        <td>
                            <form action="" method="POST" id="confirm-form">
                                @csrf
                                <div class="d-flex align-items-center">
                                    <label for="days" class="me-2">Days: </label>
                                    <input type="number" name="days" min="1" value="7" required class="form-control me-2" style="width: 80px;">
                                    <button type="submit" class="btn btn-success" id="assignBook">Confirm</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
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
    <link rel="stylesheet" href="{{asset('admin-dashboard/css/add-book.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-dashboard/css/assign-book.min.css')}}">
@endpush