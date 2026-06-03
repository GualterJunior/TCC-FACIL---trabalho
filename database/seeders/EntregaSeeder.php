<?php

namespace Database\Seeders;

use App\Models\Entrega;
use App\Models\Etapa;
use App\Models\Grupo;
use Illuminate\Database\Seeder;

class EntregaSeeder extends Seeder
{
    public function run(): void
    {
        $grupos = Grupo::all();
        $etapas = Etapa::orderBy('id_etapa')->take(6)->get();

        foreach ($grupos->take(3) as $index => $grupo) {
            Entrega::create([
                'id_grupo' => $grupo->id_grupo,
                'id_etapa' => $etapas[0]->id_etapa ?? 1,
                'nome_arquivo' => 'Proposta_' . $grupo->nome_grupo . '.pdf',
                'caminho_arquivo' => 'entregas/proposta_' . $index . '.pdf',
                'status_Entrega' => 'aprovado',
                'observacao' => 'Proposta bem estruturada com bom escopo definido.',
            ]);

            Entrega::create([
                'id_grupo' => $grupo->id_grupo,
                'id_etapa' => $etapas[1]->id_etapa ?? 2,
                'nome_arquivo' => 'Requisitos_' . $grupo->nome_grupo . '.pdf',
                'caminho_arquivo' => 'entregas/requisitos_' . $index . '.pdf',
                'status_Entrega' => 'em_analise',
                'observacao' => 'Aguardando revisão dos requisitos.',
            ]);

            Entrega::create([
                'id_grupo' => $grupo->id_grupo,
                'id_etapa' => $etapas[2]->id_etapa ?? 3,
                'nome_arquivo' => 'Prototipo_' . $grupo->nome_grupo . '.zip',
                'caminho_arquivo' => 'entregas/prototipo_' . $index . '.zip',
                'status_Entrega' => 'enviado',
                'observacao' => null,
            ]);
        }
    }
}
