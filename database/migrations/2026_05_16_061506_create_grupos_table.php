<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('grupos', function (Blueprint $table) {

            $table->id('id_grupo');

            $table->string('nome_grupo');

            $table->foreignId('id_turma')
                ->constrained('turmas', 'id_turma')
                ->onDelete('cascade');

            $table->string('status_grupo')->default('ativo');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};