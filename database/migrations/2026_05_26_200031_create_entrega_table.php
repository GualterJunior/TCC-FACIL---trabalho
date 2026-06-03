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
        Schema::create('entrega', function (Blueprint $table) {
            $table->id('id_entrega');
            $table->foreignId('id_grupo')
                ->constrained('grupos', 'id_grupo')
                ->onDelete('cascade');
            $table->foreignId('id_etapa')
                ->constrained('etapas', 'id_etapa')
                ->onDelete('cascade');
            $table->string('nome_arquivo');
            $table->string('caminho_arquivo');
            $table->string('status_Entrega')->default('enviado');
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrega');
    }
};
