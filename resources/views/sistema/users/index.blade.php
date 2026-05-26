@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gerenciamento de Usuários</h1>
            <p class="text-gray-500 text-sm mt-1">Controle de acessos de alunos, professores e administradores.</p>
        </div>
        <a href="/users/create" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
            + Novo Usuário
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
            <input type="text" placeholder="Buscar por nome, email ou matrícula..." class="w-1/3 border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nome / E-mail</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Papel</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-6 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold">AR</div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Arthur Rangel</div>
                                    <div class="text-sm text-gray-500">arthur@exemplo.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">Aluno</span>
                        </td>
                        <td class="py-4 px-6 text-sm">
                            <span class="text-green-600 font-medium">Ativo</span>
                        </td>
                        <td class="py-4 px-6 text-sm text-right font-medium">
                            <a href="/users/1/edit" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                            <form action="/users/1" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Remover</button>
                            </form>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 font-bold">PF</div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Professor Orientador</div>
                                    <div class="text-sm text-gray-500">prof@exemplo.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500">
                            <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2 py-1 rounded">Coordenador/Professor</span>
                        </td>
                        <td class="py-4 px-6 text-sm">
                            <span class="text-green-600 font-medium">Ativo</span>
                        </td>
                        <td class="py-4 px-6 text-sm text-right font-medium">
                            <a href="/users/2/edit" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                            <button class="text-red-600 hover:text-red-900">Remover</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
