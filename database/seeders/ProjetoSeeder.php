<?php

namespace Database\Seeders;

use App\Models\Projeto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProjetoSeeder extends Seeder
{
    public function run(): void
    {
        $this->criarArquivosDeExemplo();

        $projetos = [
            [
                'titulo' => 'Sistema de Gerenciamento de Projetos',
                'autor' => 'Equipe de Engenharia de Software',
                'descricao' => 'Uma plataforma completa para gerenciar projetos com suporte a Kanban, Gantt e colaboração em tempo real.',
                'status' => 'publicado',
                'banner_path' => 'projetos/banner-1.jpg',
                'pdf_path' => 'projetos/projeto-1.pdf',
            ],
            [
                'titulo' => 'API REST para E-commerce',
                'autor' => 'Grupo Alpha',
                'descricao' => 'API robusta desenvolvida em Laravel para gerenciar produtos, pedidos e pagamentos de uma plataforma de e-commerce.',
                'status' => 'publicado',
                'banner_path' => 'projetos/banner-2.jpg',
                'pdf_path' => 'projetos/projeto-2.pdf',
            ],
            [
                'titulo' => 'Aplicativo Mobile de Redes Sociais',
                'autor' => 'Grupo Beta',
                'descricao' => 'Aplicativo mobile desenvolvido com React Native para compartilhamento de conteúdo, mensagens e recomendações de amigos.',
                'status' => 'publicado',
                'banner_path' => 'projetos/banner-3.jpg',
                'pdf_path' => 'projetos/projeto-3.pdf',
            ],
            [
                'titulo' => 'Dashboard Analítico de Dados',
                'autor' => 'Grupo Gamma',
                'descricao' => 'Plataforma de visualização de dados com gráficos interativos, relatórios em tempo real e análise preditiva.',
                'status' => 'rascunho',
                'banner_path' => 'projetos/banner-4.jpg',
                'pdf_path' => 'projetos/projeto-4.pdf',
            ],
            [
                'titulo' => 'Sistema de Autenticação Seguro',
                'autor' => 'Grupo Delta',
                'descricao' => 'Sistema de autenticação multi-camadas com OAuth2, biometria e autenticação multi-fator.',
                'status' => 'publicado',
                'banner_path' => 'projetos/banner-5.jpg',
                'pdf_path' => 'projetos/projeto-5.pdf',
            ],
        ];

        foreach ($projetos as $projeto) {
            Projeto::updateOrCreate(
                ['titulo' => $projeto['titulo']],
                $projeto
            );
        }
    }

    private function criarArquivosDeExemplo(): void
    {
        $pdf = "%PDF-1.4\n1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>\nendobj\n4 0 obj\n<< /Length 112 >>\nstream\nBT\n/F1 18 Tf\n72 760 Td\n(TCC Facil - documento de exemplo) Tj\n0 -32 Td\n(Este PDF serve para testar a abertura de projetos.) Tj\nET\nendstream\nendobj\n5 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\nxref\n0 6\n0000000000 65535 f \n0000000009 00000 n \n0000000058 00000 n \n0000000115 00000 n \n0000000245 00000 n \n0000000409 00000 n \ntrailer\n<< /Root 1 0 R /Size 6 >>\nstartxref\n479\n%%EOF\n";
        $banner = base64_decode('/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAP//////////////////////////////////////////////////////////////////////////////////////2wBDAf//////////////////////////////////////////////////////////////////////////////////////wAARCAABAAEDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAX/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIQAxAAAAH/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/9oACAEBAAEFAqf/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oACAEDAQE/ASP/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oACAECAQE/ASP/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/9oACAEBAAY/Al//xAAUEAEAAAAAAAAAAAAAAAAAAAAA/9oACAEBAAE/IV//2gAMAwEAAgADAAAAEP/EFBQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8QH//EFBQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8QH//EFBABAQAAAAAAAAAAAAAAAAAAABD/2gAIAQEAAT8QH//Z');

        for ($i = 1; $i <= 5; $i++) {
            Storage::disk('public')->put("projetos/projeto-{$i}.pdf", $pdf);
            Storage::disk('public')->put("projetos/banner-{$i}.jpg", $banner);
        }
    }
}
