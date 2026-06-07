@props(['title','items'=>[]])

<div class="card shadow-sm">
    <div class="card-body">
        @if(!empty($title))
            <h2 class="h5 mb-3">{{ $title }}</h2>
        @endif

        <dl class="row mb-0">
            @foreach($items as $item)
                @php
                    $label = $item['label'] ?? '';
                    $value = $item['value'] ?? null;
                    $type = $item['type'] ?? 'text';
                    $filePath = $item['filePath'] ?? null;
                @endphp

                <dt class="col-sm-3">{{ $label }}</dt>
                <dd class="col-sm-9">
                    @if($type === 'file' && $filePath)
                        <a href="{{ asset('storage/'.$filePath) }}" target="_blank">{{ $value }}</a>
                    @else
                        {{ $value ?? '—' }}
                    @endif
                </dd>
            @endforeach
        </dl>
    </div>
</div>

