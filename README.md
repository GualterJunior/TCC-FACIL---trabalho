# TCC Facil

Sistema web em Laravel para sorteio e acompanhamento de temas de Trabalho de Conclusao de Curso. O projeto organiza turmas, grupos, temas, sorteios, etapas, entregas, validacoes, notas, projetos de referencia e suporte.

## Status atual

O sistema esta pronto para demonstracao local. A inicializacao foi automatizada para facilitar a apresentacao: ao executar `php artisan serve`, o projeto prepara ambiente, dependencias, banco SQLite, arquivos publicos e dados basicos quando necessario.

Foi validado que as telas principais renderizam corretamente para os perfis de coordenador/professor e aluno. A validacao automatizada atual cobre dashboards, projetos, turmas, grupos, temas, entregas, sorteios, etapas, notas, usuarios, validacoes, acompanhamento, suporte, perfil, Meu TCC e historico de sorteios.

Resultado da ultima validacao:

```text
php artisan test  OK - 4 tests, 62 assertions
npm run build     OK
```

Dados ficticios disponiveis apos `php artisan migrate:fresh --seed`:

```text
18 usuarios
2 turmas
5 grupos
7 temas
5 projetos
9 entregas
2 sorteios
5 notas
8 etapas
```

## O que foi feito nesta versao

- Criacao de preferencias de tema por grupo, com ate 3 opcoes em ordem de prioridade.
- Melhoria do algoritmo de sorteio para tentar atender preferencias antes de usar distribuicao aleatoria.
- Registro de auditoria do sorteio, incluindo executor, data/hora, resumo e criterio usado em cada resultado.
- Tela de resultados do sorteio mostrando se o tema veio por preferencia atendida ou por sorteio aleatorio.
- Tela de listagem de sorteios com acoes diretas para abrir resultado e executar sorteio.
- Criacao da tela de nova entrega integrada ao fluxo atual do controller.
- Ajuste das policies de Sorteio, Projeto e Validacao para liberar as telas administrativas aos perfis corretos.
- Configuracao de SQLite local para demonstracao sem depender de MySQL.
- Instalacao automatica de PHP portatil atualizado e Composer local quando necessario.
- Ajuste da navbar para deixar Sorteios como item principal unico e mover rotas administrativas para um menu compacto.
- Inclusao do usuario `coordenador@tccfacil.com` no seeder, garantindo acesso administrativo apos clonar e popular o banco.
- Teste automatizado de fumaca para garantir que as telas principais abrem sem erro para coordenador e aluno.

## Funcionalidades

- Landing page publica de apresentacao do sistema.
- Login e cadastro com perfis de acesso.
- Cadastro publico restrito a alunos.
- Professores e coordenadores criados pela area administrativa.
- Dashboard separado para aluno e equipe academica.
- Controle de permissoes por perfil.
- Gestao de usuarios, turmas, grupos, temas, etapas, projetos e suporte.
- Entrada do aluno em turma por codigo de acesso.
- Distribuicao automatica do aluno em grupo com vaga.
- Criacao de grupo pelo aluno quando nao houver grupo ativo com vaga.
- Criacao de grupos, temas e projetos pela area administrativa.
- Cadastro de ate 3 preferencias de tema por grupo.
- Limite basico de integrantes por grupo.
- Sorteio automatico de temas por turma, priorizando preferencias dos grupos.
- Auditoria do sorteio com executor, data, resumo e criterio usado em cada distribuicao.
- Historico de sorteios.
- Tela Meu TCC para o aluno acompanhar tema, etapas, entregas e progresso.
- Tela Meu grupo com integrantes, tema, entregas, correcoes e notas.
- Envio e reenvio de entregas.
- Validacao de entregas por professor/coordenador.
- Historico de correcoes por entrega.
- Lancamento e consulta de notas.
- Acompanhamento administrativo com resumo de turmas, grupos, grupos sem tema e entregas pendentes.
- Cadastro de projetos de referencia com banner e PDF.
- Documentos e arquivos de teste criados pelos seeders.
- Inicializacao automatica do ambiente ao rodar `php artisan serve`.

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
- Historico de sorteios.
- Suporte.

O aluno nao acessa:

- Usuarios.
- Cadastro administrativo de turmas.
- Cadastro administrativo de etapas.
- Cadastro administrativo de sorteios.
- Validacoes administrativas.
- Lancamento de notas.
- Edicao e exclusao de cadastros administrativos.

### Professor e coordenador

Professor e coordenador acessam:

- Dashboard administrativo.
- Usuarios.
- Projetos.
- Turmas.
- Grupos.
- Temas.
- Etapas.
- Entregas.
- Validacoes.
- Correcoes.
- Notas.
- Sorteios.
- Acompanhamento.
- Suporte.

