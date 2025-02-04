@extends('layouts/user')
@section('title') {{ $book->title }} | @endsection

@section('main_content')
    <div class="book-section">
        <div class="book-card">
            <div class="book-cover">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover">
                <p class="availability {{ $book->available_copies > 0 ? 'available' : 'not-available' }}"><i class="fas fa-check-circle"></i><i class="far fa-times-circle"></i> {{ $book->available_copies }} copies available</p>
                @if($book->status == 'Requested')
                    <button class="btn cancel-request" data-book-id="{{ $book->book_id }}">Cancel Request</button>
                @elseif($book->status == 'Borrowed')
                    <button class="btn already-borrowed" data-book-id="{{ $book->book_id }}">Already Borrowed</button>
                @else
                    <button class="btn send-borrow-request" data-book-id="{{ $book->book_id }}">Request to Borrow</button>
                @endif
            </div>
            
            <div class="book-details">
                <h2>{{ $book->title }}</h2>
                <p class="author"><span>by</span> {{ $book->author }}</p>
                <div class="hr"></div>
                <p class="description">{{ $book->description }}</p>
                <div class="hr"></div>
                <div class="details-group">
                    <p><span>ISBN</span> <br> {{ $book->isbn }} </p>
                    <p><span>Edition</span> <br> {{ $book->edition }} </p>
                    <p><span>Publisher</span> <br> {{ $book->publisher }} </p>
                    <p><span>Publication date</span> <br> {{ date('M d, Y', strtotime($book->publication_date)) }} </p>
                    <p><span>Print length</span> <br> {{ $book->pages }} pages</p>
                </div>
            </div>
        </div>
    </div>

    <div class="related-books">
        <h3>Related Books</h3>

        <div class="swiper books-slider">
            <div class="swiper-wrapper">
                @foreach($sameCategoryBooks as $sameBook)
                    <div class="swiper-slide book">
                        <a href="{{ route('show-book-details', $sameBook->book_id) }}">
                            <img src="{{ asset('storage/' . $sameBook->cover_image) }}" alt="{{ $sameBook->title }}">
                            <p>View Details</p>
                        </a>
                        <div class="book-info">
                            <h3 class="book-name">{{ Str::limit($sameBook->title, 20) }}</h3>
                            <p class="author">{{ Str::limit($sameBook->author, 15) }}</p>
                            <p class="status {{ $sameBook->available_copies > 0 ? 'available' : 'not-available' }}">
                                Available: 
                                @if ($sameBook->available_copies > 1)
                                    {{ $sameBook->available_copies }} copies
                                @else
                                    {{ $sameBook->available_copies }} copy
                                @endif
                            </p>
                        </div>
    
                        @if($sameBook->status == 'Requested')
                            <button class="btn cancel-request" data-book-id="{{ $sameBook->book_id }}">Cancel Request</button>
                        @elseif($sameBook->status == 'Borrowed')
                            <button class="btn already-borrowed" data-book-id="{{ $sameBook->book_id }}">Already Borrowed</button>
                        @else
                            <button class="btn send-borrow-request" data-book-id="{{ $sameBook->book_id }}">Request to Borrow</button>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
@endsection

@push('style')
    <link href="{{ asset('user/css/book.min.css') }}" rel="stylesheet">
@endpush