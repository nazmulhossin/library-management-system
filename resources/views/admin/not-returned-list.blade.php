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
                                <td><div class="table-col-center"><img src="{{ asset('storage/' . $book->book_cover) }}" alt="{{ $book->book_title }}" /></div></td>
                                <td>
                                    <strong>Book ID:</strong> {{ $book->book_id }} <br> 
                                    <strong>Title:</strong> {{ $book->book_title }} <br> 
                                    <strong>Author:</strong> {{ $book->book_author }}
                                </td>
                                <td>
                                    <strong>Name:</strong> {{ $book->user_name}} <br> 
                                    <strong>Reg. No:</strong> {{ $book->user_reg_number }} <br> 
                                    <strong>Phone:</strong> {{ $book->phone_number }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($book->borrow_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($book->due_date)->format('M d, Y') }}</td>
                                <td class="text-danger">
                                    {{ floor(\Carbon\Carbon::parse($book->due_date)->diffInDays(\Carbon\Carbon::today())) }} days overdue
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection