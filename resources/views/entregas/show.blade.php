@extends('layouts.app')

@section('title', 'Entrega - TCC Fácil')

@section('content')
    @php
        $isStaff = in_array(strtolower(trim((string) Auth::user()->tipo)), ['professor', 'coordenador'], true);
    @endphp

    <x-crud.page-header
        :title="'Entrega'"
        :subtitle="($isStaff ? 'Detalhes para professores/coordenadores' : 'Detalhes da sua entrega')"
    >
        <x-slot name="action">
            <a href="{{ asset('storage/'.$entrega->caminho_arquivo) }}" target="_blank" class="btn btn-outline-primary">Abrir arquivo</a>
        </x-slot>

        <x-slot name="backUrl">
            {{ route('entregas.index') }}
        </x-slot>
    </x-crud.page-header>

    @php
        $detailItems = [
            ['label' => 'ID', 'value' => $entrega->getKey()],
            ['label' => 'Arquivo', 'type' => 'file', 'value' => $entrega->nome_arquivo, 'filePath' => $entrega->caminho_arquivo],
            ['label' => 'Status', 'value' => ucfirst(str_replace('_', ' ', $entrega->status_Entrega))],
            ['label' => 'Observação', 'value' => $entrega->observacao ?: 'Sem observação.'],
            ['label' => 'Etapa', 'value' => $entrega->etapa?->nome_etapa],
            ['label' => 'Turma/Grupo', 'value' => ($entrega->grupo?->turma?->nome_turma ?? '—') . ' | ' . ($entrega->grupo?->nome_grupo ?? '—')],
        ];
    @endphp

    <x-crud.detail-card title="Dados da entrega" :items="$detailItems" />

    <div class="row g-3 mt-1">
        <div class="col-lg-7">
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
                        @error('caminho_arquivo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label class="form-label mt-3" for="observacao">Observação do reenvio</label>
                        <textarea class="form-control" id="observacao" name="observacao" rows="4"></textarea>

                        <button class="btn btn-primary mt-3" type="submit">Reenviar para avaliação</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


