@extends('layouts/admin')
@section('title') Not Returned Book List @endsection
@section('main_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">Not Returned Book List</h1>

        <div class="mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Book Cover</th>
                            <th>Book Details</th>
                            <th>Issued To</th>
                            <th>Borrow Date</th>
                            <th>Due Date</th>
                            <th>Overdue Days</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Book Cover</th>
                            <th>Book Details</th>
                            <th>Issued To</th>
                            <th>Borrow Date</th>
                            <th>Due Date</th>
                            <th>Overdue Days</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($notReturnedBooks as $book)
                            <tr>
                                <td><div class="table-col-center"><img src="{{ asset('storage/' . $book->book_cover_image) }}" alt="{{ $book->book_title }}" /></div></td>
                                <td>Book ID: {{ $book->book_id }} <br> Title: {{ $book->book_title }} <br> Author: {{ $book->book_author }}</td>
                                <td>Name: {{ $book->user_name}} <br> Reg. No: {{ $book->user_reg_number }}</td>
                                <td>{{ \Carbon\Carbon::parse($book->borrow_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($book->due_date)->format('M d, Y') }}</td>
                                <td class="text-danger">
                                    {{ \Carbon\Carbon::parse($book->due_date)->diffInDays(now()) }} days overdue
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection