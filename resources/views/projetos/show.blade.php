@extends('layouts.app')

@section('title', $projeto->titulo.' - TCC Fácil')

@section('content')
<div class="mb-4">
    <a href="{{ route('projetos.index') }}" class="text-decoration-none">&larr; Voltar</a>
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mt-2">
        <div>
            <h1 class="h3 mb-1">{{ $projeto->titulo }}</h1>
            <p class="text-secondary mb-0">{{ $projeto->autor }} | {{ ucfirst($projeto->status) }}</p>
        </div>
        @if ($isStaff)
            <a href="{{ route('projetos.edit', $projeto) }}" class="btn btn-primary">Editar</a>
        @endif
    </div>
</div>

@if ($projeto->banner_path)
    <img src="{{ asset('storage/'.$projeto->banner_path) }}" class="w-100 rounded border mb-4" alt="{{ $projeto->titulo }}" style="max-height: 360px; object-fit: cover;">
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="h5">Descrição</h2>
        <p class="text-secondary">{{ $projeto->descricao }}</p>
        @if ($projeto->pdf_path)
            <a href="{{ asset('storage/'.$projeto->pdf_path) }}" target="_blank" class="btn btn-outline-primary">Abrir PDF do projeto</a>
        @endif
    </div>
</div>
@endsection
