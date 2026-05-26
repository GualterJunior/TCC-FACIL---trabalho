@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Proposta de Tema</h1>
        <span class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-3 py-1 rounded-full">Em Análise</span>
    </div>

    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Título do Trabalho</label>
            <p class="text-lg font-bold text-gray-900">Desenvolvimento de Soluções Inteligentes e Modelagem de Banco de Dados Aplicada</p>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Descrição / Problema de Pesquisa</label>
            <p class="text-sm text-gray-700 leading-relaxed">
                Este projeto de conclusão de curso visa explorar a engenharia de requisitos e a modelagem relacional de banco de dados para resolver problemas reais de mercado através de soluções tecnológicas robustas e escaláveis.
            </p>
        </div>

        <div class="border-t pt-4 flex justify-between items-center text-sm">
            <span class="text-gray-500">Última atualização: 26/05/2026</span>
            <a href="/temas/1/edit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-4 py-2 rounded transition">
                Editar Proposta
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Sugerir Nova Linha de Pesquisa</h3>
        <form action="/temas" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Título Sugerido</label>
                <input type="text" name="titulo" class="w-full border border-gray-300 rounded shadow-sm px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: Análise de Viabilidade Econômica ou Tecnológica...">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Justificativa e Objetivos</label>
                <textarea name="descricao" rows="4" class="w-full border border-gray-300 rounded shadow-sm px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Descreva brevemente o escopo do projeto e os objetivos gerais..."></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded shadow transition">
                    Submeter Tema
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
