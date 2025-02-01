@extends('layouts/user')
@section('main_content')
    <div class="user-section">
        @include('partials/user-sidebar')
    
        <section class="user-section-right">
            <h1 class="page-heading">Requested Book List</h1>

            <div class="table-container"> 
                @if($requestedBooks->isEmpty())
                    <p class="text-danger">No borrowed books found.</p>
                @else      
                    <table>
                        <thead>
                            <tr>
                                <th>Book Cover</th>
                                <th>Book Details</th>
                                <th>Request Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requestedBooks as $book)
                                <tr>
                                    <td><a href="{{ route('show-book-details', $book->book_id) }}"><img src="{{ asset('storage/' . $book->book_cover) }}"></a></td>
                                    <td>
                                        <strong>Title:</strong> {{ $book->book_title }} <br>
                                        <strong>Author:</strong> {{ $book->book_author }}
                                    </td>
                                    {{-- <td>{{ date('d M Y', strtotime($book->request_date)) }}</td> --}}
                                    <td>{{ $book->request_date }}</td>
                                    <td>
                                        <form action="{{ route('cancel-borrow-request-with-id', $book->book_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                    <!-- Pagination Links -->
                    <div class="mt-3">
                        {{ $requestedBooks->links() }}
                    </div>
                @endif
            </div>

            <div class="table-container">            
                @if($requestedBooks->isEmpty())
                    <p class="text-danger">No requested books found.</p>
                @else
                    <table>
                        <thead>
                            <tr>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requestedBooks as $book)
                            <tr>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            
                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center">
                        {{ $requestedBooks->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@push('style')
    <link href="{{ asset('user/css/user-section.min.css') }}" rel="stylesheet">
@endpush