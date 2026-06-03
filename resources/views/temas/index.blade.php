@extends('layouts.app')

@section('title', 'Temas - TCC Fácil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">Temas</h1>
        <p class="text-secondary mb-0">{{ $isStaff ? 'Cadastre e acompanhe os temas disponíveis para sorteio.' : 'Veja os temas cadastrados para as suas turmas.' }}</p>
    </div>
    @if ($isStaff)
        <a href="{{ route('temas.create') }}" class="btn btn-primary">Novo tema</a>
    @endif
</div>

<div class="row g-3">
    @forelse ($temas as $tema)
        <div class="col-md-6 col-xl-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between gap-2 mb-2">
                        <span class="badge text-bg-primary">{{ ucfirst($tema->status_tema) }}</span>
                        <span class="text-secondary small">{{ $tema->turma?->nome_turma }}</span>
                    </div>
                    <h2 class="h5">{{ $tema->titulo }}</h2>
                    <p class="text-secondary">{{ \Illuminate\Support\Str::limit($tema->descricao, 140) }}</p>
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <span class="text-secondary small">{{ $tema->area }}</span>
                        <a href="{{ route('temas.show', $tema) }}" class="btn btn-outline-primary">Ver tema</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info mb-0">Nenhum tema encontrado.</div>
        </div>
    @endforelse
</div>

<div class="mt-3">{{ $temas->links() }}</div>
@endsection
