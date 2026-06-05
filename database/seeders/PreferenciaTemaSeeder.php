<?php

namespace Database\Seeders;

use App\Models\Grupo;
use App\Models\PreferenciaTema;
use App\Models\Tema;
use Illuminate\Database\Seeder;

class PreferenciaTemaSeeder extends Seeder
{
    public function run(): void
    {
        $preferencias = [
            'Grupo Alpha' => [
                'Sistema de Gerenciamento de Projetos Web',
                'API REST para E-commerce',
                'Dashboard Analitico de Dados',
            ],
            'Grupo Beta' => [
                'API REST para E-commerce',
                'Aplicativo Mobile de Redes Sociais',
                'Sistema de Gerenciamento de Projetos Web',
            ],
            'Grupo Gamma' => [
                'Aplicativo Mobile de Redes Sociais',
                'Dashboard Analitico de Dados',
                'API REST para E-commerce',
            ],
            'Grupo Delta' => [
                'Sistema de Autenticacao Seguro',
                'Plataforma de Aprendizado Online',
                'Sistema IoT de Monitoramento',
            ],
            'Grupo Epsilon' => [
                'Plataforma de Aprendizado Online',
                'Sistema IoT de Monitoramento',
                'Sistema de Autenticacao Seguro',
            ],
        ];

        foreach ($preferencias as $nomeGrupo => $titulos) {
            $grupo = Grupo::where('nome_grupo', $nomeGrupo)->first();

            if (! $grupo) {
                continue;
            }

            foreach ($titulos as $index => $titulo) {
                $tema = Tema::where('id_turma', $grupo->id_turma)
                    ->where('titulo', $titulo)
                    ->first();

                if (! $tema) {
                    continue;
                }

                PreferenciaTema::create([
                    'id_grupo' => $grupo->id_grupo,
                    'id_tema' => $tema->id_tema,
                    'prioridade' => $index + 1,
                ]);
            }
        }
    }
}
