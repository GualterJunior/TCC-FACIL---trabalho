<?php

namespace Database\Seeders;

use App\Models\User;
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
<<<<<<< HEAD
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
=======
        $this->call([
            UserSeeder::class,
            TurmaSeeder::class,
            TemaSeeder::class,
            GrupoSeeder::class,
            EtapaSeeder::class,
            ProjetoSeeder::class,
            EntregaSeeder::class,
            SorteioSeeder::class,
            NotaSeeder::class,
>>>>>>> 89fa71c (correção de bugs)
        ]);
    }
}
