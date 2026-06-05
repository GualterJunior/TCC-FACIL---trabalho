@extends('layouts.app')

@section('title', 'Criar grupo - TCC Fácil')

@section('content')
<div class="mb-4">
    <a href="{{ route('aluno.turmas.index') }}" class="text-decoration-none">&larr; Voltar</a>
    <h1 class="h3 mt-2 mb-1">Criar grupo</h1>
    <p class="text-secondary mb-0">{{ $turma->nome_turma }} - {{ $turma->codigo_turma }}</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('aluno.grupos.store', $turma) }}">
            @csrf
            <label class="form-label" for="nome_grupo">Nome do grupo</label>
            <input class="form-control @error('nome_grupo') is-invalid @enderror" id="nome_grupo" name="nome_grupo" value="{{ old('nome_grupo', 'Grupo de '.$turma->nome_turma) }}" required>
            @error('nome_grupo')<div class="invalid-feedback">{{ $message }}</div>@enderror

            <p class="text-secondary mt-3 mb-0">Ao criar o grupo, você será vinculado automaticamente como integrante.</p>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('aluno.turmas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button class="btn btn-primary" type="submit">Criar meu grupo</button>
            </div>
        </form>
    </div>
</div>
@endsection
