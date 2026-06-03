@extends('layouts.app')

@section('title', $title.' - TCC Fácil')

@section('content')
@php
    $isStaff = in_array(strtolower(trim((string) Auth::user()->tipo)), ['professor', 'coordenador'], true);
@endphp

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <a href="{{ route($routeName.'.index') }}" class="text-decoration-none">&larr; Voltar</a>
        <h1 class="h3 mt-2 mb-0">Detalhes de {{ $title }}</h1>
    </div>
    @if ($isStaff && Route::has($routeName.'.edit'))
        <a class="btn btn-primary" href="{{ route($routeName.'.edit', $record) }}">Editar</a>
    @endif
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $record->getKey() }}</dd>

            @foreach ($fields as $name => $field)
                @php($value = $record->{$name} ?? null)
                <dt class="col-sm-3">{{ $field['label'] }}</dt>
                <dd class="col-sm-9">
                    @if (($field['type'] ?? 'text') === 'file' && $value)
                        <a href="{{ asset('storage/'.$value) }}" target="_blank">Abrir arquivo</a>
                    @else
                        {{ $field['options'][$value] ?? $value }}
                    @endif
                </dd>
            @endforeach
        </dl>
    </div>
</div>
@endsection
