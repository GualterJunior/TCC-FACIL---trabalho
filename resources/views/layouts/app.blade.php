@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">Minhas Entregas</h1>
    
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Arquivo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($entregas as $entrega)
            <tr>
                <td class="px-6 py-4">{{ $entrega->nome_arquivo }}</td>
                <td class="px-6 py-4">{{ $entrega->status_entrega }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection