<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TCC Fácil')</title>

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --tcc-primary: #0d6efd;
            --tcc-ink: #172033;
            --tcc-muted: #667085;
            --tcc-border: #e7eaf0;
            --tcc-bg: #f5f7fb;
        }

        body {
            background: var(--tcc-bg);
            color: var(--tcc-ink);
            font-variant-numeric: tabular-nums; /* Melhora alinhamento de números em tabelas */
        }

        .navbar-brand { font-weight: 700; letter-spacing: .02em; }
        .page-shell { padding: 2rem 0; }

        /* Customizações de Componentes */
        .card { border: 1px solid var(--tcc-border); border-radius: 8px; }
        .card.shadow-sm { box-shadow: 0 .25rem 1rem rgba(16, 24, 40, .06) !important; }
        .btn { border-radius: 6px; font-weight: 600; transition: all 0.2s ease; }
        .badge { border-radius: 999px; padding: 0.35em 0.65em; }

        /* Formulários */
        .form-control,
        .form-select { border-color: #d9dee8; border-radius: 6px; padding: 0.475rem 0.75rem; }
        .form-control:focus,
        .form-select:focus {
            border-color: var(--tcc-primary);
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .15);
        }

        /* Tabelas */
        .table > :not(caption) > * > * { vertical-align: middle; }
        .table-light { --bs-table-bg: #f8fafc; }
        .text-secondary { color: var(--tcc-muted) !important; }

        /* Menu Lateral (Sidebar) */
        .admin-sidebar .nav-link { color: #44546a; border-radius: 6px; margin-bottom: 4px; transition: all 0.2s; }
        .admin-sidebar .nav-link.active,
        .admin-sidebar .nav-link:hover { background: #eaf2ff; color: #0d6efd; }
        .nav-link.active { color: var(--tcc-primary) !important; font-weight: 700; }

        /* Elementos de Destaque */
        .section-heading { border-left: 4px solid var(--tcc-primary); padding-left: 12px; font-weight: 700; }

        /* Efeito de transição suave para interações */
        a, button { transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out; }
    </style>
    @stack('styles')
</head>
<body>

    @include('layouts.navigation')

    <main class="page-shell">
        <div class="container-fluid px-4">

            <!-- Sistema de Alertas Inteligente com botão Fechar -->
            <div class="container-alerts">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Exibição de erros de validação do Laravel (Muito útil para CRUDs) -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <strong class="d-block mb-1">Por favor, corrija os erros abaixo:</strong>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <!-- Conteúdo da Página -->
            <div class="content-wrapper">
                {{ $slot ?? '' }}
                @yield('content')
            </div>

        </div>
    </main>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
