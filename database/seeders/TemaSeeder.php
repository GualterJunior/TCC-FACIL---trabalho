<?php

namespace Database\Seeders;

use App\Models\Tema;
use App\Models\Turma;
use Illuminate\Database\Seeder;

class TemaSeeder extends Seeder
{
    public function run(): void
    {
        $turma1 = Turma::where('codigo_turma', 'ES-2024-2')->first();
        $turma2 = Turma::where('codigo_turma', 'SI-2024-2')->first();

        $temas = [
            [
                'titulo' => 'Sistema de Gerenciamento de Projetos Web',
                'descricao' => 'Desenvolvimento de uma plataforma web para gerenciamento agil de projetos com integracao de equipes remotas.',
                'area' => 'Web',
                'status_tema' => 'disponivel',
                'id_turma' => $turma1->id_turma,
            ],
            [
                'titulo' => 'API REST para E-commerce',
                'descricao' => 'Desenvolvimento de uma API robusta para plataforma de e-commerce com autenticacao, pagamentos e inventario.',
                'area' => 'Backend',
                'status_tema' => 'disponivel',
                'id_turma' => $turma1->id_turma,
            ],
            [
                'titulo' => 'Aplicativo Mobile de Redes Sociais',
                'descricao' => 'Criacao de aplicativo mobile para redes sociais com feeds, mensagens e recomendacoes.',
                'area' => 'Mobile',
                'status_tema' => 'disponivel',
                'id_turma' => $turma1->id_turma,
            ],
            [
                'titulo' => 'Dashboard Analitico de Dados',
                'descricao' => 'Plataforma de visualizacao de dados com graficos interativos e relatorios em tempo real.',
                'area' => 'Frontend',
                'status_tema' => 'disponivel',
                'id_turma' => $turma1->id_turma,
            ],
            [
                'titulo' => 'Sistema de Autenticacao Seguro',
                'descricao' => 'Desenvolvimento de sistema de autenticacao com OAuth2, biometria e autenticacao multi-fator.',
                'area' => 'Security',
                'status_tema' => 'disponivel',
                'id_turma' => $turma2->id_turma,
            ],
            [
                'titulo' => 'Plataforma de Aprendizado Online',
                'descricao' => 'LMS com suporte a videoaulas, quizzes, certificados e rastreamento de progresso.',
                'area' => 'Web',
                'status_tema' => 'disponivel',
                'id_turma' => $turma2->id_turma,
            ],
            [
                'titulo' => 'Sistema IoT de Monitoramento',
                'descricao' => 'Plataforma para coleta e analise de dados de dispositivos IoT em tempo real.',
                'area' => 'IoT',
                'status_tema' => 'disponivel',
                'id_turma' => $turma2->id_turma,
            ],
        ];

        foreach ($temas as $tema) {
            Tema::create($tema);
        }
    }
}
