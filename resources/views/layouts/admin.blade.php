<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('title', 'Admin') - SMAN 2 Balige</title>
    <link rel="icon" type="image/webp" href="{{ asset('images/logo-sman2-balige-96.webp') }}">
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    @stack('styles')
</head>
<body>
    @yield('content')
</body>
</html>
