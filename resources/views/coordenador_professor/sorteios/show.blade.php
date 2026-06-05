@extends('layouts.app')

@section('title', 'Sorteio - TCC Facil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <a href="{{ route('sorteios.index') }}" class="text-decoration-none">&larr; Voltar</a>
        <h1 class="h3 mt-2 mb-0">Sorteio de temas</h1>
        <p class="text-secondary mb-0">{{ $record->turma?->nome_turma }} | {{ ucfirst($record->status_sorteio) }}</p>
    </div>
    <form method="POST" action="{{ route('sorteios.executar', $record) }}" onsubmit="return confirm('Executar o sorteio agora? Resultados anteriores deste sorteio serao substituidos.')">
        @csrf
        <button class="btn btn-primary" type="submit">Executar sorteio automatico</button>
    </form>
</div>

@if ($record->resumo_sorteio || $record->executado_em)
    <div class="row g-3 mb-4">
        <div class="col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h2 class="h6 text-secondary">Resumo</h2>
                    <p class="mb-0">{{ $record->resumo_sorteio ?? 'Sorteio ainda sem resumo.' }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h2 class="h6 text-secondary">Executado por</h2>
                    <p class="mb-0">{{ $record->executor?->name ?? 'Nao informado' }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h2 class="h6 text-secondary">Data de execucao</h2>
                    <p class="mb-0">{{ $record->executado_em ? \Illuminate\Support\Carbon::parse($record->executado_em)->format('d/m/Y H:i') : 'Nao executado' }}</p>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="h5">Resultados publicados</h2>
        <div class="table-responsive mt-3">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Grupo</th>
                        <th>Tema sorteado</th>
                        <th>Area</th>
                        <th>Criterio</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($record->resultados as $resultado)
                        <tr>
                            <td>{{ $resultado->grupo?->nome_grupo }}</td>
                            <td>{{ $resultado->tema?->titulo }}</td>
                            <td>{{ $resultado->tema?->area }}</td>
                            <td>
                                @if ($resultado->criterio === 'preferencia')
                                    <span class="badge text-bg-success">{{ $resultado->prioridade_atendida }}ª preferencia</span>
                                @else
                                    <span class="badge text-bg-secondary">Aleatorio</span>
                                @endif
                            </td>
                            <td>{{ $record->data_sorteio }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-4">Este sorteio ainda nao possui resultados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
