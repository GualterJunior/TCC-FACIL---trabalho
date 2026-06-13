<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Coordenador TCC Facil', 'email' => 'coordenador@tccfacil.com', 'tipo' => 'coordenador'],
            ['name' => 'Maria Coordenadora', 'email' => 'maria@tcc-facil.com', 'tipo' => 'coordenador'],
            ['name' => 'Joao Coordenador', 'email' => 'joao.coord@tcc-facil.com', 'tipo' => 'coordenador'],
            ['name' => 'Prof. Ana Silva', 'email' => 'ana.silva@tcc-facil.com', 'tipo' => 'professor'],
            ['name' => 'Prof. Carlos Oliveira', 'email' => 'carlos.oliveira@tcc-facil.com', 'tipo' => 'professor'],
            ['name' => 'Prof. Sandra Costa', 'email' => 'sandra.costa@tcc-facil.com', 'tipo' => 'professor'],
        ];

        for ($i = 1; $i <= 12; $i++) {
            $users[] = [
                'name' => "Aluno $i da Silva",
                'email' => "aluno$i@student.com",
                'tipo' => 'aluno',
            ];
        }

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('password'),
                    'tipo' => $user['tipo'],
                ]
            );
        }
    }
}
