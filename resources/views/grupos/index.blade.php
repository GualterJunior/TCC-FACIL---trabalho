@extends('layouts.app')

@section('title', ($isStaff ? 'Grupos' : 'Meu grupo').' - TCC Fácil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">{{ $isStaff ? 'Grupos' : 'Meu grupo' }}</h1>
        <p class="text-secondary mb-0">{{ $isStaff ? 'Acompanhe grupos, integrantes, tema e progresso.' : 'Veja os dados do seu grupo, tema sorteado, entregas e notas.' }}</p>
    </div>
    @if ($isStaff)
        <a href="{{ route('grupos.create') }}" class="btn btn-primary">Novo grupo</a>
    @endif
</div>

@unless ($tableExists)
    <div class="alert alert-warning">A tabela de grupos ainda não existe no banco.</div>
@endunless

<div class="row g-3">
    @forelse ($records as $grupo)
        @php
            $tema = $grupo->resultadoSorteio?->tema;
            $media = $grupo->notas->count() ? number_format($grupo->notas->avg('nota'), 1, ',', '.') : null;
            $percentual = $grupo->progressos->count() ? (int) round($grupo->progressos->avg('percentual')) : 0;
        @endphp
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between gap-2 mb-2">
                        <div>
                            <h2 class="h5 mb-1">{{ $grupo->nome_grupo }}</h2>
                            <p class="text-secondary mb-0">{{ $grupo->turma?->nome_turma }}</p>
                        </div>
                        <span class="badge text-bg-light align-self-start">{{ ucfirst($grupo->status_grupo) }}</span>
                    </div>

                    <div class="mb-3">
                        <div class="text-secondary small">Integrantes</div>
                        <div>{{ $grupo->usuarios->pluck('name')->join(', ') ?: 'Sem integrantes' }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="text-secondary small">Tema</div>
                        <div class="fw-semibold">{{ $tema?->titulo ?? 'Ainda não sorteado' }}</div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="flex-grow-1">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $percentual }}%;" aria-valuenow="{{ $percentual }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="text-secondary small">{{ $percentual }}% de progresso</span>
                        </div>
                        <div class="text-end">
                            <div class="fw-semibold">{{ $media ?? '-' }}</div>
                            <span class="text-secondary small">média</span>
                        </div>
                        <a href="{{ route('grupos.show', $grupo) }}" class="btn btn-outline-primary">Abrir</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info mb-0">{{ $isStaff ? 'Nenhum grupo cadastrado.' : 'Você ainda não participa de nenhum grupo.' }}</div>
        </div>
    @endforelse
</div>

<div class="mt-3">{{ $records->links() }}</div>
@endsection
