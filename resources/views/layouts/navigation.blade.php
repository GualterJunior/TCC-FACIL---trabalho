<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
    @php($isStaff = in_array(strtolower(trim((string) Auth::user()->tipo)), ['professor', 'coordenador'], true))
    <div class="container-fluid px-4">
        <a class="navbar-brand text-primary d-flex align-items-center" href="{{ route('dashboard') }}">
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
                        <a class="nav-link {{ request()->routeIs('turmas.*') ? 'active' : '' }}" href="{{ route('turmas.index') }}">Turmas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('etapas.*') || request()->routeIs('notas.*') || request()->routeIs('sorteios.*') || request()->routeIs('validacoes.*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Avaliacoes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('validacoes.index') }}">Validar entregas</a></li>
                            <li><a class="dropdown-item" href="{{ route('notas.index') }}">Lancar notas</a></li>
                            <li><a class="dropdown-item" href="{{ route('etapas.index') }}">Etapas</a></li>
                            <li><a class="dropdown-item" href="{{ route('sorteios.index') }}">Sorteios</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Usuarios</a>
                    </li>
                @endif
            </ul>

            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
