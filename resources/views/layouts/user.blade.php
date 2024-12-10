<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') CSE Seminar Library, IU</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('user-view/css/style.css') }}">
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
                <div class="profile-picture">
                    <img src="{{asset('storage/'.session('user')->image)}}" alt="profile picture">
                    <i class="fas fa-angle-down"></i>
                </div>
                
                <div id="dropdown-menu">
                    <div class="user-info">
                        <img src="{{asset('storage/'.session('user')->image)}}" alt="profile picture">
                        <div><p>{{ session('user')->name }}</p><p>ID: {{ session('user')->registration_number }}</p></div>
                    </div>
                    <div class="link"><a href=""><i class="fas fa-user"></i> My Profile</a></div>
                    <div class="link"><a href=""><i class="fas fa-list-ul"></i> Requested Book List</a></div>
                    <div class="link"><a href=""><i class="fas fa-book-reader"></i> Borrowed Book List</a></div>
                    <div class="link"><a href=""><i class="fas fa-reply"></i> Returned Book List</a></div>
                    <div class="logout-button"><a href="{{ route('logout') }}" class="btn">Logout <i class="fas fa-sign-out-alt"></i></a></div>
                </div>
            </div>
        </div>

        <div class="header-2">
            <nav class="navbar">
                <a href="#home">Home</a>
                <a href="#books">Books</a>
                <a href="#research-paper">Research Paper</a>
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
        <img src="{{ asset('user-view/img/loader-img.gif') }}" alt="">
    </div>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="{{ asset('user-view/js/script.js') }}"></script>
</body>
</html>