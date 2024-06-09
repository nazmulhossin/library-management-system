<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - CSE Seminar Library, IU</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.min.css') }}">
    @stack('style')
</head>
<body>
    <header>
        <div class="site-logo"><a href="">CSE Seminar Library</a></div>

        <div class="admin-profile">
            <div class="admin-info"><i class="fa-solid fa-user"></i><span>Admin</span></div> 
            <div class="logout-button"><a href="">Logout</a></div>
        </div>
    </header>
    <main>
        <aside>
            <div><span>Main Menu</span><i class="fa-solid fa-down-left-and-up-right-to-center"></i><i class="fa-solid fa-up-right-and-down-left-from-center"></i></div>
            <nav>
                <ul>
                    <li class="active-link"><a href="{{route('admin/dashboard')}}"><i class="fa-solid fa-gauge"></i> <span>Dashboard</span></a></li>
                    <li><a href="{{route('admin/book-list')}}"><i class="fa-solid fa-book"></i> <span>Book List</span></a></li>
                    <li><a href="{{route('admin/request-list')}}"><i class="fa-solid fa-code-pull-request"></i> <span>Request List</span></a></li>
                    <li><a href="{{route('admin/not-returned-list')}}"><i class="fa-solid fa-xmark"></i> <span>Not Returned List</span></a></li>
                    <li><a href="{{route('admin/issued-list')}}"><i class="fa-solid fa-check"></i> <span>Issued List</span></a></li>
                    <li><a href="{{route('admin/returned-list')}}"><i class="fa-solid fa-reply"></i> <span>Returned List</span></a></li>
                    <li><a href="{{route('admin/members-list')}}"><i class="fa-solid fa-users"></i> <span>Member List</span></a></li>
                    <li><a href="{{route('admin/approve-member')}}"><i class="fa-solid fa-person-circle-check"></i> <span>Approve Member</span></a></li>
                    <li><a href="{{route('admin/settings')}}"><i class="fa-solid fa-screwdriver-wrench"></i> <span>Settings</span></a></li>
                </ul>
            </nav>
        </aside>

        <div class="main-content">
            <h1 class="heading">@yield('heading')</h1>
            @yield('main_content')
        </div>
    </main>
    <script src="{{asset('js/admin.js')}}"></script>
</body>
</html>