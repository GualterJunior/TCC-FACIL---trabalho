@extends('layouts.app')

@section('title', 'Novo grupo - TCC Fácil')

@section('content')
<div class="mb-4">
    <a href="{{ route('grupos.index') }}" class="text-decoration-none">&larr; Voltar</a>
    <h1 class="h3 mt-2 mb-0">Criar grupo</h1>
    <p class="text-secondary mb-0">Crie um grupo dentro de uma turma e, se quiser, já vincule até 3 alunos.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('grupos.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="nome_grupo">Nome do grupo</label>
                    <input class="form-control @error('nome_grupo') is-invalid @enderror" id="nome_grupo" name="nome_grupo" value="{{ old('nome_grupo') }}" required>
                    @error('nome_grupo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="id_turma">Turma</label>
                    <select class="form-select @error('id_turma') is-invalid @enderror" id="id_turma" name="id_turma" required>
                        <option value="">Selecione...</option>
                        @foreach ($turmas as $turma)
                            <option value="{{ $turma->id_turma }}" @selected((string) old('id_turma', $turmaSelecionada) === (string) $turma->id_turma)>{{ $turma->nome_turma }} - {{ $turma->codigo_turma }}</option>
                        @endforeach
                    </select>
                    @error('id_turma')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="status_grupo">Status</label>
                    <select class="form-select" id="status_grupo" name="status_grupo">
                        <option value="ativo" @selected(old('status_grupo', 'ativo') === 'ativo')>Ativo</option>
                        <option value="inativo" @selected(old('status_grupo') === 'inativo')>Inativo</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label" for="integrantes">Integrantes</label>
                    <select class="form-select @error('integrantes') is-invalid @enderror" id="integrantes" name="integrantes[]" multiple size="8">
                        @foreach ($alunos as $aluno)
                            <option value="{{ $aluno->id }}" @selected(in_array($aluno->id, old('integrantes', [])))>{{ $aluno->name }} - {{ $aluno->email }}</option>
                        @endforeach
                    </select>
                    <div class="form-text">Segure Ctrl para selecionar mais de um aluno. Limite: 3 integrantes.</div>
                    @error('integrantes')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('grupos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button class="btn btn-primary" type="submit">Criar grupo</button>
            </div>
        </form>
    </div>
</div>
@endsection
