<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - LaraRadar</title>

    <!-- Mazer CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/compiled/css/iconly.css">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @stack('styles')

    <style>
        .severity-critical { color: #dc3545; }
        .severity-high { color: #fd7e14; }
        .severity-medium { color: #ffc107; }
        .severity-low { color: #0dcaf0; }
        .severity-info { color: #6c757d; }
        
        .badge-critical { background-color: #dc3545; }
        .badge-high { background-color: #fd7e14; }
        .badge-medium { background-color: #ffc107; color: #000; }
        .badge-low { background-color: #0dcaf0; color: #000; }
        .badge-info { background-color: #6c757d; }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/static/js/initTheme.js"></script>
    
    <div id="app">
        @include('components.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @include('components.navbar')

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>@yield('page-title', 'Dashboard')</h3>
                            <p class="text-subtitle text-muted">@yield('page-subtitle', '')</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                @yield('breadcrumb')
                            </nav>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @yield('content')
            </div>

            @include('components.footer')
        </div>
    </div>

    <!-- Mazer JS -->
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/static/js/components/dark.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@main/dist/assets/compiled/js/app.js"></script>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @stack('scripts')
</body>

</html>
