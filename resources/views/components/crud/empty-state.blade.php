@props(['message' => 'Nenhum registro encontrado.','colspan' => null])

@php
    $attr = $colspan ? ['colspan' => $colspan] : [];
@endphp

<tr>
    <td {{ $colspan ? 'colspan="'.$colspan.'"' : '' }} class="text-center text-secondary py-4">
        {{ $message }}
    </td>
</tr>

