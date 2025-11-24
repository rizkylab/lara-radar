<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login') - LaraRadar</title>

    <!-- Mazer CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/compiled/css/auth.css">

    @stack('styles')
</head>

<body>
    <div id="auth">
        @yield('content')
    </div>

    <!-- Mazer JS -->
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/static/js/components/dark.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/compiled/js/app.js"></script>

    @stack('scripts')
</body>

</html>
