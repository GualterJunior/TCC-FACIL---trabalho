<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TCC Fácil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f7fb; color: #172033; }
        .hero { min-height: 88vh; display: flex; align-items: center; }
        .hero-panel { background: #ffffff; border: 1px solid #e7eaf0; border-radius: 8px; }
        .feature { border-left: 4px solid #0d6efd; }
        .brand-logo { height: 48px; width: auto; }
        .hero-logo { width: min(100%, 520px); height: auto; }
        .access-card { background: #fff; border: 1px solid #e7eaf0; border-radius: 8px; height: 100%; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
                <img class="brand-logo" src="{{ asset('images/logo-tcc-facil.png') }}" alt="TCC Fácil">
            </a>
            <div class="d-flex gap-2">
                <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
                <a class="btn btn-primary" href="{{ route('register') }}">Cadastro</a>
            </div>
        </div>
    </nav>

    <main class="hero">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge text-bg-primary mb-3">Sistema acadêmico para TCC</span>
                    <h1 class="display-5 fw-bold mb-3">Organize projetos, grupos, entregas e avaliações em um único lugar.</h1>
                    <p class="lead text-secondary mb-4">
                        O TCC Fácil ajuda alunos, professores e coordenadores a acompanhar o andamento dos trabalhos,
                        cadastrar projetos com banner e PDF, controlar etapas, validar entregas e registrar notas.
                    </p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="access-card p-3">
                                <h2 class="h5">Sou aluno</h2>
                                <p class="text-secondary mb-3">Acesse entregas, grupos, temas e andamento do TCC.</p>
                                <a class="btn btn-primary w-100" href="{{ route('login') }}">Entrar como aluno</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="access-card p-3">
                                <h2 class="h5">Professor ou coordenador</h2>
                                <p class="text-secondary mb-3">Gerencie turmas, projetos, validações, etapas e notas.</p>
                                <a class="btn btn-outline-primary w-100" href="{{ route('login') }}">Entrar na area administrativa</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a class="link-primary" href="{{ route('register') }}">Ainda não tenho cadastro</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-panel p-4 shadow-sm text-center">
                        <img class="hero-logo mb-4" src="{{ asset('images/logo-tcc-facil.png') }}" alt="TCC Fácil">
                        <h2 class="h4 mb-3">O que o sistema entrega</h2>
                        <div class="feature ps-3 mb-3">
                            <strong>Controle administrativo</strong>
                            <p class="text-secondary mb-0">Navbar, dashboard e gerenciamento de dados restritos por login.</p>
                        </div>
                        <div class="feature ps-3 mb-3">
                            <strong>Projetos completos</strong>
                            <p class="text-secondary mb-0">Cadastro de titulo, descricao, autor, banner visual e arquivo PDF.</p>
                        </div>
                        <div class="feature ps-3">
                            <strong>Acompanhamento do TCC</strong>
                            <p class="text-secondary mb-0">Turmas, grupos, temas, etapas, entregas, validações e notas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
