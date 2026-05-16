<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('turmas', function (Blueprint $table) {

            $table->id('id_turma');

            $table->string('nome_turma');

            $table->string('codigo_turma')->unique();

            $table->string('semestre');

            $table->text('descricao')->nullable();

            $table->string('status_turma')->default('ativa');

            $table->foreignId('id_professor')
                ->constrained('users')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};