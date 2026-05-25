import Link from 'next/link';
import { BookOpen, Users, FileText, CheckSquare, Calendar } from 'lucide-react';

export default function DashboardLayout({ children }: { children: React.ReactNode }) {
  return (
    <div className="min-h-screen flex bg-gray-50 text-gray-800 font-sans">
      <aside className="w-64 bg-white border-r border-gray-200 flex flex-col">
        <div className="p-6 flex items-center gap-3 border-b border-gray-100">
          <div className="bg-blue-600 text-white p-2 rounded-lg"><BookOpen size={24} /></div>
          <h1 className="text-xl font-bold text-gray-800">TCC Fácil</h1>
        </div>
        <nav className="flex-1 p-4 space-y-2">
          <Link href="/dashboard" className="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700"><Calendar size={20} /> Visão Geral</Link>
          <Link href="/dashboard/turmas" className="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700"><Users size={20} /> Turmas e Grupos</Link>
          <Link href="/dashboard/temas" className="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700"><FileText size={20} /> Temas</Link>
          <Link href="/dashboard/entregas" className="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700"><CheckSquare size={20} /> Entregas</Link>
        </nav>
      </aside>
      <main className="flex-1 flex flex-col h-screen overflow-y-auto">
        <header className="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8">
          <h2 className="text-lg font-medium">Painel de Controle</h2>
        </header>
        <div className="p-8">{children}</div>
      </main>
    </div>
  );
}
