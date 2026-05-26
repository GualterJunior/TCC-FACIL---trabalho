@extends('layouts.app')

@section('content')
<div class="mb-8 flex justify-between items-center flex-wrap gap-4">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Submissão de Entregas</h2>
        <p class="text-gray-600 mt-2">Envie os ficheiros do seu projeto conforme o cronograma.</p>
    </div>
    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-semibold text-sm border border-blue-200">
        Fase Atual: Fundamentação Teórica
    </span>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-indigo-500">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Nova Submissão</h3>
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Selecione a Etapa</label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 bg-white">
                    <option>1. Definição do Tema e Objetivos</option>
                    <option selected>2. Fundamentação Teórica e Modelo de Base de Dados</option>
                    <option>3. Desenvolvimento Prático</option>
                    <option>4. Entrega Final (Monografia)</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Ficheiro (PDF ou ZIP)</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-indigo-50 hover:border-indigo-300 transition-all">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold text-indigo-600">Clique para fazer upload</span> ou arraste o ficheiro</p>
                        </div>
                        <input type="file" class="hidden" />
                    </label>
                </div>
            </div>

            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-md" type="button">
                Enviar Documento
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Histórico de Entregas</h3>
        
        <div class="relative border-l-2 border-indigo-200 ml-3 mt-2">
            <div class="mb-8 ml-6">
                <span class="absolute flex items-center justify-center w-6 h-6 bg-green-100 rounded-full -left-3 ring-8 ring-white">
                    <svg class="w-3 h-3 text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                </span>
                <h4 class="font-bold text-gray-800">1. Definição do Tema</h4>
                <p class="text-sm text-gray-500 mb-1">Enviado a 15 de Abril às 14:30</p>
                <span class="inline-flex items-center bg-green-50 text-green-700 text-xs font-medium px-2.5 py-0.5 rounded border border-green-200">
                    Aprovado pelo Coordenador
                </span>
            </div>

            <div class="ml-6">
                <span class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -left-3 ring-8 ring-white">
                    <span class="w-2.5 h-2.5 bg-gray-400 rounded-full"></span>
                </span>
                <h4 class="font-bold text-gray-500">2. Fundamentação Teórica</h4>
                <p class="text-sm text-gray-400">Pendente de envio</p>
            </div>
        </div>
    </div>
</div>
@endsection