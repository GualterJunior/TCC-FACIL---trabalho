<?php

namespace Database\Seeders;

use App\Models\Entrega;
use App\Models\Etapa;
use App\Models\Grupo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class EntregaSeeder extends Seeder
{
    public function run(): void
    {
        $this->criarArquivosDeExemplo();

        $grupos = Grupo::all();
        $etapas = Etapa::orderBy('id_etapa')->take(6)->get();

        foreach ($grupos->take(3) as $index => $grupo) {
            Entrega::updateOrCreate([
                'id_grupo' => $grupo->id_grupo,
                'id_etapa' => $etapas[0]->id_etapa ?? 1,
            ], [
                'id_grupo' => $grupo->id_grupo,
                'id_etapa' => $etapas[0]->id_etapa ?? 1,
                'nome_arquivo' => 'Proposta_' . $grupo->nome_grupo . '.pdf',
                'caminho_arquivo' => 'entregas/proposta_' . $index . '.pdf',
                'status_Entrega' => 'aprovado',
                'observacao' => 'Proposta bem estruturada com bom escopo definido.',
            ]);

            Entrega::updateOrCreate([
                'id_grupo' => $grupo->id_grupo,
                'id_etapa' => $etapas[1]->id_etapa ?? 2,
            ], [
                'id_grupo' => $grupo->id_grupo,
                'id_etapa' => $etapas[1]->id_etapa ?? 2,
                'nome_arquivo' => 'Requisitos_' . $grupo->nome_grupo . '.pdf',
                'caminho_arquivo' => 'entregas/requisitos_' . $index . '.pdf',
                'status_Entrega' => 'em_analise',
                'observacao' => 'Aguardando revisão dos requisitos.',
            ]);

            Entrega::updateOrCreate([
                'id_grupo' => $grupo->id_grupo,
                'id_etapa' => $etapas[2]->id_etapa ?? 3,
            ], [
                'id_grupo' => $grupo->id_grupo,
                'id_etapa' => $etapas[2]->id_etapa ?? 3,
                'nome_arquivo' => 'Prototipo_' . $grupo->nome_grupo . '.zip',
                'caminho_arquivo' => 'entregas/prototipo_' . $index . '.zip',
                'status_Entrega' => 'enviado',
                'observacao' => null,
            ]);
        }
    }

    private function criarArquivosDeExemplo(): void
    {
        $pdf = "%PDF-1.4\n1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>\nendobj\n4 0 obj\n<< /Length 109 >>\nstream\nBT\n/F1 18 Tf\n72 760 Td\n(TCC Facil - entrega de exemplo) Tj\n0 -32 Td\n(Este PDF serve para testar entregas.) Tj\nET\nendstream\nendobj\n5 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\nxref\n0 6\n0000000000 65535 f \n0000000009 00000 n \n0000000058 00000 n \n0000000115 00000 n \n0000000245 00000 n \n0000000406 00000 n \ntrailer\n<< /Root 1 0 R /Size 6 >>\nstartxref\n476\n%%EOF\n";

        for ($i = 0; $i <= 2; $i++) {
            Storage::disk('public')->put("entregas/proposta_{$i}.pdf", $pdf);
            Storage::disk('public')->put("entregas/requisitos_{$i}.pdf", $pdf);
            Storage::disk('public')->put("entregas/prototipo_{$i}.zip", 'Arquivo ZIP de exemplo para teste de entrega.');
        }
    }
}
