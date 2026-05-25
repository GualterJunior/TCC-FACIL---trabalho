'use client';

import { UploadCloud, File, CheckCircle } from 'lucide-react';

export default function EntregasPage() {
  return (
    <div className="space-y-6">
      <div className="flex justify-between items-center">
        <h1 className="text-2xl font-bold text-gray-800">Minhas Entregas</h1>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Formulário de Upload */}
        <div className="lg:col-span-1 bg-white p-6 rounded-xl border border-gray-200 shadow-sm h-fit">
          <h2 className="text-lg font-semibold text-gray-800 mb-4">Nova Submissão</h2>
          <form className="space-y-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">Selecione a Etapa</label>
              <select className="w-full p-2.5 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500">
                <option>Proposta de Tema</option>
                <option>Capítulo 1</option>
                <option>Versão Final</option>
              </select>
            </div>

            <div className="border-2 border-dashed border-gray-300 rounded-xl p-8 flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors cursor-pointer">
              <UploadCloud size={32} className="text-gray-400 mb-2" />
              <p className="text-sm font-medium text-gray-700">Clique para enviar ou arraste o arquivo</p>
              <p className="text-xs text-gray-500 mt-1">PDF, DOCX (Max. 10MB)</p>
            </div>

            <button type="button" className="w-full bg-blue-600 text-white py-2.5 rounded-lg font-medium hover:bg-blue-700">
              Enviar Arquivo
            </button>
          </form>
        </div>

        {/* Histórico de Entregas */}
        <div className="lg:col-span-2 bg-white rounded-xl border border-gray-200 shadow-sm p-6">
          <h2 className="text-lg font-semibold text-gray-800 mb-4">Histórico de Submissões</h2>

          <div className="space-y-4">
            {/* Item de Entrega */}
            <div className="flex items-start gap-4 p-4 border border-gray-100 rounded-lg bg-gray-50">
              <div className="bg-white p-2 rounded shadow-sm">
                <File size={24} className="text-blue-500" />
              </div>
              <div className="flex-1">
                <div className="flex justify-between items-start">
                  <div>
                    <h3 className="font-medium text-gray-800">Proposta de Tema</h3>
                    <p className="text-sm text-gray-500">Enviado em 10/05/2026 às 14:30</p>
                  </div>
                  <span className="flex items-center gap-1 text-sm font-medium text-green-600 bg-green-50 px-2.5 py-1 rounded-full">
                    <CheckCircle size={16} /> Avaliado
                  </span>
                </div>
                <div className="mt-3 text-sm bg-white p-3 rounded border border-gray-100">
                  <span className="font-semibold text-gray-700">Nota: 10.0</span>
                  <p className="text-gray-600 mt-1">Excelente proposta, muito bem estruturada e relevante para a área de estudo.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
