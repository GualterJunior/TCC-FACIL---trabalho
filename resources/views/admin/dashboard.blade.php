@extends('layouts.app')

@section('title', 'Dashboard - TCC Fácil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">{{ $isStaff ? 'Dashboard administrativo' : 'Painel do aluno' }}</h1>
        <p class="text-secondary mb-0">
            {{ $isStaff ? 'Gerencie cadastros, avaliações, validações e notas.' : 'Acompanhe seu grupo, tema sorteado e entregas do TCC.' }}
        </p>
    </div>
    @if ($isStaff)
        <a href="{{ route('validacoes.index') }}" class="btn btn-primary">Avaliar entregas</a>
    @else
        <a href="{{ route('entregas.create') }}" class="btn btn-primary">Nova entrega</a>
    @endif
</div>

<div class="row g-3">
    @foreach ($cards as $card)
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route($card['route']) }}" class="text-decoration-none">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <span class="text-secondary">{{ $card['label'] }}</span>
                        <div class="display-6 fw-bold text-primary">{{ $card['count'] }}</div>
                        <span class="small text-secondary">{{ $isStaff ? 'Gerenciar registros' : 'Acessar area' }}</span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<div class="card mt-4">
    <div class="card-body">
        @if ($isStaff)
            <h2 class="h5">Área de avaliação</h2>
            <p class="text-secondary mb-3">
                Use as opções abaixo para acompanhar entregas, validar trabalhos e registrar notas dos grupos.
            </p>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('validacoes.index') }}" class="btn btn-outline-primary">Validar entregas</a>
                <a href="{{ route('notas.index') }}" class="btn btn-outline-primary">Lançar notas</a>
                <a href="{{ route('etapas.index') }}" class="btn btn-outline-primary">Gerenciar etapas</a>
                <a href="{{ route('sorteios.index') }}" class="btn btn-outline-primary">Sorteios de temas</a>
                <a href="{{ route('acompanhamento.index') }}" class="btn btn-outline-primary">Acompanhamento</a>
            </div>
        @else
            <h2 class="h5">Acompanhamento do aluno</h2>
            <p class="text-secondary mb-3">
                Você pode consultar o tema sorteado, acompanhar seu grupo e enviar as etapas do TCC.
            </p>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('aluno.meu-tcc.index') }}" class="btn btn-outline-primary">Meu TCC</a>
                <a href="{{ route('grupos.index') }}" class="btn btn-outline-primary">Meu grupo</a>
                <a href="{{ route('temas.index') }}" class="btn btn-outline-primary">Temas</a>
                <a href="{{ route('entregas.index') }}" class="btn btn-outline-primary">Minhas entregas</a>
                <a href="{{ route('aluno.notas.index') }}" class="btn btn-outline-primary">Minhas notas</a>
            </div>
        @endif
    </div>
</div>
@endsection
