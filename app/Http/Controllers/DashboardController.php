<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $role = strtolower(trim((string) $user->tipo));
        $isStaff = in_array($role, ['professor', 'coordenador'], true);

        $cards = $isStaff
            ? [
                ['label' => 'Usuários', 'route' => 'users.index', 'count' => $this->countTable('users')],
                ['label' => 'Projetos', 'route' => 'projetos.index', 'count' => $this->countTable('projetos')],
                ['label' => 'Turmas', 'route' => 'turmas.index', 'count' => $this->countTable('turmas')],
                ['label' => 'Grupos', 'route' => 'grupos.index', 'count' => $this->countTable('grupos')],
                ['label' => 'Acompanhamento', 'route' => 'acompanhamento.index', 'count' => $this->countTable('progresso_grupo')],
                ['label' => 'Entregas para avaliar', 'route' => 'validacoes.index', 'count' => $this->countTable('validacoes')],
                ['label' => 'Notas lancadas', 'route' => 'notas.index', 'count' => $this->countTable('notas')],
            ]
            : [
                ['label' => 'Meu TCC', 'route' => 'aluno.meu-tcc.index', 'count' => $this->countStudentResults($user->id)],
                ['label' => 'Minhas turmas', 'route' => 'aluno.turmas.index', 'count' => $this->countStudentGroups($user->id)],
                ['label' => 'Meu grupo', 'route' => 'grupos.index', 'count' => $this->countStudentGroups($user->id)],
                ['label' => 'Temas', 'route' => 'temas.index', 'count' => $this->countTable('temas')],
                ['label' => 'Minhas entregas', 'route' => 'entregas.index', 'count' => $this->countStudentDeliveries($user->id)],
                ['label' => 'Histórico de sorteios', 'route' => 'sorteios.historico', 'count' => $this->countStudentResults($user->id)],
            ];

        return view('admin.dashboard', compact('cards', 'isStaff'));
    }

    private function countTable(string $table): int
    {
        if (! Schema::hasTable($table)) {
            return 0;
        }

        return DB::table($table)->count();
    }

    private function countStudentGroups(int $userId): int
    {
        if (! Schema::hasTable('grupo_integrantes')) {
            return 0;
        }

        return DB::table('grupo_integrantes')->where('id_usuario', $userId)->count();
    }

    private function countStudentDeliveries(int $userId): int
    {
        if (! Schema::hasTable('entrega') || ! Schema::hasTable('grupo_integrantes')) {
            return 0;
        }

        return DB::table('entrega')
            ->join('grupo_integrantes', 'entrega.id_grupo', '=', 'grupo_integrantes.id_grupo')
            ->where('grupo_integrantes.id_usuario', $userId)
            ->count();
    }

    private function countStudentResults(int $userId): int
    {
        if (! Schema::hasTable('resultado_sorteio') || ! Schema::hasTable('grupo_integrantes')) {
            return 0;
        }

        return DB::table('resultado_sorteio')
            ->join('grupo_integrantes', 'resultado_sorteio.id_grupo', '=', 'grupo_integrantes.id_grupo')
            ->where('grupo_integrantes.id_usuario', $userId)
            ->count();
    }
}
