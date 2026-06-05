<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sorteios', function (Blueprint $table) {
            $table->foreignId('executado_por')->nullable()->after('status_sorteio')->constrained('users')->nullOnDelete();
            $table->timestamp('executado_em')->nullable()->after('executado_por');
            $table->text('resumo_sorteio')->nullable()->after('executado_em');
        });

        Schema::table('resultado_sorteio', function (Blueprint $table) {
            $table->string('criterio')->default('aleatorio')->after('id_tema');
            $table->unsignedTinyInteger('prioridade_atendida')->nullable()->after('criterio');
        });

        Schema::create('preferencias_tema', function (Blueprint $table) {
            $table->id('id_preferencia');
            $table->foreignId('id_grupo')->constrained('grupos', 'id_grupo')->onDelete('cascade');
            $table->foreignId('id_tema')->constrained('temas', 'id_tema')->onDelete('cascade');
            $table->unsignedTinyInteger('prioridade');
            $table->timestamps();

            $table->unique(['id_grupo', 'prioridade']);
            $table->unique(['id_grupo', 'id_tema']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preferencias_tema');

        Schema::table('resultado_sorteio', function (Blueprint $table) {
            $table->dropColumn(['criterio', 'prioridade_atendida']);
        });

        Schema::table('sorteios', function (Blueprint $table) {
            $table->dropForeign(['executado_por']);
            $table->dropColumn(['executado_por', 'executado_em', 'resumo_sorteio']);
        });
    }
};
