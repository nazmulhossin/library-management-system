<section class="book-section-container">
    <h1 class="page-heading">{{ $pageHeading }}</h1>

    @if($books->count() > 0)
        <div class="books-container">
            @foreach($books as $book)
                <div class="book">
                    <a href="{{ route('show-book-details', $book->book_id) }}">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                        <p>View Details</p>
                    </a>
                    <div class="book-info">
                        <h3 class="book-name">{{ Str::limit($book->title, 20) }}</h3>
                        <p class="author">{{ Str::limit($book->author, 15) }}</p>
                        <p class="status {{ $book->available_copies > 0 ? 'available' : 'not-available' }}">
                            Available: 
                            @if ($book->available_copies > 1)
                                {{ $book->available_copies }} copies
                            @else
                                {{ $book->available_copies }} copy
                            @endif
                        </p>
                    </div>

                    @if($book->status == 'Requested')
                        <button class="btn cancel-request" data-book-id="{{ $book->book_id }}">Cancel Request</button>
                    @elseif($book->status == 'Borrowed')
                        <button class="btn already-borrowed" data-book-id="{{ $book->book_id }}">Already Borrowed</button>
                    @else
                        <button class="btn send-borrow-request" data-book-id="{{ $book->book_id }}">Request to Borrow</button>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="pagination">
            {{ $books->links() }}
        </div>
    @else
        <p class="no-books-available">No books available.</p>
    @endif
</section>