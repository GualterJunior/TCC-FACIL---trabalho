@extends('layouts.app')

@section('title', 'Sorteio - TCC Fácil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <a href="{{ route('sorteios.index') }}" class="text-decoration-none">&larr; Voltar</a>
        <h1 class="h3 mt-2 mb-0">Sorteio de temas</h1>
        <p class="text-secondary mb-0">{{ $record->turma?->nome_turma }} | {{ ucfirst($record->status_sorteio) }}</p>
    </div>
    <form method="POST" action="{{ route('sorteios.executar', $record) }}" onsubmit="return confirm('Executar o sorteio agora? Resultados anteriores deste sorteio serão substituídos.')">
        @csrf
        <button class="btn btn-primary" type="submit">Executar sorteio automático</button>
    </form>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="h5">Resultados publicados</h2>
        <div class="table-responsive mt-3">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Grupo</th>
                        <th>Tema sorteado</th>
                        <th>Área</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($record->resultados as $resultado)
                        <tr>
                            <td>{{ $resultado->grupo?->nome_grupo }}</td>
                            <td>{{ $resultado->tema?->titulo }}</td>
                            <td>{{ $resultado->tema?->area }}</td>
                            <td>{{ $record->data_sorteio }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-secondary py-4">Este sorteio ainda não possui resultados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
