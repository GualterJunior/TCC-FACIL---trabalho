@extends('layouts.app')

@section('title', ($isStaff ? 'Entregas' : 'Minhas entregas').' - TCC Fácil')

@section('content')
    <x-crud.page-header
        :title="($isStaff ? 'Entregas' : 'Minhas entregas')"
        subtitle="{{ $isStaff ? 'Acompanhe os arquivos enviados pelos grupos.' : 'Veja seus envios, correções e reenvios.' }}"
    >
        <x-slot name="action">
            <a href="{{ route('entregas.create') }}" class="btn btn-primary">Nova entrega</a>
        </x-slot>
    </x-crud.page-header>

    @unless ($tableExists)
        <div class="alert alert-warning">A tabela de entregas ainda não existe no banco.</div>
    @endunless

    @php
        $fields = [
            [
                'label' => 'Turma',
                'key' => 'turma',
                'value' => fn($entrega) => $entrega->grupo?->turma?->nome_turma,
            ],
            [
                'label' => 'Grupo',
                'key' => 'grupo',
                'value' => fn($entrega) => $entrega->grupo?->nome_grupo,
            ],
            [
                'label' => 'Etapa',
                'key' => 'etapa',
                'value' => fn($entrega) => $entrega->etapa?->nome_etapa,
            ],
            [
                'label' => 'Arquivo',
                'key' => 'caminho_arquivo',
                'value' => fn($entrega) => $entrega->caminho_arquivo,
                'type' => 'file',
                'fileLabel' => null,
            ],
            [
                'label' => 'Status',
                'key' => 'status_Entrega',
                'value' => fn($entrega) => ucfirst(str_replace('_', ' ', (string) $entrega->status_Entrega)),
            ],
            [
                'label' => 'Última correção',
                'key' => 'ultima_correcao',
                'value' => fn($entrega) => (function() use ($entrega) {
                    $correcao = $entrega->correcoes->sortByDesc('id_correcao')->first();
                    return $correcao?->comentario
                        ? \Illuminate\Support\Str::limit($correcao->comentario, 60)
                        : 'Sem correção';
                })(),
            ],
        ];
    @endphp

    <x-crud.card-table :fields="$fields" :records="$records" routeName="entregas" :isStaff="$isStaff" />


    @if (method_exists($records, 'links'))
        <div class="mt-3">{{ $records->links() }}</div>
    @endif
@endsection

