@extends('layouts/admin')
@section('title') Book List @endsection
@section('main_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">Book List</h1>

        <div class="mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Image</th>
                            <th>Book's Info</th>
                            <th>Available Copies</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Book ID</th>
                            <th>Image</th>
                            <th>Book's Info</th>
                            <th>Available Copies</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->book_id }}</td>
                                <td><div class="table-col-center"><img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" /></div></td>
                                <td>
                                    <div style="width: 25vw">
                                        <strong>Title:</strong> {{ $book->title }} <br>
                                        <strong>Author:</strong> {{ $book->author }} <br>
                                        <strong>Publisher:</strong> {{ $book->publisher }} <br>
                                        <strong>Edition:</strong> {{ $book->edition }} <br>
                                        <strong>ISBN:</strong> {{$book->isbn }} <br>
                                        <strong>Description:</strong> {{ Str::limit($book->description , 40) }}
                                    </div>
                                </td>
                                <td>{{ $book->available_copies }} / {{ $book->total_copies }}</td>
                                <td>{{ $book->category }}</td>
                                <td>
                                    <div class="table-col-center">
                                        <a class="btn btn-primary me-2" role="button" href="{{ route('admin/edit-book', $book->book_id) }}">Edit</a>
                                        <a class="btn btn-danger" role="button" href="{{ route('admin/delete-book', $book->book_id) }}" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
@endsection