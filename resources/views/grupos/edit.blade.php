@extends('layouts.app')

@section('title', 'Editar grupo - TCC Fácil')

@section('content')

<div class="mb-4">

    <a href="{{ route('grupos.show', $grupo) }}" class="text-decoration-none">
        &larr; Voltar
    </a>

    <h1 class="h3 mt-2 mb-0">
        Editar grupo
    </h1>

    <p class="text-secondary mb-0">
        {{ $grupo->turma?->nome_turma }}
        |
        {{ $grupo->nome_grupo }}
    </p>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        <form method="POST" action="{{ route('grupos.update', $grupo) }}">

            @csrf
            @method('PUT')

            <div class="row g-3">

                {{-- Nome do grupo --}}
                <div class="col-md-6">

                    <label class="form-label" for="nome_grupo">
                        Nome do grupo
                    </label>

                    <input
                        type="text"
                        class="form-control @error('nome_grupo') is-invalid @enderror"
                        id="nome_grupo"
                        name="nome_grupo"
                        value="{{ old('nome_grupo', $grupo->nome_grupo) }}"
                        required
                    >

                    @error('nome_grupo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Status --}}
                <div class="col-md-6">

                    <label class="form-label" for="status_grupo">
                        Status
                    </label>

                    <select
                        class="form-select @error('status_grupo') is-invalid @enderror"
                        id="status_grupo"
                        name="status_grupo"
                        required
                    >

                        <option
                            value="ativo"
                            @selected(old('status_grupo', $grupo->status_grupo) === 'ativo')
                        >
                            Ativo
                        </option>

                        <option
                            value="inativo"
                            @selected(old('status_grupo', $grupo->status_grupo) === 'inativo')
                        >
                            Inativo
                        </option>

                    </select>

                    @error('status_grupo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Integrantes --}}
                <div class="col-12">

                    <label class="form-label" for="integrantes">
                        Integrantes (até 3)
                    </label>

                    @php

                        $usuariosIds = $grupo->usuarios
                            ? $grupo->usuarios->pluck('id')->toArray()
                            : [];

                        $old = old('integrantes', $usuariosIds);

                        $integranteIds = is_array($old)
                            ? $old
                            : [$old];

                    @endphp

                    <select
                        class="form-select @error('integrantes') is-invalid @enderror"
                        id="integrantes"
                        name="integrantes[]"
                        multiple
                        size="6"
                    >

                        @foreach (($alunos ?? collect()) as $aluno)

                            @php

                                $alunoId = data_get($aluno, 'id');

                                $isSelected = in_array(
                                    (string) $alunoId,
                                    array_map('strval', $integranteIds),
                                    true
                                );

                            @endphp

                            <option
                                value="{{ data_get($aluno, 'id') }}"
                                @selected($isSelected)
                            >
                                {{ data_get($aluno, 'name') }}
                                -
                                {{ data_get($aluno, 'email') }}
                            </option>

                        @endforeach

                    </select>

                    @error('integrantes')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">

                <a
                    href="{{ route('grupos.show', $grupo) }}"
                    class="btn btn-outline-secondary"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Salvar alterações
                </button>

            </div>

        </form>

    </div>

</div>
@endsection
