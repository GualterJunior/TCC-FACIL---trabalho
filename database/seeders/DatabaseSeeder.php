<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TurmaSeeder::class,
            TemaSeeder::class,
            GrupoSeeder::class,
            PreferenciaTemaSeeder::class,
            EtapaSeeder::class,
            ProjetoSeeder::class,
            EntregaSeeder::class,
            SorteioSeeder::class,
            NotaSeeder::class,
        ]);
    }
}
