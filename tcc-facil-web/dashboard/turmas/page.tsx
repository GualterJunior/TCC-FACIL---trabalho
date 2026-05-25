'use client';

import { Plus } from 'lucide-react';

// Simulando os dados que virão da sua API Laravel (GET /api/turmas)
const turmasMock = [
  { id: 1, nome: 'Sistemas de Informação - 8º Período', semestre: '2026.1', status: 'Ativo' },
  { id: 2, nome: 'Ciência da Computação - 8º Período', semestre: '2026.1', status: 'Ativo' },
];

export default function TurmasPage() {
  return (
    <div className="space-y-6">
      <div className="flex justify-between items-center">
        <h1 className="text-2xl font-bold text-gray-800">Gestão de Turmas</h1>
        <button className="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
          <Plus size={20} /> Nova Turma
        </button>
      </div>

      <div className="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <table className="w-full text-left border-collapse">
          <thead>
            <tr className="bg-gray-50 border-b border-gray-200 text-sm text-gray-600">
              <th className="p-4 font-medium">ID</th>
              <th className="p-4 font-medium">Nome da Turma</th>
              <th className="p-4 font-medium">Semestre</th>
              <th className="p-4 font-medium">Status</th>
              <th className="p-4 font-medium">Ações</th>
            </tr>
          </thead>
          <tbody>
            {turmasMock.map((turma) => (
              <tr key={turma.id} className="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                <td className="p-4 text-gray-500">#{turma.id}</td>
                <td className="p-4 font-medium text-gray-800">{turma.nome}</td>
                <td className="p-4 text-gray-600">{turma.semestre}</td>
                <td className="p-4">
                  <span className="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">
                    {turma.status}
                  </span>
                </td>
                <td className="p-4">
                  <button className="text-blue-600 hover:underline text-sm font-medium">Editar</button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>

        {turmasMock.length === 0 && (
          <div className="p-8 text-center text-gray-500">
            Nenhuma turma cadastrada ainda.
          </div>
        )}
      </div>
    </div>
  );
}
