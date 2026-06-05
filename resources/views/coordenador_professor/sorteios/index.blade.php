@extends('layouts.app')

@section('title', 'Sorteios - TCC Facil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">Sorteios de temas</h1>
        <p class="text-secondary mb-0">Crie, abra e execute a distribuicao de temas entre os grupos.</p>
    </div>
    <a href="{{ route('sorteios.create') }}" class="btn btn-primary">Novo sorteio</a>
</div>

@unless ($tableExists)
    <div class="alert alert-warning">
        A tabela de sorteios ainda nao existe no banco. Rode as migrations para liberar o modulo.
    </div>
@endunless

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Turma</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Resultados</th>
                    <th class="text-end">Acoes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($records as $sorteio)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $sorteio->turma?->nome_turma ?? 'Turma nao encontrada' }}</div>
                            <div class="text-secondary small">{{ $sorteio->turma?->codigo_turma }}</div>
                        </td>
                        <td>{{ \Illuminate\Support\Carbon::parse($sorteio->data_sorteio)->format('d/m/Y') }}</td>
                        <td>
                            @php
                                $statusClass = match ($sorteio->status_sorteio) {
                                    'realizado' => 'text-bg-success',
                                    'cancelado' => 'text-bg-secondary',
                                    default => 'text-bg-warning',
                                };
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ ucfirst($sorteio->status_sorteio) }}</span>
                        </td>
                        <td>{{ $sorteio->resultados->count() }} tema(s) distribuido(s)</td>
                        <td class="text-end">
                            <div class="d-flex flex-wrap justify-content-end gap-2">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('sorteios.show', $sorteio) }}">Abrir resultado</a>
                                <form method="POST" action="{{ route('sorteios.executar', $sorteio) }}" onsubmit="return confirm('Executar o sorteio agora? Resultados anteriores deste sorteio serao substituidos.')">
                                    @csrf
                                    <button class="btn btn-sm btn-primary" type="submit">Executar agora</button>
                                </form>
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('sorteios.edit', $sorteio) }}">Editar</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-secondary py-4">Nenhum sorteio cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if (method_exists($records, 'links'))
    <div class="mt-3">{{ $records->links() }}</div>
@endif
@endsection
