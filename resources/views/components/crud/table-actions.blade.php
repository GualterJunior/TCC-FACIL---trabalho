@props(['routeName','record','isStaff' => false])

<div class="btn-group btn-group-sm" role="group">
    @if (Route::has($routeName.'.show'))
        <a class="btn btn-outline-secondary" href="{{ route($routeName.'.show', $record) }}">Ver</a>
    @endif

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

