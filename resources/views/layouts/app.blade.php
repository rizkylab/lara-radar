<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Dashboard') - Lara Radar</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    @stack('styles')

    <style>
        /* Hero left panel for reference layout */
        .page-hero-wrap {
            min-height: 520px;
            display: flex;
            align-items: stretch;
            gap: 0;
        }
        .page-hero-left {
            flex: 1 1 55%;
            background: linear-gradient(135deg,#0f1724 0%, #292b45 60%);
            color: #fff;
            padding: 3.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
        }
        .page-hero-left .hero-graphic {
            width: 80%;
            max-width: 680px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 8px 30px rgba(2,6,23,0.6);
        }
        .page-hero-right {
            flex: 0 0 45%;
            background: #f8f9fb;
            padding: 2.5rem;
            display:flex;
            align-items:center;
        }
        .page-hero-card {
            width:100%;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        }
        @media (max-width: 992px) {
            .page-hero-left { display:none; }
            .page-hero-right { flex:1 1 100%; padding:1rem; }
            .page-hero-wrap { min-height: auto; }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('components.sidebar')
    @include('components.navbar')

    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('page_title', 'Dashboard')</h1>
                        <p class="text-muted">@yield('page_subtitle')</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @section('breadcrumb')
                            <li class="breadcrumb-item active">Dashboard</li>
                            @show
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content (wrapped inside hero reference layout) -->
        <section class="content">
            <div class="container-fluid">
                <div class="page-hero-wrap">
                    <div class="page-hero-left d-none d-lg-flex">
                        <div class="hero-graphic">
                            {{-- Decorative graphic: You can replace with `public/hero.png` or inline SVG --}}
                            <img src="{{ asset('mazer-hero.png') }}" alt="Hero" class="img-fluid hero-graphic" onerror="this.style.display='none'">
                        </div>
                    </div>
                    <div class="page-hero-right">
                        <div class="page-hero-card">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('components.footer')
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

@stack('scripts')
</body>
</html>