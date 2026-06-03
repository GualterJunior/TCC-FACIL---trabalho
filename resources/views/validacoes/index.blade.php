@extends('layouts.app')

@section('title', 'Validações - TCC Fácil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">Validação de entregas</h1>
        <p class="text-secondary mb-0">Analise arquivos enviados pelos grupos e registre aprovação, reprovação ou pendência.</p>
    </div>
</div>

@forelse ($entregas as $entrega)
    @php($validacao = $entrega->ultimaValidacao)
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row g-3 align-items-start">
                <div class="col-lg-5">
                    <div class="text-secondary small">{{ $entrega->grupo?->turma?->nome_turma }} | {{ $entrega->grupo?->nome_grupo }}</div>
                    <h2 class="h5 mb-1">{{ $entrega->etapa?->nome_etapa }}</h2>
                    <p class="text-secondary mb-2">{{ $entrega->observacao ?: 'Sem observação do grupo.' }}</p>
                    <a href="{{ asset('storage/'.$entrega->caminho_arquivo) }}" target="_blank" class="btn btn-outline-secondary btn-sm">Abrir arquivo</a>
                </div>
                <div class="col-lg-3">
                    <div class="text-secondary small">Última validação</div>
                    <div class="fw-semibold">{{ ucfirst($validacao?->status_validacao ?? 'pendente') }}</div>
                    <div class="text-secondary small">{{ $validacao?->professor?->name }}</div>
                    <p class="text-secondary mb-0">{{ $validacao?->comentario }}</p>
                </div>
                <div class="col-lg-4">
                    <form method="POST" action="{{ route('validacoes.store') }}">
                        @csrf
                        <input type="hidden" name="id_entrega" value="{{ $entrega->id_entrega }}">
                        <input type="hidden" name="id_professor" value="{{ Auth::id() }}">
                        <label class="form-label" for="status_validacao_{{ $entrega->id_entrega }}">Status</label>
                        <select class="form-select" id="status_validacao_{{ $entrega->id_entrega }}" name="status_validacao">
                            <option value="pendente">Pendente</option>
                            <option value="aprovado">Aprovado</option>
                            <option value="reprovado">Reprovado</option>
                        </select>
                        <label class="form-label mt-2" for="comentario_{{ $entrega->id_entrega }}">Comentário</label>
                        <textarea class="form-control" id="comentario_{{ $entrega->id_entrega }}" name="comentario" rows="2"></textarea>
                        <button class="btn btn-primary mt-2" type="submit">Salvar validação</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">Nenhuma entrega enviada para validação.</div>
@endforelse

<div class="mt-3">{{ $entregas->links() }}</div>
@endsection
