<aside class="user-section-left">
    <div class="profile-summary">
        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}">
        <p><b>{{ $user->name }}</b> <br> ID: {{ $user->registration_number }}</p>
    </div>

    <div class="sidenav">
        <div class="link"><a href="{{ route('user', session('user')->username) }}"><i class="fas fa-user"></i> My Account</a></div>
        <div class="link"><a href=""><i class="fas fa-list-ul"></i> Requested Book List</a></div>
        <div class="link"><a href=""><i class="fas fa-book-reader"></i> Borrowed Book List</a></div>
        <div class="link"><a href=""><i class="fas fa-reply"></i> Returned Book List</a></div>
    </div>
</aside>