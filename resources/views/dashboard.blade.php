@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Bem-vindo de volta, Arthur Rangel</h2>
            <p class="text-gray-600 mt-1">Sistemas de Informação - Turma 2026</p>
        </div>
        <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full border border-green-200">Em fase de Desenvolvimento</span>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-indigo-500">
        <h3 class="text-lg font-bold text-gray-800 mb-2">O meu Tema</h3>
        <p class="text-gray-600 text-sm mb-4">Modelagem de Base de Dados para Gestão de Turismo na Região Amazónica.</p>
        <div class="text-sm">
            <span class="font-semibold text-gray-700">Dupla:</span> Eudes
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-yellow-500">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Sorteio de Apresentação</h3>
        <p class="text-gray-600 text-sm mb-4">O sorteio da ordem das bancas ainda não foi realizado pelo coordenador.</p>
        <button class="w-full bg-gray-100 text-gray-500 cursor-not-allowed font-medium py-2 px-4 rounded transition duration-200">
            Aguardando Sorteio
        </button>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-red-500">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Próxima Entrega</h3>
        <p class="text-gray-600 text-sm mb-4">Entrega da Fundamentação Teórica e Modelo de Dados (MySQL).</p>
        <div class="flex justify-between items-center text-sm">
            <span class="font-bold text-red-600">Prazo: 28 de Maio</span>
            <a href="/entregas" class="text-indigo-600 hover:underline font-medium">Submeter Ficheiro &rarr;</a>
        </div>
    </div>
</div>
@endsection