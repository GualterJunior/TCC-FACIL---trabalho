@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800">Sorteio de Bancas</h2>
    <p class="text-gray-600 mt-2">Acompanhe a ordem das apresentações para a Turma de Sistemas de Informação.</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordem</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dupla / Grupo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tema do TCC</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data / Hora</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <tr class="bg-indigo-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-indigo-600">1º</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Arthur e Eudes</td>
                <td class="px-6 py-4 text-sm text-gray-500">Desenvolvimento de Plataforma para Ecoturismo (Trip Amazon)</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-semibold">20 Nov - 19:00</td>
            </tr>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2º</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Maria e João</td>
                <td class="px-6 py-4 text-sm text-gray-500">Impacto da IA na Educação</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20 Nov - 20:00</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection