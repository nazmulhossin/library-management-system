<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - CSE Seminar Library, IU</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="{{asset('auth/css/auth.min.css')}}">
    @stack('style')
</head>
<body>
    @yield('form_container')
</body>
</html>