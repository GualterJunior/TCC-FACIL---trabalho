<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
    @php($isStaff = in_array(strtolower(trim((string) Auth::user()->tipo)), ['professor', 'coordenador'], true))
    <div class="container-fluid px-4">
        <a class="navbar-brand text-primary d-flex align-items-center flex-shrink-0" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo-tcc-facil.png') }}" alt="TCC Facil" style="height: 42px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Abrir menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('projetos.*') ? 'active' : '' }}" href="{{ route('projetos.index') }}">Projetos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('grupos.*') ? 'active' : '' }}" href="{{ route('grupos.index') }}">{{ $isStaff ? 'Grupos' : 'Meu grupo' }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('temas.*') ? 'active' : '' }}" href="{{ route('temas.index') }}">Temas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('entregas.*') ? 'active' : '' }}" href="{{ route('entregas.index') }}">Entregas</a>
                </li>
                @if ($isStaff)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('sorteios.*') && ! request()->routeIs('sorteios.historico') ? 'active' : '' }}" href="{{ route('sorteios.index') }}">Sorteios</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aluno.meu-tcc.*') ? 'active' : '' }}" href="{{ route('aluno.meu-tcc.index') }}">Meu TCC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aluno.notas.*') ? 'active' : '' }}" href="{{ route('aluno.notas.index') }}">Notas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aluno.turmas.*') ? 'active' : '' }}" href="{{ route('aluno.turmas.index') }}">Turmas</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('sorteios.historico') ? 'active' : '' }}" href="{{ route('sorteios.historico') }}">Historico</a>
                </li>
                @if ($isStaff)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('turmas.*') || request()->routeIs('etapas.*') || request()->routeIs('notas.*') || request()->routeIs('validacoes.*') || request()->routeIs('acompanhamento.*') || request()->routeIs('users.*') || request()->routeIs('suportes.*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administracao
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('turmas.index') }}">Turmas</a></li>
                            <li><a class="dropdown-item" href="{{ route('validacoes.index') }}">Validar entregas</a></li>
                            <li><a class="dropdown-item" href="{{ route('notas.index') }}">Lancar notas</a></li>
                            <li><a class="dropdown-item" href="{{ route('etapas.index') }}">Etapas</a></li>
                            <li><a class="dropdown-item" href="{{ route('acompanhamento.index') }}">Acompanhamento</a></li>
                            <li><a class="dropdown-item" href="{{ route('users.index') }}">Usuarios</a></li>
                            <li><a class="dropdown-item" href="{{ route('suportes.index') }}">Suporte</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('suportes.*') ? 'active' : '' }}" href="{{ route('suportes.index') }}">Suporte</a>
                    </li>
                @endif
            </ul>

            <div class="dropdown ms-lg-auto flex-shrink-0">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="text-muted">({{ ucfirst(Auth::user()->tipo) }})</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">Sair</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
