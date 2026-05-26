@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Minhas Entregas</h2>
        <a href="/entregas/create" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
            + Nova Entrega
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Etapa</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data de Envio</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arquivo</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nota</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="py-4 px-6 text-sm text-gray-900 font-medium">Projeto Inicial</td>
                    <td class="py-4 px-6 text-sm text-gray-500">10/05/2026</td>
                    <td class="py-4 px-6 text-sm text-blue-600"><a href="#" class="hover:underline">projeto_v1.pdf</a></td>
                    <td class="py-4 px-6 text-sm font-bold text-green-600">8.5</td>
                    <td class="py-4 px-6 text-sm text-center">
                        <a href="/entregas/1" class="text-indigo-600 hover:text-indigo-900 font-medium">Ver Correção</a>
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-6 text-sm text-gray-900 font-medium">Capítulo 1</td>
                    <td class="py-4 px-6 text-sm text-gray-500">Pendente</td>
                    <td class="py-4 px-6 text-sm text-gray-400">Nenhum envio</td>
                    <td class="py-4 px-6 text-sm text-gray-500">-</td>
                    <td class="py-4 px-6 text-sm text-center">
                        <a href="/entregas/create" class="text-blue-600 hover:text-blue-900 font-medium">Enviar Agora</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
