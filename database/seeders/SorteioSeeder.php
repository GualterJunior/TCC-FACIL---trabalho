<?php

namespace Database\Seeders;

use App\Models\Sorteio;
use App\Models\Tema;
use App\Models\Turma;
use Illuminate\Database\Seeder;

class SorteioSeeder extends Seeder
{
    public function run(): void
    {
        $turma1 = Turma::where('codigo_turma', 'ES-2024-2')->first();
        $turma2 = Turma::where('codigo_turma', 'SI-2024-2')->first();

        $sorteio1 = Sorteio::create([
            'id_turma' => $turma1->id_turma,
            'data_sorteio' => now()->addDays(15)->toDateString(),
            'status_sorteio' => 'agendado',
        ]);

        $sorteio2 = Sorteio::create([
            'id_turma' => $turma2->id_turma,
            'data_sorteio' => now()->addDays(20)->toDateString(),
            'status_sorteio' => 'agendado',
        ]);

        // Associar temas aos sorteios
        $temas1 = Tema::where('id_turma', $turma1->id_turma)->get();
        $temas2 = Tema::where('id_turma', $turma2->id_turma)->get();

        foreach ($temas1 as $tema) {
            $sorteio1->resultados()->create([
                'id_grupo' => 1,
                'id_tema' => $tema->id_tema,
            ]);
        }

        foreach ($temas2 as $tema) {
            $sorteio2->resultados()->create([
                'id_grupo' => 4,
                'id_tema' => $tema->id_tema,
            ]);
        }
    }
}
