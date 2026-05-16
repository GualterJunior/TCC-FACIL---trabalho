<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
  
    protected static ?string $password;

    /**
     * Define os dados padrão do usuário.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'name' => fake()->name(),

            'email' => fake()->unique()->safeEmail(),

            'email_verified_at' => now(),

            'password' => static::$password ??= Hash::make('password'),
            
            'remember_token' => Str::random(10),

            'tipo' => fake()->randomElement([
                'aluno',
                'professor',
                'coordenador'
            ]),

            'status_usuario' => fake()->randomElement([
                'ativo',
                'inativo',
                'pendente'
            ]),

        ];
    }

 
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [

            'email_verified_at' => null,

        ]);
    }

    public function aluno(): static
    {
        return $this->state(fn (array $attributes) => [

            'tipo' => 'aluno',

        ]);
    }

    public function professor(): static
    {
        return $this->state(fn (array $attributes) => [

            'tipo' => 'professor',

        ]);
    }

    public function coordenador(): static
    {
        return $this->state(fn (array $attributes) => [

            'tipo' => 'coordenador',

        ]);
    }
}
