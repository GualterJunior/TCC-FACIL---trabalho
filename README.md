# TCC Fácil — Sistema de Gerenciamento de Trabalhos de Conclusão de Curso

O **TCC Fácil** é uma plataforma desenvolvida em Laravel projetada para automatizar, organizar e simplificar todo o fluxo de acompanhamento de Trabalhos de Conclusão de Curso (TCC). O sistema atende de forma integrada a três perfis essenciais: **Alunos**, **Professores/Orientadores** e **Administradores/Coordenadores**.

Este repositório contém a infraestrutura do ecossistema, incluindo a arquitetura do banco de dados relacional, controladores de domínio e a implementação da **5ª Etapa (Interface Front-End e Autenticação)** utilizando Blade, Tailwind CSS e Laravel Breeze.

---

## 🚀 Requisitos Mínimos do Sistema

Antes de iniciar a instalação, certifique-se de ter os seguintes componentes instalados em sua máquina:
* **PHP:** Versão 8.2 ou superior (Recomendado PHP 8.5)
* **Gerenciador de Pacotes PHP:** Composer
* **Banco de Dados:** MySQL (via MySQL Workbench, XAMPP ou terminal nativo)
* **Ambiente de Execução JavaScript:** Node.js & NPM

---

## 🛠️ Passo a Passo para Configuração Inicial e Instalação

Siga rigorosamente os comandos abaixo no terminal do seu ambiente local (PowerShell, Git Bash ou prompt de comando) dentro do diretório do projeto clonado:

### 1. Instalação das Dependências do PHP
Logo após clonar o repositório, execute o comando abaixo para baixar e estruturar a pasta `vendor/` com todas as bibliotecas necessárias para o núcleo do Laravel:
```bash
composer install

# No Windows (PowerShell):
cp .env.example .env

# No Linux / macOS / Git Bash:
cp .env.example .env

php artisan migrate