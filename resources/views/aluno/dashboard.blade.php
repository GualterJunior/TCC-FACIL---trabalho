@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Visão Geral do TCC</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <h3 class="text-gray-500 text-sm font-semibold uppercase mb-2">Status do Tema</h3>
            <p class="text-2xl font-bold text-gray-800">Em Validação</p>
            <p class="text-sm text-gray-600 mt-2">Aguardando parecer do professor.</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <h3 class="text-gray-500 text-sm font-semibold uppercase mb-2">Progresso do TCC</h3>
            <p class="text-2xl font-bold text-gray-800">25% Concluído</p>
            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-3">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 25%"></div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
            <h3 class="text-gray-500 text-sm font-semibold uppercase mb-2">Próxima Entrega</h3>
            <p class="text-xl font-bold text-gray-800 mb-1">Capítulo 1 - Referencial</p>
            <p class="text-sm text-red-600 font-semibold mb-3">Vence em: 20/06/2026</p>
            <a href="/entregas/create" class="text-sm bg-red-100 text-red-700 px-3 py-1 rounded font-medium hover:bg-red-200">Ir para envio</a>
        </div>

    </div>

</div>
@endsection
