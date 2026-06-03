<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('projetos')) {
            Schema::create('projetos', function (Blueprint $table) {
                $table->id('id_projeto');
                $table->string('titulo');
                $table->string('autor');
                $table->text('descricao');
                $table->string('status')->default('rascunho');
                $table->string('banner_path');
                $table->string('pdf_path');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('etapas')) {
            Schema::create('etapas', function (Blueprint $table) {
                $table->id('id_etapa');
                $table->string('nome_etapa');
                $table->text('descricao')->nullable();
                $table->date('prazo_entrega');
                $table->unsignedInteger('ordem_etapa')->default(1);
                $table->foreignId('id_turma')->constrained('turmas', 'id_turma')->onDelete('cascade');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('grupo_integrantes')) {
            Schema::create('grupo_integrantes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_grupo')->constrained('grupos', 'id_grupo')->onDelete('cascade');
                $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
                $table->timestamps();

                $table->unique(['id_grupo', 'id_usuario']);
            });
        }

        if (! Schema::hasTable('notas')) {
            Schema::create('notas', function (Blueprint $table) {
                $table->id('id_nota');
                $table->foreignId('id_grupo')->constrained('grupos', 'id_grupo')->onDelete('cascade');
                $table->foreignId('id_professor')->constrained('users')->onDelete('cascade');
                $table->decimal('nota', 4, 2);
                $table->text('comentario')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('progresso_grupo')) {
            Schema::create('progresso_grupo', function (Blueprint $table) {
                $table->id('id_progresso');
                $table->foreignId('id_grupo')->constrained('grupos', 'id_grupo')->onDelete('cascade');
                $table->foreignId('id_etapa')->constrained('etapas', 'id_etapa')->onDelete('cascade');
                $table->string('status_progresso')->default('pendente');
                $table->unsignedTinyInteger('percentual')->default(0);
                $table->text('observacao')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('sorteios')) {
            Schema::create('sorteios', function (Blueprint $table) {
                $table->id('id_sorteio');
                $table->foreignId('id_turma')->constrained('turmas', 'id_turma')->onDelete('cascade');
                $table->date('data_sorteio');
                $table->string('status_sorteio')->default('agendado');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('resultado_sorteio')) {
            Schema::create('resultado_sorteio', function (Blueprint $table) {
                $table->id('id_resultado');
                $table->foreignId('id_sorteio')->constrained('sorteios', 'id_sorteio')->onDelete('cascade');
                $table->foreignId('id_grupo')->constrained('grupos', 'id_grupo')->onDelete('cascade');
                $table->foreignId('id_tema')->constrained('temas', 'id_tema')->onDelete('cascade');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('validacoes')) {
            Schema::create('validacoes', function (Blueprint $table) {
                $table->id('id_validacao');
                $table->foreignId('id_entrega')->constrained('entrega', 'id_entrega')->onDelete('cascade');
                $table->foreignId('id_professor')->constrained('users')->onDelete('cascade');
                $table->string('status_validacao')->default('pendente');
                $table->text('comentario')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('correcoes')) {
            Schema::create('correcoes', function (Blueprint $table) {
                $table->id('id_correcao');
                $table->foreignId('id_entrega')->constrained('entrega', 'id_entrega')->onDelete('cascade');
                $table->foreignId('id_professor')->constrained('users')->onDelete('cascade');
                $table->string('status_correcao')->default('pendente');
                $table->text('comentario')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('suportes')) {
            Schema::create('suportes', function (Blueprint $table) {
                $table->id('id_suporte');
                $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
                $table->foreignId('id_turma')->nullable()->constrained('turmas', 'id_turma')->onDelete('set null');
                $table->string('assunto');
                $table->text('mensagem');
                $table->string('status_suporte')->default('aberto');
                $table->text('resposta')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('correcoes');
        Schema::dropIfExists('suportes');
        Schema::dropIfExists('validacoes');
        Schema::dropIfExists('resultado_sorteio');
        Schema::dropIfExists('sorteios');
        Schema::dropIfExists('progresso_grupo');
        Schema::dropIfExists('notas');
        Schema::dropIfExists('grupo_integrantes');
        Schema::dropIfExists('projetos');
    }
};
