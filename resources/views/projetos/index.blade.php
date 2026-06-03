@extends('layouts.app')

@section('title', 'Projetos - TCC Fácil')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">Projetos</h1>
        <p class="text-secondary mb-0">{{ $isStaff ? 'Gerencie e publique projetos de referência.' : 'Consulte projetos publicados como referência para o seu TCC.' }}</p>
    </div>
    @if ($isStaff)
        <a href="{{ route('projetos.create') }}" class="btn btn-primary">Novo projeto</a>
    @endif
</div>

<div class="row g-3">
    @forelse ($projetos as $projeto)
        <div class="col-md-6 col-xl-4">
            <div class="card h-100 shadow-sm">
                @if ($projeto->banner_path)
                    <img src="{{ asset('storage/'.$projeto->banner_path) }}" class="card-img-top" alt="{{ $projeto->titulo }}" style="height: 180px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between gap-2 mb-2">
                        <span class="badge text-bg-light">{{ ucfirst($projeto->status) }}</span>
                        <span class="text-secondary small">{{ $projeto->autor }}</span>
                    </div>
                    <h2 class="h5">{{ $projeto->titulo }}</h2>
                    <p class="text-secondary flex-grow-1">{{ \Illuminate\Support\Str::limit($projeto->descricao, 130) }}</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('projetos.show', $projeto) }}" class="btn btn-outline-primary">Ver detalhes</a>
                        @if ($projeto->pdf_path)
                            <a href="{{ asset('storage/'.$projeto->pdf_path) }}" target="_blank" class="btn btn-outline-secondary">Abrir PDF</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info mb-0">Nenhum projeto publicado no momento.</div>
        </div>
    @endforelse
</div>

<div class="mt-3">{{ $projetos->links() }}</div>
@endsection
