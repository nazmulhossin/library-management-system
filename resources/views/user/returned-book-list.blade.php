@extends('layouts/user')
@section('main_content')
    <div class="user-section">
        @include('partials/user-sidebar')
    
        <section class="user-section-right">
            <h1 class="page-heading">Returned Book List</h1>

            <div class="table-container"> 
                @if($returnedBooks->isEmpty())
                    <p class="text-danger">No requested books found.</p>
                @else      
                    <table>
                        <thead>
                            <tr>
                                <th>Book Cover</th>
                                <th>Book Details</th>
                                <th>Borrow Date</th>
                                <th>Return Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($returnedBooks as $book)
                                <tr>
                                    <td><a href="{{ route('show-book-details', $book->book_id) }}"><img src="{{ asset('storage/' . $book->book_cover) }}"></a></td>
                                    <td>
                                        <strong>Title:</strong> {{ $book->book_title }} <br>
                                        <strong>Author:</strong> {{ $book->book_author }}
                                    </td>
                                    <td>{{ $book->borrow_date }}</td>
                                    <td>{{ $book->return_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                    <!-- Pagination Links -->
                    <div class="mt-3">
                        {{ $returnedBooks->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@push('style')
    <link href="{{ asset('user/css/user-section.min.css') }}" rel="stylesheet">
@endpush