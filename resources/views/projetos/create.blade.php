@extends('layouts.app')

@section('title', 'Novo projeto - TCC Fácil')

@section('content')
<div class="mb-4">
    <a href="{{ route('projetos.index') }}" class="text-decoration-none">&larr; Voltar</a>
    <h1 class="h3 mt-2 mb-0">Cadastrar projeto</h1>
    <p class="text-secondary mb-0">Publique projetos de referência com banner e PDF.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('projetos.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="titulo">Título</label>
                    <input class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                    @error('titulo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="autor">Autor ou grupo</label>
                    <input class="form-control @error('autor') is-invalid @enderror" id="autor" name="autor" value="{{ old('autor') }}" required>
                    @error('autor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="publicado" @selected(old('status', 'publicado') === 'publicado')>Publicado</option>
                        <option value="rascunho" @selected(old('status') === 'rascunho')>Rascunho</option>
                        <option value="arquivado" @selected(old('status') === 'arquivado')>Arquivado</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="banner_path">Banner</label>
                    <input class="form-control @error('banner_path') is-invalid @enderror" id="banner_path" name="banner_path" type="file" accept="image/*" required>
                    @error('banner_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="pdf_path">PDF do projeto</label>
                    <input class="form-control @error('pdf_path') is-invalid @enderror" id="pdf_path" name="pdf_path" type="file" accept="application/pdf" required>
                    @error('pdf_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="descricao">Descrição</label>
                    <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="5" required>{{ old('descricao') }}</textarea>
                    @error('descricao')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('projetos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button class="btn btn-primary" type="submit">Salvar projeto</button>
            </div>
        </form>
    </div>
</div>
@endsection
