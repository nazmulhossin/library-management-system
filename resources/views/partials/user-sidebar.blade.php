<aside class="user-section-left">
    <div class="profile-summary">
        <img src="{{ asset('storage/' . session('user')->image) }}" alt="{{ session('user')->name }}">
        <p><b>{{ session('user')->name }}</b> <br> ID: {{ session('user')->registration_number }}</p>
    </div>

    <div class="sidenav">
        <div class="{{ Route::currentRouteName() == 'my-profile' ? 'link nav-active' : 'link' }}"><a href="{{ route('my-profile') }}"><i class="fas fa-user"></i> My Profile</a></div>
        <div class="{{ Route::currentRouteName() == 'my-requested-book-list' ? 'link nav-active' : 'link' }}"><a href="{{ route('my-requested-book-list') }}"><i class="fas fa-list-ul"></i> Requested Book List</a></div>
        <div class="{{ Route::currentRouteName() == 'my-borrowed-book-list' ? 'link nav-active' : 'link' }}"><a href="{{ route('my-borrowed-book-list') }}"><i class="fas fa-book-reader"></i> Borrowed Book List</a></div>
        <div class="{{ Route::currentRouteName() == 'my-returned-book-list' ? 'link nav-active' : 'link' }}"><a href="{{ route('my-returned-book-list') }}"><i class="fas fa-reply"></i> Returned Book List</a></div>
    </div>
</aside>