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
                ['label' => 'Usuarios', 'route' => 'users.index', 'count' => $this->countTable('users')],
                ['label' => 'Projetos', 'route' => 'projetos.index', 'count' => $this->countTable('projetos')],
                ['label' => 'Turmas', 'route' => 'turmas.index', 'count' => $this->countTable('turmas')],
                ['label' => 'Grupos', 'route' => 'grupos.index', 'count' => $this->countTable('grupos')],
                ['label' => 'Entregas para avaliar', 'route' => 'validacoes.index', 'count' => $this->countTable('validacoes')],
                ['label' => 'Notas lancadas', 'route' => 'notas.index', 'count' => $this->countTable('notas')],
            ]
            : [
                ['label' => 'Projetos', 'route' => 'projetos.index', 'count' => $this->countTable('projetos')],
                ['label' => 'Meu grupo', 'route' => 'grupos.index', 'count' => $this->countTable('grupos')],
                ['label' => 'Temas', 'route' => 'temas.index', 'count' => $this->countTable('temas')],
                ['label' => 'Minhas entregas', 'route' => 'entregas.index', 'count' => $this->countTable('entrega')],
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
}
