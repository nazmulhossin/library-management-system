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
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Book ID</th>
                            <th>Image</th>
                            <th>Book's Info</th>
                            <th>Available Copies</th>
                            <th>Category</th>
                            <th>Description</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->book_id }}</td>
                                <td><div class="table-col-center"><img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" /></div></td>
                                <td>
                                    <div style="width: 25vw">
                                        <b>Title: {{ $book->title }}</b> <br>
                                        Author: {{ $book->author }} <br>
                                        Publisher: {{ $book->publisher }} <br>
                                        Edition: {{ $book->edition }} <br>
                                        ISBN: {{$book->isbn }}
                                    </div>
                                    
                                </td>
                                <td>{{ $book->available_copies }} / {{ $book->total_copies }}</td>
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection