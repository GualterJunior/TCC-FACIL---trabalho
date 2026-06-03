<?php

namespace Database\Seeders;

use App\Models\Grupo;
use App\Models\Nota;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotaSeeder extends Seeder
{
    public function run(): void
    {
        $grupos = Grupo::all();
        $professor = User::where('email', 'ana.silva@tcc-facil.com')->first();

        foreach ($grupos->take(3) as $grupo) {
            Nota::create([
                'id_grupo' => $grupo->id_grupo,
                'id_professor' => $professor->id,
                'nota' => 8.5,
                'comentario' => 'Projeto bem estruturado com boa implementação.',
            ]);
        }

        $professor2 = User::where('email', 'carlos.oliveira@tcc-facil.com')->first();
        foreach ($grupos->slice(3) as $grupo) {
            Nota::create([
                'id_grupo' => $grupo->id_grupo,
                'id_professor' => $professor2->id,
                'nota' => 7.0,
                'comentario' => 'Projeto em desenvolvimento, aguardando conclusão.',
            ]);
        }
    }
}
