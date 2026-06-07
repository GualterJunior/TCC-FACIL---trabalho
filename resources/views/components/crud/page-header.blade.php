@props(['title','subtitle' => null,'action' => null])

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">{{ $title }}</h1>
        @if($subtitle)
            <p class="text-secondary mb-0">{{ $subtitle }}</p>
        @endif
    </div>
    @if($action)
        <div>{{ $action }}</div>
    @endif
</div>

