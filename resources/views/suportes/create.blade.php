@extends('layouts.app')

@section('title', 'Nova solicitacao - TCC Facil')

@section('content')
<div class="mb-4">
    <a href="{{ route('suportes.index') }}" class="text-decoration-none">&larr; Voltar</a>
    <h1 class="h3 mt-2 mb-0">Nova solicitacao</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('suportes.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="id_turma">Turma</label>
                    <select class="form-select" id="id_turma" name="id_turma">
                        <option value="">Sem turma especifica</option>
                        @foreach ($turmas as $id => $nome)
                            <option value="{{ $id }}" @selected(old('id_turma') == $id)>{{ $nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="assunto">Assunto</label>
                    <input class="form-control @error('assunto') is-invalid @enderror" id="assunto" name="assunto" value="{{ old('assunto') }}" required>
                    @error('assunto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="mensagem">Mensagem</label>
                    <textarea class="form-control @error('mensagem') is-invalid @enderror" id="mensagem" name="mensagem" rows="5" required>{{ old('mensagem') }}</textarea>
                    @error('mensagem')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('suportes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
    </div>
</div>
@endsection
