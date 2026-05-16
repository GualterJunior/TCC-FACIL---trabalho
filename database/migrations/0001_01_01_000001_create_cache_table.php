<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

   
    public function up(): void
    {

        Schema::create('cache', function (Blueprint $table) {

            $table->id();

            $table->string('key')->unique();

            $table->longText('value');

            $table->enum('tipo_cache', [
                'usuarios',
                'turmas',
                'grupos',
                'temas',
                'entregas',
                'notas',
                'validacoes',
                'sistema'
            ])->default('sistema');

 
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');

     
            $table->enum('status_cache', [
                'ativo',
                'expirado',
                'removido'
            ])->default('ativo');

       
            $table->timestamp('expiration')->nullable();

    
            $table->timestamp('ultimo_acesso')
                ->nullable();

         
            $table->integer('total_acessos')
                ->default(0);

            $table->timestamps();
        });


        Schema::create('cache_locks', function (Blueprint $table) {

            $table->id();

            $table->string('key')->unique();

            $table->string('owner');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');

            $table->enum('tipo_lock', [
                'edicao',
                'upload',
                'validacao',
                'processamento'
            ])->default('processamento');

            $table->enum('status_lock', [
                'ativo',
                'liberado',
                'expirado'
            ])->default('ativo');

            $table->timestamp('expiration')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cache');

        Schema::dropIfExists('cache_locks');
    }
};