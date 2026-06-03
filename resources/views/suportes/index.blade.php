@extends('layouts.app')

@section('title', 'Suporte - TCC Facil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">Suporte</h1>
        <p class="text-secondary mb-0">Duvidas sobre turma, grupo, tema sorteado ou etapas do TCC.</p>
    </div>
    <a href="{{ route('suportes.create') }}" class="btn btn-primary">Nova solicitacao</a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Assunto</th>
                    <th>Usuario</th>
                    <th>Turma</th>
                    <th>Status</th>
                    <th class="text-end">Acoes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suportes as $suporte)
                    <tr>
                        <td>{{ $suporte->assunto }}</td>
                        <td>{{ $suporte->usuario?->name }}</td>
                        <td>{{ $suporte->turma?->nome_turma ?? '-' }}</td>
                        <td>{{ ucfirst($suporte->status_suporte) }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('suportes.show', $suporte) }}">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-secondary py-4">Nenhuma solicitacao registrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $suportes->links() }}</div>
@endsection
