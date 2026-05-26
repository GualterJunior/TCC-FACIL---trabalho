@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Meu Grupo de TCC</h1>
        <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">Grupo Validado</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Integrantes da Equipe</h3>

                <div class="divide-y divide-gray-100">
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-bold">
                                AR
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Arthur Rangel Copetti</p>
                                <p class="text-xs text-gray-500">Sistemas de Informação</p>
                            </div>
                        </div>
                        <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded font-medium">Líder</span>
                    </div>

                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-bold">
                                DP
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Parceiro de Desenvolvimento</p>
                                <p class="text-xs text-gray-500">Sistemas de Informação</p>
                            </div>
                        </div>
                        <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded font-medium">Membro</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Vínculo Acadêmico</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase">Instituição</p>
                        <p class="text-sm font-medium text-gray-800">Centro Universitário UNINORTE</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold uppercase">Turma Vinculada</p>
                        <p class="text-sm font-medium text-gray-800">Sistemas de Informação - 2026.1</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Professor Orientador</h3>
                <div class="text-center py-4">
                    <div class="w-16 h-16 rounded-full bg-blue-900 text-white flex items-center justify-center text-xl font-bold mx-auto mb-3">
                        PROF
                    </div>
                    <p class="text-base font-semibold text-gray-900">Nome do Orientador</p>
                    <p class="text-xs text-gray-500 mb-4">Colegiado de Tecnologia</p>
                    <a href="mailto:orientador@uninorte.com" class="text-sm text-blue-600 hover:underline font-medium block">
                        Contatar por E-mail
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
