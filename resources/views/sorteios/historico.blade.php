@extends('layouts.app')

@section('title', 'Historico de sorteios - TCC Facil')

@section('content')
<div class="mb-4">
    <h1 class="h3 mb-1">Historico de sorteios</h1>
    <p class="text-secondary mb-0">Consulta dos temas distribuidos para cada grupo.</p>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Turma</th>
                    <th>Grupo</th>
                    <th>Tema</th>
                    <th>Area</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($resultados as $resultado)
                    <tr>
                        <td>{{ $resultado->sorteio?->turma?->nome_turma }}</td>
                        <td>{{ $resultado->grupo?->nome_grupo }}</td>
                        <td>{{ $resultado->tema?->titulo }}</td>
                        <td>{{ $resultado->tema?->area }}</td>
                        <td>{{ $resultado->created_at?->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-secondary py-4">Nenhum sorteio realizado ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $resultados->links() }}</div>
@endsection
