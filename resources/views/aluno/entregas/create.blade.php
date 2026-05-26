@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="mb-6">
        <a href="/entregas" class="text-sm text-blue-600 hover:underline">← Voltar para a lista</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Enviar Etapa do TCC</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="/entregas" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Selecione a Etapa Corrente</label>
                <select name="etapa_id" class="w-full border border-gray-300 rounded shadow-sm px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Selecione...</option>
                    <option value="1">Projeto Inicial (Escopo e Cronograma)</option>
                    <option value="2">Capítulo 1 - Referencial Teórico</option>
                    <option value="3">Capítulo 2 - Modelagem de Dados e Metodologia</option>
                    <option value="4">Entrega Final do TCC</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Documento do Trabalho (PDF, DOCX)</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400 transition cursor-pointer">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h20a4 4 0 004-4V20m-6-12l6 6m-6-6v6a1 1 0 001 1h6m-4 6h16M14 22h20M14 26h20M14 30h12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                <span>Clique para fazer upload</span>
                                <input id="file-upload" name="arquivo" type="file" class="sr-only">
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">Apenas arquivos até 10MB</p>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Notas ou Observações para o Orientador</label>
                <textarea name="comentario" rows="3" class="w-full border border-gray-300 rounded shadow-sm px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: Professor, efetuamos as correções sugeridas na modelagem relacional..."></textarea>
            </div>

            <div class="flex justify-end space-x-3 border-t pt-4">
                <a href="/entregas" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-4 py-2 rounded transition">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded shadow transition">
                    Confirmar Envio
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    document.getElementById('file-upload').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        if(fileName) {
            e.target.closest('div').querySelector('span').textContent = "Selecionado: " + fileName;
        }
    });
</script>
@endsection
