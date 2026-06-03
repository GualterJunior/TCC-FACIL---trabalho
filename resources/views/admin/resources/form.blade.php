@extends('layouts.app')

@section('title', ($record ? 'Editar ' : 'Cadastrar ').$title.' - TCC Fácil')

@section('content')
<div class="mb-4">
    <a href="{{ route($routeName.'.index') }}" class="text-decoration-none">&larr; Voltar</a>
    <h1 class="h3 mt-2 mb-0">{{ $record ? 'Editar '.$title : 'Cadastrar '.$title }}</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <div class="row g-3">
                @foreach ($fields as $name => $field)
                    @php($type = $field['type'] ?? 'text')
                    @php($value = old($name, $record?->{$name}))
                    <div class="{{ $type === 'textarea' ? 'col-12' : 'col-md-6' }}">
                        <label class="form-label" for="{{ $name }}">{{ $field['label'] }}</label>

                        @if ($type === 'textarea')
                            <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" rows="4">{{ $value }}</textarea>
                        @elseif ($type === 'select')
                            <select class="form-select @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">
                                <option value="">Selecione...</option>
                                @foreach (($field['options'] ?? []) as $optionValue => $optionLabel)
                                    <option value="{{ $optionValue }}" @selected((string) $value === (string) $optionValue)>{{ $optionLabel }}</option>
                                @endforeach
                            </select>
                        @elseif ($type === 'file')
                            <input class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" type="file" accept="{{ $field['accept'] ?? '' }}">
                            @if ($record && $record->{$name})
                                <div class="form-text">
                                    Arquivo atual: <a href="{{ asset('storage/'.$record->{$name}) }}" target="_blank">abrir</a>
                                </div>
                            @endif
                        @else
                            <input class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ $type === 'password' ? '' : $value }}">
                        @endif

                        @error($name)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route($routeName.'.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection
