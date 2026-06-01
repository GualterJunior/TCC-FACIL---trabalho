# TCC Facil

Sistema web em Laravel para gerenciamento de Trabalhos de Conclusao de Curso, com area publica, autenticacao, paineis por perfil e rotinas administrativas para acompanhamento de projetos, grupos, entregas, avaliacoes e notas.

## O que foi implementado

- Landing page publica com apresentacao do sistema.
- Diferenciacao visual entre acesso de aluno e acesso de professor/coordenador.
- Telas de login e cadastro com Bootstrap.
- Cadastro com selecao de perfil: aluno, professor ou coordenador.
- Dashboard separado por tipo de usuario.
- Navbar administrativa com opcoes por permissao.
- Area do aluno com acesso a projetos, grupo, temas e entregas.
- Area de professor/coordenador com acesso a usuarios, turmas, avaliacoes, validacoes, notas, etapas e sorteios.
- Bloqueio de rotas administrativas para alunos.
- CRUDs em Blade para os principais modulos.
- Cadastro de projetos com banner e PDF.
- Logo do TCC Facil aplicada nas telas.
- Migrations para as tabelas usadas pelo sistema.
- Ajuste local para SQLite no Windows quando a extensao nao estiver habilitada globalmente.

## Perfis de acesso

### Aluno

O aluno acessa:

- Dashboard do aluno
- Projetos
- Meu grupo
- Temas
- Minhas entregas
- Envio de nova entrega

O aluno nao acessa:

- Usuarios
- Turmas
- Notas
- Validacoes
- Etapas
- Sorteios
- Edicao/exclusao de cadastros administrativos

### Professor e coordenador

Professor e coordenador acessam:

- Dashboard administrativo
- Usuarios
- Projetos
- Turmas
- Grupos
- Entregas
- Validacoes
- Notas
- Etapas
- Sorteios

Tambem podem avaliar entregas, lancar notas e gerenciar cadastros administrativos.

## Como iniciar o projeto

Depois de clonar o repositorio, entre na pasta do projeto e execute apenas:

```bash
php artisan serve
```

O arquivo `artisan` foi ajustado para preparar o projeto automaticamente antes de iniciar o servidor.

Ao rodar `php artisan serve`, o sistema tenta executar:

- criacao do `.env`, se ainda nao existir;
- criacao do arquivo `database/database.sqlite`, se ainda nao existir;
- `composer install`, se a pasta `vendor` nao existir;
- geracao da `APP_KEY`, se estiver vazia;
- limpeza de cache do Laravel;
- `php artisan migrate --force`;
- `php artisan storage:link --force`, somente se o link ainda nao existir;
- inicio do servidor local.

> Observacao: o computador precisa ter PHP e Composer instalados para a primeira execucao automatica funcionar.

## Banco de dados

O projeto esta configurado para usar SQLite por padrao no `.env.example`, evitando a necessidade de criar um banco MySQL manualmente.

As tabelas criadas pelas migrations incluem:

- users
- turmas
- grupos
- grupo_integrantes
- temas
- entrega
- projetos
- etapas
- notas
- validacoes
- sorteios
- resultado_sorteio
- progresso_grupo
- correcoes

## Links principais

Com o servidor rodando em `http://127.0.0.1:8000`:

```text
/              Landing page
/login         Login
/register      Cadastro
/dashboard     Dashboard conforme perfil do usuario
```

Rotas principais:

```text
/projetos
/grupos
/temas
/entregas
/users
/turmas
/validacoes
/notas
/etapas
/sorteios
```

As rotas administrativas sao protegidas por login e permissao de perfil.

## Tecnologias

- Laravel 12
- Blade
- Bootstrap 5
- SQLite
- PHP 8.2+

## Observacoes de permissao

O controle de acesso usa o campo `tipo` da tabela `users`.

Valores aceitos:

```text
aluno
professor
coordenador
```

O middleware `role` bloqueia acessos indevidos no backend, alem da interface esconder opcoes que nao pertencem ao perfil logado.
