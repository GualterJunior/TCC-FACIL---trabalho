@extends('layouts.app')

@section('title', $tema->titulo.' - TCC Fácil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-4">
    <div>
        <a href="{{ route('temas.index') }}" class="text-decoration-none">&larr; Voltar</a>
        <h1 class="h3 mt-2 mb-1">{{ $tema->titulo }}</h1>
        <p class="text-secondary mb-0">{{ $tema->turma?->nome_turma }} | {{ ucfirst($tema->status_tema) }}</p>
    </div>
    @if ($isStaff)
        <a href="{{ route('temas.edit', $tema) }}" class="btn btn-primary">Editar</a>
    @endif
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="text-secondary small">Área</div>
                <div class="fw-semibold">{{ $tema->area }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="text-secondary small">Conclusão prevista</div>
                <div class="fw-semibold">{{ $tema->data_conclusao ? \Illuminate\Support\Carbon::parse($tema->data_conclusao)->format('d/m/Y') : 'Não definida' }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="text-secondary small">Status</div>
                <div class="fw-semibold">{{ ucfirst($tema->status_tema) }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="h5">Descrição do tema</h2>
        <p class="text-secondary mb-0">{{ $tema->descricao }}</p>
    </div>
</div>
@endsection
