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
                'descricao' => 'Desenvolvimentode uma plataforma web para gerenciamento ágil de projetos com integração de equipes remotas',
                'area' => 'Web',
                'status_tema' => 'disponivel',
                'id_turma' => $turma1->id_turma,
            ],
            [
                'titulo' => 'API REST para E-commerce',
                'descricao' => 'Desenvolvimento de uma API robusta para plataforma de e-commerce com autenticação, pagamentos e inventário',
                'area' => 'Backend',
                'status_tema' => 'disponivel',
                'id_turma' => $turma1->id_turma,
            ],
            [
                'titulo' => 'Aplicativo Mobile de Redes Sociais',
                'descricao' => 'Criação de aplicativo mobile para redes sociais com feeds, mensagens e recomendações',
                'area' => 'Mobile',
                'status_tema' => 'disponivel',
                'id_turma' => $turma1->id_turma,
            ],
            [
                'titulo' => 'Dashboard Analítico de Dados',
                'descricao' => 'Plataforma de visualização de dados com gráficos interativos e relatórios em tempo real',
                'area' => 'Frontend',
                'status_tema' => 'disponivel',
                'id_turma' => $turma1->id_turma,
            ],
            [
                'titulo' => 'Sistema de Autenticação Seguro',
                'descricao' => 'Desenvolvimento de sistema de autenticação com OAuth2, biometria e autenticação multi-fator',
                'area' => 'Security',
                'status_tema' => 'disponivel',
                'id_turma' => $turma2->id_turma,
            ],
            [
                'titulo' => 'Plataforma de Aprendizado Online',
                'descricao' => 'LMS com suporte a videoaulas, quizzes, certificados e rastreamento de progresso',
                'area' => 'Web',
                'status_tema' => 'disponivel',
                'id_turma' => $turma2->id_turma,
            ],
            [
                'titulo' => 'Sistema IoT de Monitoramento',
                'descricao' => 'Plataforma para coleta e análise de dados de dispositivos IoT em tempo real',
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
