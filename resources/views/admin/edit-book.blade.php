@extends('layouts/admin')
@section('title') Edit List @endsection
@section('main_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">Edit Book</h1>

        <div class="form-container mb-4">    
            <form method="POST" action="{{ route('admin/update-book', $book->book_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Book Title -->
                <div>
                    <label for="title">Book Title <span>*</span></label>
                    <input type="text" id="title" name="title" placeholder="Enter book title" value="{{ $book->title }}" required>
                </div>

                <!-- Book Description -->
                <div>
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Enter book description">{{ $book->description }}</textarea>
                </div>

                <div class="group-inputs">
                    <!-- Author -->
                    <div>
                        <label for="author">Author <span>*</span></label>
                        <input type="text" id="author" name="author" placeholder="Enter author name" value="{{ $book->author }}" required>
                    </div>
    
                    <!-- Publisher -->
                    <div>
                        <label for="publisher">Publisher</label>
                        <input type="text" id="publisher" name="publisher" placeholder="Enter publisher name" value="{{ $book->publisher }}">
                    </div>

                    <!-- Publication Date -->
                    <div class="mb-3">
                        <label for="publication_date" class="form-label">Publication Date</label>
                        <input type="date" id="publication_date" name="publication_date" placeholder="Enter publication date"  value="{{ $book->publication_date }}">
                    </div>

                    <!-- Edition -->
                    <div>
                        <label for="edition">Edition</label>
                        <input type="text" id="edition" name="edition" placeholder="Enter edition" value="{{ $book->edition }}">
                    </div>
                </div>

                <div class="group-inputs">
                    <!-- ISBN -->
                    <div>
                        <label for="isbn">ISBN</label>
                        <input type="text" id="isbn" name="isbn" placeholder="Enter ISBN number" value="{{ $book->isbn }}">
                    </div>

                    <!-- Pages -->
                    <div>
                        <label for="pages">Pages</label>
                        <input type="number" id="pages" name="pages" placeholder="Enter the number of pages" value="{{ $book->pages }}">
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category">Category <span>*</span></label>
                        <select id="category" name="category" required>
                            <option value="" disabled>Select a category</option>
                            <option value="CSE" {{ old('category', $book->category) == 'CSE' ? 'selected' : '' }}>CSE</option>
                            <option value="EEE" {{ old('category', $book->category) == 'EEE' ? 'selected' : '' }}>EEE</option>
                            <option value="Mathematics" {{ old('category', $book->category) == 'Mathematics' ? 'selected' : '' }}>Mathematics</option>
                            <option value="Programming" {{ old('category', $book->category) == 'Programming' ? 'selected' : '' }}>Programming</option>
                            <option value="Web Engineering" {{ old('category', $book->category) == 'Web Engineering' ? 'selected' : '' }}>Web Engineering</option>
                            <option value="Database" {{ old('category', $book->category) == 'Database' ? 'selected' : '' }}>Database</option>
                            <option value="Machine Learning" {{ old('category', $book->category) == 'Machine Learning' ? 'selected' : '' }}>Machine Learning</option>
                            <option value="Cyber Security" {{ old('category', $book->category) == 'Cyber Security' ? 'selected' : '' }}>Cyber Security</option>
                            <option value="Others" {{ old('category', $book->category) == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                    </div>         

                    <!-- Total Copies -->
                    <div>
                        <label for="total_copies">Total Copies <span>*</span></label>
                        <input type="number" id="total_copies" name="total_copies" placeholder="Enter the total number of copies" value="{{ $book->total_copies }}" required>
                    </div>
                </div>
    
                <!-- Book cover Image -->
                <div>
                    <label for="cover_image">Change Cover Image</label>
                    <p><img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" width="100"></p>
                    <input type="file" id="cover_image" name="cover_image" accept=".jpg,.png,.jpeg">
                </div>
    
                <!-- Display Error -->
                @if ($errors->any())
                    <div class="error-msg">{{ $errors->all()[0] }}</div>
                @endif
                
                <div class="submit-btn-container">
                    <a class="btn btn-outline-danger" href="{{ route('admin/book-list') }}">Cancel</a> <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('admin-dashboard/css/add-book.min.css')}}">
@endpush