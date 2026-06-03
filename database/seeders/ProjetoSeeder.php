<?php

namespace Database\Seeders;

use App\Models\Projeto;
use Illuminate\Database\Seeder;

class ProjetoSeeder extends Seeder
{
    public function run(): void
    {
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
            Projeto::create($projeto);
        }
    }
}
