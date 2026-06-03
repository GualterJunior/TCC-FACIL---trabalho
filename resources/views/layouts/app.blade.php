<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TCC Fácil')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f7fb; }
        .navbar-brand { font-weight: 700; letter-spacing: .02em; }
        .page-shell { padding: 32px 0; }
        .card { border: 1px solid #e7eaf0; border-radius: 8px; }
        .table > :not(caption) > * > * { vertical-align: middle; }
        .admin-sidebar .nav-link { color: #44546a; border-radius: 6px; }
        .admin-sidebar .nav-link.active,
        .admin-sidebar .nav-link:hover { background: #eaf2ff; color: #0d6efd; }
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
