<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login') - LaraRadar</title>

    <!-- Use AdminLTE / Bootstrap 4 / FontAwesome for auth pages (replace Mazer) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Local inline fallback styles so login doesn't render plain unstyled text -->
    <style>
        /* Minimal auth styles fallback (keeps layout readable if CDN fails) */
        body { font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; background: linear-gradient(135deg,#667eea 0%,#764ba2 100%); min-height:100vh; margin:0; display:flex; align-items:center; justify-content:center; }
        #auth { width:100%; padding:24px; }
        .auth-card { max-width:420px; margin:0 auto; background:#fff; border-radius:12px; padding:28px; box-shadow:0 12px 40px rgba(0,0,0,0.12); }
        .brand-logo { display:flex; gap:12px; align-items:center; margin-bottom:18px; }
        .logo-icon { width:46px; height:46px; border-radius:10px; background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.3rem; }
        .logo-text h5 { margin:0; font-size:1.1rem; font-weight:700; }
        .auth-header h4 { margin:0 0 6px 0; font-size:1.25rem; }
        .auth-header p { margin:0 0 12px 0; color:#6b7280; }
        label { font-weight:600; font-size:0.95rem; }
        .form-control { border-radius:8px; border:1px solid #e6e6e6; padding:10px 12px; }
        .btn-signin { background:linear-gradient(135deg,#667eea,#764ba2); color:#fff; border:none; padding:10px 14px; border-radius:8px; width:100%; }
        .btn-register { border:2px solid #667eea; color:#667eea; background:#fff; padding:10px 14px; border-radius:8px; width:100%; }
        .auth-divider { text-align:center; margin:16px 0; position:relative; }
        .auth-divider span{ background:transparent; padding:0 8px; color:#6b7280; }
        .alert { border-radius:8px; }
        @media (max-width:576px){ .auth-card { padding:20px; } }
    </style>

    @stack('styles')
</head>

<body>
    <div id="auth">
        @yield('content')
    </div>


    <!-- jQuery + Bootstrap 4 + AdminLTE JS (for interactive bits like alert dismiss) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    @stack('scripts')
</body>

</html>
