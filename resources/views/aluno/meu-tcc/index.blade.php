@extends('layouts.app')

@section('title', 'Meu TCC - TCC Facil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">Meu TCC</h1>
        <p class="text-secondary mb-0">Acompanhe tema sorteado, etapas, entregas e validacoes do seu grupo.</p>
    </div>
    <a href="{{ route('entregas.create') }}" class="btn btn-primary">Enviar etapa</a>
</div>

@forelse ($grupos as $grupo)
    @php
        $resultado = $grupo->resultadoSorteio;
        $tema = $resultado?->tema;
        $progressos = $grupo->progressos->keyBy('id_etapa');
        $entregas = $grupo->entregas->sortByDesc('id_entrega')->groupBy('id_etapa');
        $etapas = $grupo->turma?->etapas ?? collect();
        $percentualGeral = $etapas->count()
            ? (int) round($etapas->sum(fn ($etapa) => (int) ($progressos->get($etapa->id_etapa)?->percentual ?? 0)) / $etapas->count())
            : 0;
    @endphp

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between gap-3">
                <div>
                    <span class="text-secondary">{{ $grupo->turma?->nome_turma }} | {{ $grupo->nome_grupo }}</span>
                    <h2 class="h4 mt-1 mb-1">{{ $tema?->titulo ?? 'Tema ainda nao sorteado' }}</h2>
                    <p class="text-secondary mb-0">{{ $tema?->descricao ?? 'Aguarde o professor executar o sorteio.' }}</p>
                </div>
                <div class="text-end">
                    <div class="display-6 fw-bold text-primary">{{ $percentualGeral }}%</div>
                    <span class="text-secondary small">progresso geral</span>
                </div>
            </div>

            @if ($tema)
                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <div class="text-secondary small">Area</div>
                            <div class="fw-semibold">{{ $tema->area }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <div class="text-secondary small">Data de conclusao</div>
                            <div class="fw-semibold">{{ $tema->data_conclusao ? \Illuminate\Support\Carbon::parse($tema->data_conclusao)->format('d/m/Y') : 'Nao definida' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <div class="text-secondary small">Status do sorteio</div>
                            <div class="fw-semibold">{{ ucfirst($resultado?->sorteio?->status_sorteio ?? 'pendente') }}</div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="table-responsive mt-4">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Etapa</th>
                            <th>Prazo</th>
                            <th>Status</th>
                            <th>Entrega</th>
                            <th>Validacao</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($etapas as $etapa)
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
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($progresso?->status_progresso ?? 'pendente') }}</span>
                                    <div class="text-secondary small">{{ $progresso?->percentual ?? 0 }}%</div>
                                </td>
                                <td>
                                    @if ($ultimaEntrega)
                                        <a href="{{ asset('storage/'.$ultimaEntrega->caminho_arquivo) }}" target="_blank">{{ $ultimaEntrega->nome_arquivo }}</a>
                                    @else
                                        <span class="text-secondary">Nao enviada</span>
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
@empty
    <div class="alert alert-info">
        Voce ainda nao entrou em nenhuma turma. Use o codigo compartilhado pelo professor para iniciar o acompanhamento.
    </div>
@endforelse
@endsection
