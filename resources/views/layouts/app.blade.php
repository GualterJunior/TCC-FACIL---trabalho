<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TCC Fácil')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --tcc-primary: #0d6efd;
            --tcc-ink: #172033;
            --tcc-muted: #667085;
            --tcc-border: #e7eaf0;
            --tcc-bg: #f5f7fb;
        }
        body { background: var(--tcc-bg); color: var(--tcc-ink); }
        .navbar-brand { font-weight: 700; letter-spacing: .02em; }
        .page-shell { padding: 32px 0; }
        .card { border: 1px solid var(--tcc-border); border-radius: 8px; }
        .card.shadow-sm { box-shadow: 0 .25rem 1rem rgba(16, 24, 40, .06) !important; }
        .btn { border-radius: 6px; font-weight: 600; }
        .badge { border-radius: 999px; }
        .form-control,
        .form-select { border-color: #d9dee8; border-radius: 6px; }
        .form-control:focus,
        .form-select:focus { box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .12); }
        .table > :not(caption) > * > * { vertical-align: middle; }
        .table-light { --bs-table-bg: #f8fafc; }
        .text-secondary { color: var(--tcc-muted) !important; }
        .admin-sidebar .nav-link { color: #44546a; border-radius: 6px; }
        .admin-sidebar .nav-link.active,
        .admin-sidebar .nav-link:hover { background: #eaf2ff; color: #0d6efd; }
        .nav-link.active { color: var(--tcc-primary) !important; font-weight: 700; }
        .section-heading { border-left: 4px solid var(--tcc-primary); padding-left: 12px; }
    </style>
    @stack('styles')
</head>
<body>
    @include('layouts.navigation')

    <main class="page-shell">
        <div class="container-fluid px-4">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
