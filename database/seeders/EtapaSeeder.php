<?php

namespace Database\Seeders;

use App\Models\Etapa;
use App\Models\Turma;
use Illuminate\Database\Seeder;

class EtapaSeeder extends Seeder
{
    public function run(): void
    {
        $turmas = Turma::orderBy('id_turma')->get();

        foreach ($turmas as $turma) {
            $etapas = [
                [
                    'nome_etapa' => 'Definicao do Tema',
                    'descricao' => 'Tema, objetivo e justificativa do trabalho.',
                    'prazo_entrega' => now()->addDays(10)->toDateString(),
                    'ordem_etapa' => 1,
                ],
                [
                    'nome_etapa' => 'Fundamentacao Teorica',
                    'descricao' => 'Pesquisa bibliografica e referencial teorico.',
                    'prazo_entrega' => now()->addDays(25)->toDateString(),
                    'ordem_etapa' => 2,
                ],
                [
                    'nome_etapa' => 'Desenvolvimento',
                    'descricao' => 'Execucao do trabalho, metodologia aplicada ou sistema.',
                    'prazo_entrega' => now()->addDays(45)->toDateString(),
                    'ordem_etapa' => 3,
                ],
                [
                    'nome_etapa' => 'Entrega Final',
                    'descricao' => 'Ajustes, formatacao e submissao da versao final.',
                    'prazo_entrega' => now()->addDays(60)->toDateString(),
                    'ordem_etapa' => 4,
                ],
            ];

            foreach ($etapas as $etapa) {
                Etapa::create($etapa + ['id_turma' => $turma->id_turma]);
            }
        }
    }
}
