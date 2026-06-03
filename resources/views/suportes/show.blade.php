@extends('layouts.app')

@section('title', 'Suporte - TCC Facil')

@section('content')
<div class="mb-4">
    <a href="{{ route('suportes.index') }}" class="text-decoration-none">&larr; Voltar</a>
    <h1 class="h3 mt-2 mb-0">{{ $suporte->assunto }}</h1>
    <p class="text-secondary mb-0">{{ $suporte->usuario?->name }} | {{ ucfirst($suporte->status_suporte) }}</p>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5">Mensagem</h2>
                <p class="mb-0">{{ $suporte->mensagem }}</p>
            </div>
        </div>
        @if ($suporte->resposta)
            <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <h2 class="h5">Resposta</h2>
                    <p class="mb-0">{{ $suporte->resposta }}</p>
                </div>
            </div>
        @endif
    </div>

    @if ($isStaff)
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Responder suporte</h2>
                    <form method="POST" action="{{ route('suportes.update', $suporte) }}" class="mt-3">
                        @csrf
                        @method('PUT')
                        <label class="form-label" for="status_suporte">Status</label>
                        <select class="form-select" id="status_suporte" name="status_suporte">
                            @foreach (['aberto' => 'Aberto', 'respondido' => 'Respondido', 'encerrado' => 'Encerrado'] as $value => $label)
                                <option value="{{ $value }}" @selected($suporte->status_suporte === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <label class="form-label mt-3" for="resposta">Resposta</label>
                        <textarea class="form-control" id="resposta" name="resposta" rows="5">{{ old('resposta', $suporte->resposta) }}</textarea>
                        <div class="d-flex justify-content-end mt-3">
                            <button class="btn btn-primary" type="submit">Salvar resposta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
