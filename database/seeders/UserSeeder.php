<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Coordenadores
        User::create([
            'name' => 'Maria Coordenadora',
            'email' => 'maria@tcc-facil.com',
            'password' => Hash::make('password'),
            'tipo' => 'coordenador',
        ]);

        User::create([
            'name' => 'João Coordenador',
            'email' => 'joao.coord@tcc-facil.com',
            'password' => Hash::make('password'),
            'tipo' => 'coordenador',
        ]);

        // Professores
        User::create([
            'name' => 'Prof. Ana Silva',
            'email' => 'ana.silva@tcc-facil.com',
            'password' => Hash::make('password'),
            'tipo' => 'professor',
        ]);

        User::create([
            'name' => 'Prof. Carlos Oliveira',
            'email' => 'carlos.oliveira@tcc-facil.com',
            'password' => Hash::make('password'),
            'tipo' => 'professor',
        ]);

        User::create([
            'name' => 'Prof. Sandra Costa',
            'email' => 'sandra.costa@tcc-facil.com',
            'password' => Hash::make('password'),
            'tipo' => 'professor',
        ]);

        // Alunos
        for ($i = 1; $i <= 12; $i++) {
            User::create([
                'name' => "Aluno $i da Silva",
                'email' => "aluno$i@student.com",
                'password' => Hash::make('password'),
                'tipo' => 'aluno',
            ]);
        }
    }
}
