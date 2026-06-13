@extends('layouts.app')

@section('title', 'Nova entrega - TCC Facil')

@section('content')
<div class="mb-4">
    <a href="{{ route('entregas.index') }}" class="text-decoration-none">&larr; Voltar</a>
    <h1 class="h3 mt-2 mb-1">Nova entrega</h1>
    <p class="text-secondary mb-0">
        Envie o arquivo da etapa para avaliacao. Formatos aceitos: PDF, DOC, DOCX, ZIP ou RAR.
    </p>
</div>

@if (empty($fields['id_grupo']['options']) || empty($fields['id_etapa']['options']))
    <div class="alert alert-warning">
        Cadastre ou vincule um grupo e uma etapa antes de enviar uma entrega.
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('entregas.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="id_grupo">Grupo</label>
                    <select class="form-select @error('id_grupo') is-invalid @enderror" id="id_grupo" name="id_grupo" required>
                        <option value="">Selecione...</option>
                        @foreach (($fields['id_grupo']['options'] ?? []) as $id => $nome)
                            <option value="{{ $id }}" @selected((string) old('id_grupo') === (string) $id)>{{ $nome }}</option>
                        @endforeach
                    </select>
                    @error('id_grupo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="id_etapa">Etapa</label>
                    <select class="form-select @error('id_etapa') is-invalid @enderror" id="id_etapa" name="id_etapa" required>
                        <option value="">Selecione...</option>
                        @foreach (($fields['id_etapa']['options'] ?? []) as $id => $nome)
                            <option value="{{ $id }}" @selected((string) old('id_etapa') === (string) $id)>{{ $nome }}</option>
                        @endforeach
                    </select>
                    @error('id_etapa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="nome_arquivo">Nome do arquivo</label>
                    <input
                        class="form-control @error('nome_arquivo') is-invalid @enderror"
                        id="nome_arquivo"
                        name="nome_arquivo"
                        type="text"
                        value="{{ old('nome_arquivo') }}"
                        placeholder="Opcional; se vazio, usa o nome original"
                    >
                    @error('nome_arquivo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if (isset($fields['status_Entrega']))
                    <div class="col-md-6">
                        <label class="form-label" for="status_Entrega">Status</label>
                        <select class="form-select @error('status_Entrega') is-invalid @enderror" id="status_Entrega" name="status_Entrega" required>
                            @foreach (($fields['status_Entrega']['options'] ?? []) as $status => $label)
                                <option value="{{ $status }}" @selected(old('status_Entrega', 'enviado') === $status)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status_Entrega')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <div class="col-md-6">
                    <label class="form-label" for="caminho_arquivo">Arquivo da etapa</label>
                    <input
                        class="form-control @error('caminho_arquivo') is-invalid @enderror"
                        id="caminho_arquivo"
                        name="caminho_arquivo"
                        type="file"
                        accept=".pdf,.doc,.docx,.zip,.rar"
                        required
                    >
                    <div class="form-text">Tamanho maximo: 20 MB.</div>
                    @error('caminho_arquivo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label" for="observacao">Observacao</label>
                    <textarea
                        class="form-control @error('observacao') is-invalid @enderror"
                        id="observacao"
                        name="observacao"
                        rows="4"
                        placeholder="Opcional"
                    >{{ old('observacao') }}</textarea>
                    @error('observacao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('entregas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button class="btn btn-primary" type="submit">Enviar entrega</button>
            </div>
        </form>
    </div>
</div>
@endsection
