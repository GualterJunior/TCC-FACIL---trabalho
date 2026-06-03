<?php

namespace Database\Seeders;

use App\Models\Etapa;
use App\Models\Turma;
use Illuminate\Database\Seeder;

class EtapaSeeder extends Seeder
{
    public function run(): void
    {
        $turma1 = Turma::where('codigo_turma', 'ES-2024-2')->first();
        $turma2 = Turma::where('codigo_turma', 'SI-2024-2')->first();

        $etapas = [
            [
                'nome_etapa' => 'Proposta Inicial',
                'descricao' => 'Entrega da proposta do projeto com objetivos e escopo',
                'prazo_entrega' => now()->addDays(7)->toDateString(),
                'ordem_etapa' => 1,
                'id_turma' => $turma1->id_turma,
            ],
            [
                'nome_etapa' => 'Análise de Requisitos',
                'descricao' => 'Documentação dos requisitos funcionais e não-funcionais',
                'prazo_entrega' => now()->addDays(21)->toDateString(),
                'ordem_etapa' => 2,
                'id_turma' => $turma1->id_turma,
            ],
            [
                'nome_etapa' => 'Protótipo',
                'descricao' => 'Desenvolvimento do protótipo/MVP do projeto',
                'prazo_entrega' => now()->addDays(35)->toDateString(),
                'ordem_etapa' => 3,
                'id_turma' => $turma1->id_turma,
            ],
            [
                'nome_etapa' => 'Implementação',
                'descricao' => 'Desenvolvimento completo do projeto',
                'prazo_entrega' => now()->addDays(56)->toDateString(),
                'ordem_etapa' => 4,
                'id_turma' => $turma1->id_turma,
            ],
            [
                'nome_etapa' => 'Testes e Validação',
                'descricao' => 'Realização de testes e validação da solução',
                'prazo_entrega' => now()->addDays(63)->toDateString(),
                'ordem_etapa' => 5,
                'id_turma' => $turma1->id_turma,
            ],
            [
                'nome_etapa' => 'Documentação Final',
                'descricao' => 'Preparação da documentação final e manual de usuário',
                'prazo_entrega' => now()->addDays(70)->toDateString(),
                'ordem_etapa' => 6,
                'id_turma' => $turma1->id_turma,
            ],
            [
                'nome_etapa' => 'Proposta Inicial',
                'descricao' => 'Entrega da proposta do projeto com objetivos e escopo',
                'prazo_entrega' => now()->addDays(10)->toDateString(),
                'ordem_etapa' => 1,
                'id_turma' => $turma2->id_turma,
            ],
            [
                'nome_etapa' => 'Análise de Requisitos',
                'descricao' => 'Documentação dos requisitos funcionais e não-funcionais',
                'prazo_entrega' => now()->addDays(24)->toDateString(),
                'ordem_etapa' => 2,
                'id_turma' => $turma2->id_turma,
            ],
        ];

        foreach ($etapas as $etapa) {
            Etapa::create($etapa);
        }
    }
}
