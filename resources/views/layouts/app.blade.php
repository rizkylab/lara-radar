<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Dashboard') - Lara Radar</title>

    <!-- Mazer CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/compiled/css/app-dark.css">

    <!-- Bootstrap Icons (fallback) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles')
</head>
<body>
    <div id="app">
        @include('components.sidebar')

        <div id="main" class="layout-navbar">
            @include('components.navbar')

            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>@yield('page_title', config('app.name', 'Lara Radar'))</h3>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                    </section>
                </div>
                @include('components.footer')
            </div>
        </div>
    </div>

    <!-- Mazer / Vendor JS -->
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/compiled/js/app.js"></script>

    @stack('scripts')
</body>
</html>