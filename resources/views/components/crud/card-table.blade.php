@props(['fields','records','routeName','isStaff' => false])


<div class="card shadow-sm">

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    @foreach($fields as $field)
                        <th>{{ $field['label'] }}</th>
                    @endforeach

                    <th class="text-end">Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($records as $record)
                    <tr>
                        @foreach($fields as $field)
                            <td>
                                @php($value = $field['value'] instanceof \Closure ? $field['value']($record) : ($record->{$field['key']} ?? null))

                                @if (($field['type'] ?? null) === 'file' && $value)
                                    <a href="{{ asset('storage/'.$value) }}" target="_blank">Abrir</a>
                                @elseif (($field['type'] ?? null) === 'textarea' && $value)
                                    {{ \Illuminate\Support\Str::limit($value, $field['limit'] ?? 70) }}
                                @elseif (!empty($field['options']) && array_key_exists((string)$value, $field['options']))
                                    {{ $field['options'][(string)$value] }}
                                @else
                                    {{ $value ?? '—' }}
                                @endif
                            </td>
                        @endforeach

                        <td class="text-end">
                            <x-crud.table-actions :routeName="$routeName" :record="$record" :isStaff="$isStaff" />
                        </td>
                    </tr>
                @empty
                    <x-crud.empty-state colspan="{{ count($fields) + 1 }}" message="Nenhuma entrega encontrada." />
                @endforelse
            </tbody>
        </table>
    </div>
</div>


