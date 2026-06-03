<?php

namespace Database\Seeders;

use App\Models\Grupo;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    public function run(): void
    {
        $turma1 = Turma::where('codigo_turma', 'ES-2024-2')->first();
        $turma2 = Turma::where('codigo_turma', 'SI-2024-2')->first();

        // Grupos da turma 1
        $grupo1 = Grupo::create([
            'nome_grupo' => 'Grupo Alpha',
            'id_turma' => $turma1->id_turma,
            'status_grupo' => 'ativo',
        ]);

        $grupo2 = Grupo::create([
            'nome_grupo' => 'Grupo Beta',
            'id_turma' => $turma1->id_turma,
            'status_grupo' => 'ativo',
        ]);

        $grupo3 = Grupo::create([
            'nome_grupo' => 'Grupo Gamma',
            'id_turma' => $turma1->id_turma,
            'status_grupo' => 'ativo',
        ]);

        // Grupos da turma 2
        $grupo4 = Grupo::create([
            'nome_grupo' => 'Grupo Delta',
            'id_turma' => $turma2->id_turma,
            'status_grupo' => 'ativo',
        ]);

        $grupo5 = Grupo::create([
            'nome_grupo' => 'Grupo Epsilon',
            'id_turma' => $turma2->id_turma,
            'status_grupo' => 'ativo',
        ]);

        // Adicionar integrantes aos grupos
        $alunos = User::where('tipo', 'aluno')->get();

        // Grupo Alpha: alunos 1, 2, 3
        $grupo1->usuarios()->attach([$alunos[0]->id, $alunos[1]->id, $alunos[2]->id]);

        // Grupo Beta: alunos 4, 5, 6
        $grupo2->usuarios()->attach([$alunos[3]->id, $alunos[4]->id, $alunos[5]->id]);

        // Grupo Gamma: alunos 7, 8, 9
        $grupo3->usuarios()->attach([$alunos[6]->id, $alunos[7]->id, $alunos[8]->id]);

        // Grupo Delta: alunos 10, 11
        $grupo4->usuarios()->attach([$alunos[9]->id, $alunos[10]->id]);

        // Grupo Epsilon: alunos 12
        $grupo5->usuarios()->attach([$alunos[11]->id]);
    }
}
