<?php

namespace Database\Seeders;

use App\Models\Sorteio;
use App\Models\Turma;
use Illuminate\Database\Seeder;

class SorteioSeeder extends Seeder
{
    public function run(): void
    {
        $turma1 = Turma::where('codigo_turma', 'ES-2024-2')->first();
        $turma2 = Turma::where('codigo_turma', 'SI-2024-2')->first();

        Sorteio::create([
            'id_turma' => $turma1->id_turma,
            'data_sorteio' => now()->addDays(15)->toDateString(),
            'status_sorteio' => 'agendado',
        ]);

        Sorteio::create([
            'id_turma' => $turma2->id_turma,
            'data_sorteio' => now()->addDays(20)->toDateString(),
            'status_sorteio' => 'agendado',
        ]);
    }
}
