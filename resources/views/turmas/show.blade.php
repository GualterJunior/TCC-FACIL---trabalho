@extends('layouts.app')

@section('title', $turma->nome_turma . ' - TCC Fácil')

@section('content')

@php
    $user = auth()->user();

    $isAluno = $user?->isAluno();

    $grupoDoUsuario = $turma->grupoDoUsuario($user?->id);

    $jaPossuiGrupo = !is_null($grupoDoUsuario);
@endphp

<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-4">

    <div>
        <a
            href="{{ route('turmas.index') }}"
            class="text-decoration-none"
        >
            &larr; Voltar
        </a>

        <h1 class="h3 mt-2 mb-1">
            {{ $turma->nome_turma }}
        </h1>

        <p class="text-secondary mb-0">
            Código: {{ $turma->codigo_turma }}
            |
            {{ $turma->semestre }}
            |
            {{ ucfirst($turma->status_turma) }}
        </p>
    </div>

    <div class="d-flex flex-wrap gap-2">

        @if(!$isAluno)

            <a
                href="{{ route('grupos.create', ['turma' => $turma->id_turma]) }}"
                class="btn btn-primary"
            >
                Criar grupo nesta turma
            </a>

            <a
                href="{{ route('sorteios.create') }}"
                class="btn btn-outline-primary"
            >
                Criar sorteio
            </a>

            <a
                href="{{ route('turmas.edit', $turma) }}"
                class="btn btn-outline-secondary"
            >
                Editar turma
            </a>

        @endif

    </div>

</div>

<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">

                <div class="text-secondary small">
                    Professor
                </div>

                <div class="fw-semibold">
                    {{ $turma->professor?->name }}
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">

                <div class="text-secondary small">
                    Grupos
                </div>

                <div class="display-6 fw-bold text-primary">
                    {{ $turma->grupos->count() }}
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">

                <div class="text-secondary small">
                    Temas
                </div>

                <div class="display-6 fw-bold text-primary">
                    {{ $turma->temas->count() }}
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">

                <div class="text-secondary small">
                    Etapas
                </div>

                <div class="display-6 fw-bold text-primary">
                    {{ $turma->etapas->count() }}
                </div>

            </div>
        </div>
    </div>

</div>

@if($isAluno && $jaPossuiGrupo)

    <div class="alert alert-success shadow-sm">

        <strong>Seu grupo nesta turma:</strong>

        {{ $grupoDoUsuario->nome_grupo }}

    </div>

@endif

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">
                Grupos da turma
            </h2>
            @if($isAluno && !$jaPossuiGrupo)
                <span class="badge bg-primary">
                    Escolha um grupo
                </span>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Grupo</th>
                        <th>Integrantes</th>
                        <th>Status</th>
                        <th>Vagas</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($turma->grupos as $grupo)
                        @php
                            $quantidade = $grupo->usuarios->count();

                            $grupoCheio = $quantidade >= 3;

                            $usuarioNoGrupo =
                                $grupo->usuarios->contains('id', $user?->id);
                        @endphp
                        <tr>
                            <td class="fw-semibold">
                                {{ $grupo->nome_grupo }}
                            </td>
                            <td>
                                @if($grupo->usuarios->count())

                                    {{ $grupo->usuarios->pluck('name')->join(', ') }}
                                @else
                                    <span class="text-secondary">
                                        Sem integrantes
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ ucfirst($grupo->status_grupo) }}
                            </td>
                            <td>
                                {{ $quantidade }}/3
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a
                                        href="{{ route('grupos.show', $grupo) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Abrir
                                    </a>
                                    @if($isAluno)
                                        {{-- aluno já está no grupo --}}
                                        @if($usuarioNoGrupo)
                                            <button
                                                class="btn btn-sm btn-success"
                                                disabled
                                            >
                                                Seu grupo
                                            </button>
                                        {{-- aluno ainda não possui grupo --}}
                                        @elseif(!$jaPossuiGrupo)
                                            {{-- grupo disponível --}}
                                            @if(!$grupoCheio)
                                                <form
                                                    method="POST"
                                                    action="{{ route('turmas.entrarGrupo', $turma) }}"
                                                >
                                                    @csrf
                                                    <input
                                                        type="hidden"
                                                        name="grupo_id"
                                                        value="{{ $grupo->id_grupo }}"
                                                    >
                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-primary"
                                                    >
                                                        Entrar
                                                    </button>
                                                </form>
                                            @else
                                                <button
                                                    class="btn btn-sm btn-secondary"
                                                    disabled
                                                >
                                                    Grupo cheio
                                                </button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="5"
                                class="text-center text-secondary py-4"
                            >
                                Nenhum grupo criado para esta turma.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
