<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('temas', function (Blueprint $table) {

            $table->id('id_tema');

            $table->string('titulo');

            $table->text('descricao');

            $table->string('area');

            $table->date('data_conclusao')->nullable();

            $table->string('status_tema')->default('disponivel');

            $table->foreignId('id_turma')
                ->constrained('turmas', 'id_turma')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temas');
    }
};