Tambem podem criar turmas, grupos, temas, projetos, validar entregas, registrar correcoes, lancar notas, executar sorteios e acompanhar o progresso das turmas.

## Como iniciar o projeto

Depois de clonar o repositorio, entre na pasta do projeto e execute:

```bash
php artisan serve
```

O arquivo `artisan` foi ajustado para preparar o projeto automaticamente antes de iniciar o servidor.

Ao rodar `php artisan serve`, o sistema tenta executar:

- criacao do `.env`, se ainda nao existir;
- criacao do arquivo `database/database.sqlite`, se ainda nao existir;
- ativacao local das extensoes SQLite configuradas em `.php-ini-scan`;
- instalacao local de um PHP portatil atualizado, se o PHP ativo for menor que 8.2;
- instalacao local do Composer (`composer.phar`), se o Composer global nao estiver disponivel;
- `composer install`, se `vendor` estiver ausente ou desatualizado;
- `npm install`, se `node_modules` estiver ausente ou desatualizado;
- `npm run build`, se `public/build` estiver ausente ou desatualizado;
- geracao da `APP_KEY`, se estiver vazia;
- limpeza de cache do Laravel;
- `php artisan migrate --force`;
- criacao do coordenador padrao, caso ainda nao exista;
- `php artisan storage:link --force`, se o link ainda nao existir;
- inicio do servidor local.

> Observacao: o computador precisa ter Node.js e npm instalados para a primeira execucao automatica funcionar. Se o PHP ativo for menor que 8.2, o proprio `php artisan serve` tenta baixar e usar um PHP portatil local. Se o Composer global nao existir, ele tambem tenta baixar e usar um `composer.phar` local.

## Banco de dados

O projeto esta configurado para usar SQLite por padrao no `.env.example`, evitando a necessidade de criar um banco MySQL manualmente.

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
- preferencias_tema
- progresso_grupo
- correcoes
- suportes

## Dados de teste

Ao iniciar o projeto com `php artisan serve`, um coordenador padrao e criado automaticamente, caso ainda nao exista:

```text
coordenador@tccfacil.com
password
```

Use esse acesso para entrar na area administrativa logo apos clonar o projeto.

Para recriar o banco e popular com dados de exemplo:

```bash
php artisan migrate:fresh --seed
```

Exemplos de login:

```text
coordenador@tccfacil.com
password
```

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

Tambem existem alunos de teste de `aluno1@student.com` ate `aluno12@student.com`, todos com a senha `password`.

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
/projetos                 Projetos de referencia
/projetos/create          Criar projeto
/grupos                   Grupos
/grupos/create            Criar grupo
/temas                    Temas
/temas/create             Criar tema
/entregas                 Entregas e reenvios
/historico-sorteios       Historico de sorteios
/suportes                 Suporte
/users                    Usuarios
/turmas                   Turmas
/turmas/create            Criar turma
/validacoes               Validacao de entregas
/notas                    Lancamento de notas
/etapas                   Etapas
/sorteios                 Sorteio de temas
/acompanhamento           Relatorio de acompanhamento
```

As rotas administrativas sao protegidas por login e permissao de perfil.

## Fluxo recomendado para teste

### Coordenador/professor

1. Entrar com o usuario coordenador.
2. Criar ou abrir uma turma.
3. Criar grupos dentro da turma.
4. Criar temas para a turma.
5. Revisar as preferencias de tema nos grupos.
6. Criar um sorteio.
7. Executar o sorteio.
8. Conferir o criterio de distribuicao: preferencia atendida ou aleatorio.
9. Acompanhar entregas, validacoes e notas.

### Aluno

1. Entrar com um aluno de teste.
2. Acessar Minhas turmas.
3. Entrar em uma turma pelo codigo.
4. Criar grupo caso nao exista grupo ativo com vaga.
5. Abrir o grupo e escolher ate 3 preferencias de tema.
6. Acessar Meu TCC apos o sorteio.
7. Enviar uma entrega.
8. Consultar notas e historico.

## Tecnologias

- Laravel 12
- Blade
- Bootstrap 5
- Tailwind/Vite
- SQLite
- PHP 8.2+
- Node.js/npm

## Validacao

Comandos usados para validar o projeto:

```bash
php artisan optimize:clear
php artisan migrate:fresh --seed
php artisan test
npm run build
```

Ultima validacao realizada:

```text
php artisan migrate:fresh --seed  OK
php artisan test                  OK
npm run build                     OK
```

## Observacoes de permissao

O controle de acesso usa o campo `tipo` da tabela `users`.

Valores aceitos:

```text
aluno
professor
coordenador
```

O middleware `role` bloqueia acessos indevidos no backend, alem da interface esconder opcoes que nao pertencem ao perfil logado.
