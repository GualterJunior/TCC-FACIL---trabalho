<?php

namespace Database\Seeders;

use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Seeder;

class TurmaSeeder extends Seeder
{
    public function run(): void
    {
        $professor1 = User::where('email', 'ana.silva@tcc-facil.com')->first();
        $professor2 = User::where('email', 'carlos.oliveira@tcc-facil.com')->first();

        Turma::create([
            'nome_turma' => 'Engenharia de Software - 2024/2',
            'codigo_turma' => 'ES-2024-2',
            'semestre' => '2024.2',
            'descricao' => 'Turma de TCC para alunos de Engenharia de Software',
            'status_turma' => 'ativa',
            'id_professor' => $professor1->id,
        ]);

        Turma::create([
            'nome_turma' => 'Sistemas de Informação - 2024/2',
            'codigo_turma' => 'SI-2024-2',
            'semestre' => '2024.2',
            'descricao' => 'Turma de TCC para alunos de Sistemas de Informação',
            'status_turma' => 'ativa',
            'id_professor' => $professor2->id,
        ]);
    }
}
