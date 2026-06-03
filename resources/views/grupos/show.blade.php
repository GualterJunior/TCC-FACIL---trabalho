@extends('layouts.app')

@section('title', $grupo->nome_grupo.' - TCC Fácil')

@section('content')
@php
    $tema = $grupo->resultadoSorteio?->tema;
    $progressos = $grupo->progressos->keyBy('id_etapa');
    $entregas = $grupo->entregas->sortByDesc('id_entrega')->groupBy('id_etapa');
@endphp

<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-4">
    <div>
        <a href="{{ route('grupos.index') }}" class="text-decoration-none">&larr; Voltar</a>
        <h1 class="h3 mt-2 mb-1">{{ $grupo->nome_grupo }}</h1>
        <p class="text-secondary mb-0">{{ $grupo->turma?->nome_turma }} | {{ ucfirst($grupo->status_grupo) }}</p>
    </div>
    @if ($isStaff)
        <a href="{{ route('grupos.edit', $grupo) }}" class="btn btn-primary">Editar</a>
    @endif
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h2 class="h5">Integrantes</h2>
                @forelse ($grupo->usuarios as $usuario)
                    <div class="border-top py-2">
                        <div class="fw-semibold">{{ $usuario->name }}</div>
                        <div class="text-secondary small">{{ $usuario->email }}</div>
                    </div>
                @empty
                    <p class="text-secondary mb-0">Nenhum integrante vinculado.</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h2 class="h5">Tema sorteado</h2>
                <div class="fw-semibold">{{ $tema?->titulo ?? 'Tema ainda não sorteado' }}</div>
                <p class="text-secondary mb-0">{{ $tema?->descricao ?? 'Aguarde o sorteio ser executado pelo professor.' }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h2 class="h5">Notas</h2>
                @forelse ($grupo->notas as $nota)
                    <div class="border-top py-2">
                        <div class="fw-semibold">{{ number_format($nota->nota, 1, ',', '.') }}</div>
                        <div class="text-secondary small">{{ $nota->professor?->name }} - {{ $nota->comentario ?: 'Sem comentário' }}</div>
                    </div>
                @empty
                    <p class="text-secondary mb-0">Nenhuma nota lançada.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="h5">Etapas e entregas</h2>
        <div class="table-responsive mt-3">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Etapa</th>
                        <th>Prazo</th>
                        <th>Progresso</th>
                        <th>Entrega</th>
                        <th>Validação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($grupo->turma?->etapas ?? collect() as $etapa)
                        @php
                            $progresso = $progressos->get($etapa->id_etapa);
                            $ultimaEntrega = $entregas->get($etapa->id_etapa)?->first();
                        @endphp
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $etapa->ordem_etapa }}. {{ $etapa->nome_etapa }}</div>
                                <div class="text-secondary small">{{ $etapa->descricao }}</div>
                            </td>
                            <td>{{ \Illuminate\Support\Carbon::parse($etapa->prazo_entrega)->format('d/m/Y') }}</td>
                            <td>{{ $progresso?->percentual ?? 0 }}% - {{ ucfirst($progresso?->status_progresso ?? 'pendente') }}</td>
                            <td>
                                @if ($ultimaEntrega)
                                    <a href="{{ asset('storage/'.$ultimaEntrega->caminho_arquivo) }}" target="_blank">{{ $ultimaEntrega->nome_arquivo }}</a>
                                @else
                                    <span class="text-secondary">Não enviada</span>
                                @endif
                            </td>
                            <td>{{ ucfirst($ultimaEntrega?->ultimaValidacao?->status_validacao ?? 'pendente') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-4">Nenhuma etapa cadastrada para esta turma.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
