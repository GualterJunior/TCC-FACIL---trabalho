<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
        'status_usuario'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function turmas()
    {
        return $this->hasMany(Turma::class, 'id_professor');
    }

    public function grupos()
    {
        return $this->belongsToMany(
            Grupo::class,
            'grupo_integrantes',
            'id_usuario',
            'id_grupo'
        );
    }

    public function validacoes()
    {
        return $this->hasMany(Validacao::class, 'id_professor');
    }

    public function notas()
    {
        return $this->hasMany(Nota::class, 'id_professor');
    }
}