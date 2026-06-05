@extends('layouts.app')

@section('title', 'Novo tema - TCC Fácil')

@section('content')
<div class="mb-4">
    <a href="{{ route('temas.index') }}" class="text-decoration-none">&larr; Voltar</a>
    <h1 class="h3 mt-2 mb-0">Cadastrar tema</h1>
    <p class="text-secondary mb-0">Cadastre temas que poderão ser sorteados entre os grupos.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('temas.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="titulo">Título</label>
                    <input class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                    @error('titulo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="area">Área</label>
                    <input class="form-control @error('area') is-invalid @enderror" id="area" name="area" value="{{ old('area') }}" required>
                    @error('area')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="id_turma">Turma</label>
                    <select class="form-select @error('id_turma') is-invalid @enderror" id="id_turma" name="id_turma" required>
                        <option value="">Selecione...</option>
                        @foreach ($turmas as $turma)
                            <option value="{{ $turma->id_turma }}" @selected(old('id_turma') == $turma->id_turma)>{{ $turma->nome_turma }} - {{ $turma->codigo_turma }}</option>
                        @endforeach
                    </select>
                    @error('id_turma')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="data_conclusao">Data de conclusão</label>
                    <input class="form-control" id="data_conclusao" name="data_conclusao" type="date" value="{{ old('data_conclusao') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="status_tema">Status</label>
                    <select class="form-select" id="status_tema" name="status_tema">
                        <option value="disponivel" @selected(old('status_tema', 'disponivel') === 'disponivel')>Disponível</option>
                        <option value="reservado" @selected(old('status_tema') === 'reservado')>Reservado</option>
                        <option value="aprovado" @selected(old('status_tema') === 'aprovado')>Aprovado</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label" for="descricao">Descrição</label>
                    <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="5" required>{{ old('descricao') }}</textarea>
                    @error('descricao')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('temas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button class="btn btn-primary" type="submit">Salvar tema</button>
            </div>
        </form>
    </div>
</div>
@endsection
