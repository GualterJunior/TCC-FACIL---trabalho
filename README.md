# TCC Fácil

Sistema web em Laravel para sorteio e acompanhamento de temas de Trabalho de Conclusão de Curso. O projeto organiza turmas, grupos, temas, sorteios, etapas, entregas, correções, validações, notas, projetos de referência e suporte.

## Funcionalidades

- Landing page pública de apresentação do sistema.
- Login e cadastro com perfis de acesso.
- Cadastro público restrito a alunos.
- Professores e coordenadores criados pela área administrativa.
- Dashboard separado para aluno e equipe acadêmica.
- Controle de permissões por perfil.
- Gestão de usuários, turmas, grupos, temas, etapas, projetos e suporte.
- Entrada do aluno em turma por código de acesso.
- Distribuição automática do aluno em grupo com vaga.
- Limite básico de integrantes por grupo.
- Sorteio automático de temas por turma.
- Histórico de sorteios.
- Tela Meu TCC para o aluno acompanhar tema, etapas, entregas e progresso.
- Tela Meu grupo com integrantes, tema, entregas, correções e notas.
- Envio e reenvio de entregas.
- Validação de entregas por professor/coordenador.
- Histórico de correções por entrega.
- Lançamento e consulta de notas.
- Acompanhamento administrativo com resumo de turmas, grupos, grupos sem tema e entregas pendentes.
- Cadastro de projetos de referência com banner e PDF.
- Inicialização automática do ambiente ao rodar `php artisan serve`.

## Perfis de acesso

### Aluno

O aluno acessa:

- Dashboard do aluno.
- Minhas turmas.
- Meu TCC.
- Meu grupo.
- Temas.
- Projetos publicados.
- Minhas entregas.
- Reenvio de entregas corrigidas.
- Minhas notas.
- Histórico de sorteios.
- Suporte.

O aluno não acessa:

- Usuários.
- Cadastro administrativo de turmas.
- Cadastro administrativo de etapas.
- Cadastro administrativo de sorteios.
- Validações administrativas.
- Lançamento de notas.
- Edição e exclusão de cadastros administrativos.

### Professor e coordenador

Professor e coordenador acessam:

- Dashboard administrativo.
- Usuários.
- Projetos.
- Turmas.
- Grupos.
- Temas.
- Etapas.
- Entregas.
- Validações.
- Correções.
- Notas.
- Sorteios.
- Acompanhamento.
- Suporte.

Também podem validar entregas, registrar correções, lançar notas e acompanhar o progresso das turmas.

## Como iniciar o projeto

Depois de clonar o repositório, entre na pasta do projeto e execute:

```bash
php artisan serve
```

O arquivo `artisan` foi ajustado para preparar o projeto automaticamente antes de iniciar o servidor.

Ao rodar `php artisan serve`, o sistema tenta executar:

- criação do `.env`, se ainda não existir;
- criação do arquivo `database/database.sqlite`, se ainda não existir;
- ativação local das extensões SQLite configuradas em `.php-ini-scan`;
- `composer install`, se `vendor` estiver ausente ou desatualizado;
- `npm install`, se `node_modules` estiver ausente ou desatualizado;
- `npm run build`, se `public/build` estiver ausente ou desatualizado;
- geração da `APP_KEY`, se estiver vazia;
- limpeza de cache do Laravel;
- `php artisan migrate --force`;
- `php artisan storage:link --force`, se o link ainda não existir;
- início do servidor local.

> Observação: o computador precisa ter PHP, Composer, Node.js e npm instalados para a primeira execução automática funcionar.

## Banco de dados

O projeto está configurado para usar SQLite por padrão no `.env.example`, evitando a necessidade de criar um banco MySQL manualmente.

As principais tabelas criadas pelas migrations incluem:

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
- suportes

## Dados de teste

Para popular o banco com usuários e exemplos:

```bash
php artisan db:seed
```

Exemplos de login:

```text
maria@tcc-facil.com
password
```

```text
ana.silva@tcc-facil.com
password
```

```text
aluno1@student.com
password
```

## Links principais

Com o servidor rodando em `http://127.0.0.1:8000`:

```text
/                         Landing page
/login                    Login
/register                 Cadastro de aluno
/dashboard                Dashboard conforme perfil
/minhas-turmas            Entrada do aluno em turmas
/meu-tcc                  Acompanhamento do TCC do aluno
/minhas-notas             Notas do aluno
/projetos                 Projetos de referência
/grupos                   Grupos
/temas                    Temas
/entregas                 Entregas e reenvios
/historico-sorteios       Histórico de sorteios
/suportes                 Suporte
/users                    Usuários
/turmas                   Turmas
/validacoes               Validação de entregas
/notas                    Lançamento de notas
/etapas                   Etapas
/sorteios                 Sorteio de temas
/acompanhamento           Relatório de acompanhamento
```

As rotas administrativas são protegidas por login e permissão de perfil.

## Tecnologias

- Laravel 12
- Blade
- Bootstrap 5
- Tailwind/Vite
- SQLite
- PHP 8.2+
- Node.js/npm

## Validação

Comandos usados para validar o projeto:

```bash
php artisan view:cache
php artisan test
npm run build
```

## Observações de permissão

O controle de acesso usa o campo `tipo` da tabela `users`.

Valores aceitos:

```text
aluno
professor
coordenador
```

O middleware `role` bloqueia acessos indevidos no backend, além da interface esconder opções que não pertencem ao perfil logado.
