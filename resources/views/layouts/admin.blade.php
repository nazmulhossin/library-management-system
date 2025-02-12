<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') | CSE Seminar Library, IU</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="{{ asset('admin-dashboard/css/styles.css') }}" rel="stylesheet" />
        @stack('style')
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('admin/dashboard') }}">CSE Seminar Library</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin/settings') }}">Settings</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="{{ Route::currentRouteName() == 'admin/dashboard' ? 'nav-link active' : 'nav-link' }}" href="{{ route('admin/dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="{{ Route::currentRouteName() == 'admin/request-list' ? 'nav-link active' : 'nav-link' }}" href="{{ route('admin/request-list') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-code-pull-request"></i></div>
                                Request List
                            </a>
                            <a class="{{ Route::currentRouteName() == 'admin/assign-book-form' ? 'nav-link active' : 'nav-link' }}" href="{{ route('admin/assign-book-form') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                                Assign Book Manually
                            </a>
                            <a class="{{ Route::currentRouteName() == 'admin/issued-list' ? 'nav-link active' : 'nav-link' }}" href="{{ route('admin/issued-list') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-check"></i></div>
                                Issued List
                            </a>
                            <a class="{{ Route::currentRouteName() == 'admin/not-returned-list' ? 'nav-link active' : 'nav-link' }}" href="{{ route('admin/not-returned-list') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-xmark"></i></div>
                                Not Returned List
                            </a>
                            <a class="{{ Route::currentRouteName() == 'admin/returned-list' ? 'nav-link active' : 'nav-link' }}" href="{{ route('admin/returned-list') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-reply"></i></div>
                                Returned List
                            </a>
                            <div class="sb-sidenav-menu-heading">Manage Books</div>
                            <a class="{{ Route::currentRouteName() == 'admin/add-book' ? 'nav-link active' : 'nav-link' }}" href="{{ route('admin/add-book') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book-medical"></i></div>
                                Add Book
                            </a>
                            <a class="{{ Route::currentRouteName() == 'admin/book-list' ? 'nav-link active' : 'nav-link' }}" href="{{ route('admin/book-list') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                Book List
                            </a>
                            <div class="sb-sidenav-menu-heading">Manage Members</div>
                            <a class="{{ Route::currentRouteName() == 'admin/pending-members' ? 'nav-link active' : 'nav-link' }}" href="{{ route('admin/pending-members') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-person-circle-check"></i></div>
                                Pending Members
                            </a>
                            <a class="{{ Route::currentRouteName() == 'admin/member-list' ? 'nav-link active' : 'nav-link' }}" href="{{ route('admin/member-list') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Member List
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: Admin</div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('main_content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2024 - {{date('Y')}} by <span>CSE Seminar Library, IU</span>. All rights reserved.</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- loader  -->
        <div class="loader-container">
            <img src="{{ asset('admin-dashboard/assets/img/loader.gif') }}" alt="">
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('admin-dashboard/js/scripts.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('admin-dashboard/js/datatables-simple-demo.js') }}"></script>
    </body>
</html>
