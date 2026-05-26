@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Validações Pendentes</h1>
        <p class="text-gray-500 mt-1">Avalie as propostas de temas e formação de grupos enviados pelos alunos.</p>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Fila de Análise</h3>
        </div>

        <div class="divide-y divide-gray-200">
            <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center hover:bg-gray-50 transition">
                <div class="mb-4 md:mb-0">
                    <span class="text-xs font-bold uppercase tracking-wider text-yellow-600 bg-yellow-100 px-2 py-1 rounded mb-2 inline-block">Proposta de Tema</span>
                    <h4 class="text-lg font-bold text-gray-900">Desenvolvimento de Soluções Inteligentes e Modelagem...</h4>
                    <p class="text-sm text-gray-500 mt-1">Enviado por: <span class="font-medium text-gray-700">Arthur Rangel</span> (Sistemas de Informação)</p>
                    <p class="text-xs text-gray-400 mt-1">Enviado há 2 dias</p>
                </div>

                <div class="flex space-x-2">
                    <a href="/validacoes/1/edit" class="bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 font-medium px-4 py-2 rounded transition text-sm">
                        Analisar Proposta
                    </a>
                </div>
            </div>

            <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center hover:bg-gray-50 transition">
                <div class="mb-4 md:mb-0">
                    <span class="text-xs font-bold uppercase tracking-wider text-purple-600 bg-purple-100 px-2 py-1 rounded mb-2 inline-block">Formação de Grupo</span>
                    <h4 class="text-lg font-bold text-gray-900">Grupo 04 - Turma 2026.1</h4>
                    <p class="text-sm text-gray-500 mt-1">2 Integrantes aguardando confirmação do orientador.</p>
                </div>

                <div class="flex space-x-2">
                    <button class="bg-green-600 text-white hover:bg-green-700 font-medium px-4 py-2 rounded transition text-sm">
                        Aprovar
                    </button>
                    <button class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium px-4 py-2 rounded transition text-sm">
                        Detalhes
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
