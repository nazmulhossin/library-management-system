<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') CSE Seminar Library, IU</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('user/css/layout.css') }}">
    @stack('style')
</head>
<body>
    
    <!-- header section  -->
    <header class="header">
        <div class="header-1">
            <div>
                <a href="{{ route('home') }}" class="logo"> <img src="{{ asset('assets/img/full-logo.png') }}" alt=""></a>
            </div>
            
            <form action="" class="search-form">
                <input type="search" name="" placeholder="search here..." id="search-box">
                <label for="search-box" class="fas fa-search"></label>
            </form>

            <div class="user-profile">
                <div class="user-info">
                    <i class="far fa-user"></i>
                    <p>{{ Str::limit(session('user')->name, 10) }}</p>
                    <i class="fas fa-caret-down"></i>
                </div>
                
                <div id="dropdown-menu">
                    <div class="link"><a href="{{ route('user', session('user')->username) }}"><i class="fas fa-user"></i> My Profile</a></div>
                    <div class="link"><a href=""><i class="fas fa-list-ul"></i> Requested Book List</a></div>
                    <div class="link"><a href=""><i class="fas fa-book-reader"></i> Borrowed Book List</a></div>
                    <div class="link"><a href=""><i class="fas fa-reply"></i> Returned Book List</a></div>
                    <div class="logout-button"><a href="{{ route('logout') }}" class="btn">Logout <i class="fas fa-sign-out-alt"></i></a></div>
                </div>
            </div>
        </div>

        <div class="header-2">
            <nav class="navbar">
                <a class="{{ Route::currentRouteName() == 'all-books' ? 'nav-active' : '' }}" href="{{ route('all-books') }}">All Books</a>
                <a class="{{ Route::currentRouteName() == 'programming-books' ? 'nav-active' : '' }}" href="{{ route('programming-books') }}">Programming</a>
                <a class="{{ Route::currentRouteName() == 'machine-learning-books' ? 'nav-active' : '' }}" href="{{ route('machine-learning-books') }}">Machine Learning</a>
                <a class="{{ Route::currentRouteName() == 'mathematics-books' ? 'nav-active' : '' }}" href="{{ route('mathematics-books') }}">Mathematics</a>
            </nav>
        </div>
    </header>

    <!-- bottom navbar for mobile  -->
    <nav class="bottom-navbar">
        <a href="#home" class="fas fa-home"></a>
        <a href="#books" class="fas fa-book"></a>
        <a href="#arrivals" class="fas fa-book-open"></a>
    </nav>

    <main>@yield('main_content')</main>

    <!-- footer section -->
    <footer class="footer">
        <div class="credit">Copyright &copy; 2024 - {{date('Y')}} by <span>CSE Seminar Library, IU</span>. All rights reserved.</div>
    </footer>

    <!-- loader  -->
    <div class="loader-container">
        <img src="{{ asset('user/img/loader-img.gif') }}" alt="">
    </div>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="{{ asset('user/js/script.js') }}"></script>
</body>
</html>