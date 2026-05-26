<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id('id_entrega'); // Isso define o nome da chave primária
            $table->unsignedBigInteger('id_grupo');
            $table->unsignedBigInteger('id_etapa');
            $table->string('nome_arquivo');
            $table->string('caminho_arquivo');
            $table->string('status_Entrega');
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};
