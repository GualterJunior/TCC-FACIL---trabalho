@extends('layouts.app')

@section('title', ($isStaff ? 'Entregas' : 'Minhas entregas').' - TCC Fácil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">{{ $isStaff ? 'Entregas' : 'Minhas entregas' }}</h1>
        <p class="text-secondary mb-0">{{ $isStaff ? 'Acompanhe os arquivos enviados pelos grupos.' : 'Veja seus envios, correções e reenvios.' }}</p>
    </div>
    <a href="{{ route('entregas.create') }}" class="btn btn-primary">Nova entrega</a>
</div>

@unless ($tableExists)
    <div class="alert alert-warning">A tabela de entregas ainda não existe no banco.</div>
@endunless

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Turma</th>
                    <th>Grupo</th>
                    <th>Etapa</th>
                    <th>Arquivo</th>
                    <th>Status</th>
                    <th>Última correção</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($records as $entrega)
                    @php($correcao = $entrega->correcoes->sortByDesc('id_correcao')->first())
                    <tr>
                        <td>{{ $entrega->grupo?->turma?->nome_turma }}</td>
                        <td>{{ $entrega->grupo?->nome_grupo }}</td>
                        <td>{{ $entrega->etapa?->nome_etapa }}</td>
                        <td><a href="{{ asset('storage/'.$entrega->caminho_arquivo) }}" target="_blank">{{ $entrega->nome_arquivo }}</a></td>
                        <td>{{ ucfirst(str_replace('_', ' ', $entrega->status_Entrega)) }}</td>
                        <td>{{ $correcao?->comentario ? \Illuminate\Support\Str::limit($correcao->comentario, 60) : 'Sem correção' }}</td>
                        <td class="text-end">
                            <a href="{{ route('entregas.show', $entrega) }}" class="btn btn-sm btn-outline-primary">Abrir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-secondary py-4">Nenhuma entrega encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $records->links() }}</div>
@endsection
