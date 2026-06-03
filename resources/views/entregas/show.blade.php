@extends('layouts.app')

@section('title', 'Entrega - TCC Fácil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-4">
    <div>
        <a href="{{ route('entregas.index') }}" class="text-decoration-none">&larr; Voltar</a>
        <h1 class="h3 mt-2 mb-1">{{ $entrega->etapa?->nome_etapa }}</h1>
        <p class="text-secondary mb-0">{{ $entrega->grupo?->turma?->nome_turma }} | {{ $entrega->grupo?->nome_grupo }}</p>
    </div>
    <a href="{{ asset('storage/'.$entrega->caminho_arquivo) }}" target="_blank" class="btn btn-outline-primary">Abrir arquivo atual</a>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h2 class="h5">Dados da entrega</h2>
                <dl class="row mb-0">
                    <dt class="col-sm-4">Arquivo</dt>
                    <dd class="col-sm-8">{{ $entrega->nome_arquivo }}</dd>
                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">{{ ucfirst(str_replace('_', ' ', $entrega->status_Entrega)) }}</dd>
                    <dt class="col-sm-4">Observação</dt>
                    <dd class="col-sm-8">{{ $entrega->observacao ?: 'Sem observação.' }}</dd>
                </dl>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5">Histórico de correções</h2>
                @forelse ($entrega->correcoes->sortByDesc('id_correcao') as $correcao)
                    <div class="border-top py-3">
                        <div class="d-flex justify-content-between gap-2">
                            <strong>{{ ucfirst($correcao->status_correcao) }}</strong>
                            <span class="text-secondary small">{{ $correcao->created_at?->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="text-secondary small">{{ $correcao->professor?->name }}</div>
                        <p class="mb-0">{{ $correcao->comentario }}</p>
                    </div>
                @empty
                    <p class="text-secondary mb-0">Nenhuma correção registrada ainda.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5">Reenviar entrega</h2>
                <form method="POST" action="{{ route('entregas.reenviar', $entrega) }}" enctype="multipart/form-data">
                    @csrf
                    <label class="form-label" for="caminho_arquivo">Novo arquivo</label>
                    <input class="form-control @error('caminho_arquivo') is-invalid @enderror" id="caminho_arquivo" name="caminho_arquivo" type="file" accept=".pdf,.doc,.docx,.zip,.rar" required>
                    @error('caminho_arquivo')<div class="invalid-feedback">{{ $message }}</div>@enderror

                    <label class="form-label mt-3" for="observacao">Observação do reenvio</label>
                    <textarea class="form-control" id="observacao" name="observacao" rows="4"></textarea>

                    <button class="btn btn-primary mt-3" type="submit">Reenviar para avaliação</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
