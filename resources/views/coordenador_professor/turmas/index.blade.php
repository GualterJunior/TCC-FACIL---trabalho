@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Minhas Turmas</h1>
            <p class="text-gray-500 text-sm mt-1">Visão geral das turmas sob sua orientação neste semestre.</p>
        </div>
        <a href="/turmas/create" class="bg-blue-900 text-white px-4 py-2 rounded shadow hover:bg-blue-800 transition">
            + Nova Turma
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white rounded-lg shadow border-t-4 border-blue-900 p-6 flex flex-col justify-between hover:shadow-lg transition">
            <div>
                <div class="flex justify-between items-start">
                    <h3 class="text-xl font-bold text-gray-800">Sistemas de Informação</h3>
                    <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">Ativa</span>
                </div>
                <p class="text-sm font-medium text-gray-500 mt-1">Semestre: 2026.1 - Turma A</p>

                <div class="mt-4 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Alunos Matriculados:</span>
                        <span class="font-bold text-gray-800">24</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Grupos Formados:</span>
                        <span class="font-bold text-gray-800">8</span>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <a href="/turmas/1" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-blue-900 font-semibold py-2 rounded transition">
                    Acessar Painel da Turma
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
