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

                    @if($book->has_requested)
                        <button class="borrow-request btn cancel-request" data-book-id="{{ $book->book_id }}">Cancel Request</button>
                    @else
                        <button class="borrow-request btn" data-book-id="{{ $book->book_id }}">Request to Borrow</button>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="pagination">
            {{ $books->links() }}
        </div>
    @else
        <p>No books available.</p>
    @endif
</section>