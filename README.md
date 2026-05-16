<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5% 20SVG/2% 20CMYK/1% 20Full% 20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# TCC Fácil: Sistema de Sorteio e Acompanhamento de Temas

[cite_start]O **TCC Fácil** é uma plataforma web projetada para mitigar os desafios organizacionais enfrentados durante o Trabalho de Conclusão de Curso[cite: 1]. [cite_start]O sistema foca na automação da distribuição de temas e no monitoramento rigoroso de prazos, promovendo equidade e transparência entre alunos, professores e coordenadores[cite: 1, 2].

## 📋 Visão Geral do Projeto

[cite_start]Atualmente, muitos processos de escolha de temas são manuais, o que gera falta de controle e riscos de atrasos na entrega final[cite: 2]. [cite_start]A solução proposta automatiza integralmente o sorteio e oferece uma interface de acompanhamento evolutivo dividida em etapas críticas[cite: 2]:

1.  [cite_start]**Definição do Tema:** Alinhamento de objetivos e justificativa[cite: 3].
2.  [cite_start]**Fundamentação Teórica:** Pesquisa bibliográfica e referencial[cite: 3].
3.  [cite_start]**Desenvolvimento:** Execução metodológica e técnica[cite: 3].
4.  [cite_start]**Entrega Final:** Ajustes, formatação e submissão[cite: 3].

## 🛠️ Especificações Técnicas (Estrutura Inicial)

A base do sistema foi estabelecida utilizando tecnologias modernas para garantir robustez e escalabilidade:

* **Framework:** Laravel 12.x (Skeleton Application).
* **Linguagem:** PHP ^8.2.
* **Ferramentas de Desenvolvimento:** Laravel Sail (Docker), Pint (Linting) e Pest/PHPUnit (Testes).
* **Arquitetura:** Estrutura MVC nativa do Laravel com carregamento PSR-4 para classes do diretório `app/`.

## 👥 Perfis de Acesso

[cite_start]O ecossistema divide as funcionalidades para atender às necessidades específicas de cada ator[cite: 2, 4]:
* [cite_start]**Área do Professor/Coordenador:** Gestão de turmas, cadastro criterioso de temas e monitoramento de progresso por etapa[cite: 4].
* [cite_start]**Área do Aluno:** Ingressar em grupos via código, visualização do sorteio online em tempo real e histórico de submissões[cite: 4, 5].

## 🚀 Instruções de Configuração

Como o repositório já se encontra configurado e versionado, para rodar o ambiente de desenvolvimento localmente, utilize:

```bash
# Instalação de dependências e configuração de ambiente
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
