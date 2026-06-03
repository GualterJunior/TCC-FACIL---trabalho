<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('temas') && ! Schema::hasColumn('temas', 'data_conclusao')) {
            Schema::table('temas', function (Blueprint $table) {
                $table->date('data_conclusao')->nullable()->after('area');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('temas') && Schema::hasColumn('temas', 'data_conclusao')) {
            Schema::table('temas', function (Blueprint $table) {
                $table->dropColumn('data_conclusao');
            });
        }
    }
};
