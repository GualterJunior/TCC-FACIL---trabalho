@extends('layouts.app')

@section('title', 'Minhas turmas - TCC Fácil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">Turmas</h1>
        <p class="text-secondary mb-0">Busque uma turma pelo codigo compartilhado pelo professor e acompanhe seu grupo.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5">Entrar em uma turma</h2>
                <form method="GET" action="{{ route('aluno.turmas.index') }}" class="mt-3">
                    <label class="form-label" for="busca">Código ou nome da turma</label>
                    <div class="input-group">
                        <input class="form-control" id="busca" name="busca" value="{{ $busca }}" placeholder="Ex.: ES-2024-2">
                        <button class="btn btn-outline-primary" type="submit">Buscar</button>
                    </div>
                </form>

                <form method="POST" action="{{ route('aluno.turmas.entrar') }}" class="mt-3">
                    @csrf
                    <label class="form-label" for="codigo_turma">Entrar pelo codigo exato</label>
                    <div class="input-group">
                        <input class="form-control @error('codigo_turma') is-invalid @enderror" id="codigo_turma" name="codigo_turma" value="{{ old('codigo_turma', $busca) }}" required>
                        <button class="btn btn-primary" type="submit">Entrar</button>
                        @error('codigo_turma')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>

        @if ($busca !== '')
            <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <h2 class="h6 text-secondary">Resultado da busca</h2>
                    @forelse ($turmas as $turma)
                        <div class="border rounded p-3 mb-2">
                            <div class="fw-semibold">{{ $turma->nome_turma }}</div>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <form method="POST" action="{{ route('aluno.turmas.entrar') }}">
                                    @csrf
                                    <input type="hidden" name="codigo_turma" value="{{ $turma->codigo_turma }}">
                                    <button class="btn btn-sm btn-primary" type="submit">Entrar em grupo com vaga</button>
                                </form>
                                <a href="{{ route('aluno.grupos.create', $turma) }}" class="btn btn-sm btn-outline-primary">Criar grupo</a>
                            </div>
                            <div class="text-secondary small">Código: {{ $turma->codigo_turma }} | Grupos: {{ $turma->grupos_count }}</div>
                        </div>
                    @empty
                        <p class="text-secondary mb-0">Nenhuma turma encontrada.</p>
                    @endforelse
                </div>
            </div>
        @endif
    </div>

    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5">Minhas turmas e grupos</h2>
                <div class="table-responsive mt-3">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Turma</th>
                                <th>Código</th>
                                <th>Grupo</th>
                                <th>Semestre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($minhasTurmas as $turma)
                                <tr>
                                    <td>{{ $turma->nome_turma }}</td>
                                    <td>{{ $turma->codigo_turma }}</td>
                                    <td>{{ $turma->grupos->pluck('nome_grupo')->join(', ') }}</td>
                                    <td>{{ $turma->semestre }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary py-4">Você ainda não entrou em nenhuma turma.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
