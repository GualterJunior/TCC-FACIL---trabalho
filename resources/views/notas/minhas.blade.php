@extends('layouts.app')

@section('title', 'Minhas notas - TCC Fácil')

@section('content')
<div class="mb-4">
    <h1 class="h3 mb-1">Minhas notas</h1>
    <p class="text-secondary mb-0">Consulte as notas lançadas para os seus grupos de TCC.</p>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Turma</th>
                    <th>Grupo</th>
                    <th>Nota</th>
                    <th>Professor</th>
                    <th>Comentário</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notas as $nota)
                    <tr>
                        <td>{{ $nota->grupo?->turma?->nome_turma }}</td>
                        <td>{{ $nota->grupo?->nome_grupo }}</td>
                        <td class="fw-semibold">{{ number_format($nota->nota, 1, ',', '.') }}</td>
                        <td>{{ $nota->professor?->name }}</td>
                        <td>{{ $nota->comentario ?: 'Sem comentário' }}</td>
                        <td>{{ $nota->created_at?->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-secondary py-4">Nenhuma nota lançada para seus grupos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $notas->links() }}</div>
@endsection
