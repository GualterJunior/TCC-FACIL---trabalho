@extends('layouts.app')

@section('title', $title.' - TCC Facil')

@section('content')
@php
    $isStaff = in_array(strtolower(trim((string) Auth::user()->tipo)), ['professor', 'coordenador'], true);
    $canCreate = $isStaff || $routeName === 'entregas';
@endphp

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">{{ $title }}</h1>
        <p class="text-secondary mb-0">Listagem, cadastro, edicao e exclusao de registros.</p>
    </div>
    @if ($canCreate && Route::has($routeName.'.create'))
        <a href="{{ route($routeName.'.create') }}" class="btn btn-primary">Novo cadastro</a>
    @endif
</div>

@unless ($tableExists)
    <div class="alert alert-warning">
        A tabela deste modulo ainda nao existe no banco. Rode as migrations para liberar o cadastro.
    </div>
@endunless

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    @foreach ($fields as $name => $field)
                        <th>{{ $field['label'] }}</th>
                    @endforeach
                    <th class="text-end">Acoes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($records as $record)
                    <tr>
                        <td>{{ $record->getKey() }}</td>
                        @foreach ($fields as $name => $field)
                            @php($value = $record->{$name} ?? null)
                            <td>
                                @if (($field['type'] ?? 'text') === 'file' && $value)
                                    <a href="{{ asset('storage/'.$value) }}" target="_blank">Ver arquivo</a>
                                @elseif (($field['type'] ?? 'text') === 'textarea')
                                    {{ \Illuminate\Support\Str::limit($value, 70) }}
                                @else
                                    {{ $field['options'][$value] ?? $value }}
                                @endif
                            </td>
                        @endforeach
                        <td class="text-end">
                            <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-outline-secondary" href="{{ route($routeName.'.show', $record) }}">Ver</a>
                                @if ($isStaff && Route::has($routeName.'.edit'))
                                    <a class="btn btn-outline-primary" href="{{ route($routeName.'.edit', $record) }}">Editar</a>
                                @endif
                                @if ($isStaff && Route::has($routeName.'.destroy'))
                                    <form method="POST" action="{{ route($routeName.'.destroy', $record) }}" onsubmit="return confirm('Deseja remover este registro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger rounded-start-0" type="submit">Excluir</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($fields) + 2 }}" class="text-center text-secondary py-4">Nenhum registro encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if (method_exists($records, 'links'))
    <div class="mt-3">{{ $records->links() }}</div>
@endif
@endsection
