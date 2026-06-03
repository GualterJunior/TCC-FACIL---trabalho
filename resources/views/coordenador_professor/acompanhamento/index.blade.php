@extends('layouts.app')

@section('title', 'Acompanhamento - TCC Facil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">Acompanhamento</h1>
        <p class="text-secondary mb-0">Monitore temas sorteados, progresso por etapa e entregas dos grupos.</p>
    </div>
    <a href="{{ route('sorteios.index') }}" class="btn btn-primary">Gerenciar sorteios</a>
</div>

@forelse ($turmas as $turma)
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                <div>
                    <h2 class="h4 mb-1">{{ $turma->nome_turma }}</h2>
                    <p class="text-secondary mb-0">Codigo: {{ $turma->codigo_turma }} | {{ $turma->semestre }}</p>
                </div>
                <a href="{{ route('turmas.show', $turma) }}" class="btn btn-outline-secondary">Ver turma</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Grupo</th>
                            <th>Integrantes</th>
                            <th>Tema</th>
                            <th>Progresso</th>
                            <th>Ultima entrega</th>
                            <th>Validacao</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($turma->grupos as $grupo)
                            @php
                                $etapas = $turma->etapas;
                                $progressos = $grupo->progressos->keyBy('id_etapa');
                                $percentual = $etapas->count()
                                    ? (int) round($etapas->sum(fn ($etapa) => (int) ($progressos->get($etapa->id_etapa)?->percentual ?? 0)) / $etapas->count())
                                    : 0;
                                $ultimaEntrega = $grupo->entregas->sortByDesc('id_entrega')->first();
                                $tema = $grupo->resultadoSorteio?->tema;
                            @endphp
                            <tr>
                                <td class="fw-semibold">{{ $grupo->nome_grupo }}</td>
                                <td>
                                    @forelse ($grupo->usuarios as $usuario)
                                        <div>{{ $usuario->name }}</div>
                                    @empty
                                        <span class="text-danger">Sem alunos</span>
                                    @endforelse
                                </td>
                                <td>
                                    <div>{{ $tema?->titulo ?? 'Nao sorteado' }}</div>
                                    <div class="text-secondary small">{{ $tema?->area }}</div>
                                </td>
                                <td>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $percentual }}%;" aria-valuenow="{{ $percentual }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-secondary small">{{ $percentual }}%</span>
                                </td>
                                <td>
                                    @if ($ultimaEntrega)
                                        <a href="{{ asset('storage/'.$ultimaEntrega->caminho_arquivo) }}" target="_blank">{{ $ultimaEntrega->nome_arquivo }}</a>
                                        <div class="text-secondary small">{{ $ultimaEntrega->etapa?->nome_etapa }}</div>
                                    @else
                                        <span class="text-secondary">Nenhuma entrega</span>
                                    @endif
                                </td>
                                <td>{{ ucfirst($ultimaEntrega?->ultimaValidacao?->status_validacao ?? 'pendente') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">Nenhum grupo cadastrado para esta turma.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">Nenhuma turma disponivel para acompanhamento.</div>
@endforelse
@endsection
