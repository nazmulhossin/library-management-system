<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') CSE Seminar Library, IU</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.min.css')}}">
    @stack('style')
</head>
<body>
    <header>
        <div class="site-logo"><a href="">Seminar Library</a></div>

        <div class="user-profile">
            <img src="{{asset('storage/'.session('user')->image)}}" alt="profile picture">
            <div id="dropdown-menu">
                <div class="user-info">
                    <img src="{{asset('storage/'.session('user')->image)}}" alt="profile picture">
                    <div><p>{{ session('user')->name }}</p><p>ID: {{ session('user')->registration_number }}</p></div></div>
                <div class="profile-link">My Profile</div>
                <div class="theme">
                    <p>Theme</p>
                    <ul>
                        <li class="active-theme"><span class="bullet"><span></span></span> Light</li>
                        <li><span class="bullet"><span></span></span> Dark</li>
                    </ul>
                </div>
                <div class="logout-button"><a href="{{ route('logout') }}"><button>Logout <i class="fa-solid fa-right-from-bracket"></i></button></a></div>
            </div>
        </div>
    </header>

    <main>@yield('main_content')</main>

    <footer>
        Copyright © 2024 - {{date('Y')}} by <span> CSE, IU</span>. All rights reserved.
    </footer>
    <script src="js/app.js"></script>
</body>
</html>