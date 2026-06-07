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
        'status_usuario',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /**
     * Turmas do professor
     */
    public function turmas()
    {
        return $this->hasMany(
            Turma::class,
            'id_professor',
            'id'
        );
    }
    /**
     * Grupos do usuário
     */
    public function grupos()
    {
        return $this->belongsToMany(
            Grupo::class,
            'grupo_integrantes',
            'id_usuario',
            'id_grupo'
        )->withTimestamps();
    }
    /**
     * Validações realizadas
     */
    public function validacoes()
    {
        return $this->hasMany(
            Validacao::class,
            'id_professor',
            'id'
        );
    }
    /**
     * Notas atribuídas
     */
    public function notas()
    {
        return $this->hasMany(
            Nota::class,
            'id_professor',
            'id'
        );
    }

    /**
     * Verifica se usuário é aluno
     */
    public function isAluno(): bool
    {
        return strtolower(
            trim((string) $this->tipo)
        ) === 'aluno';
    }
    /**
     * Verifica se usuário é professor
     */
    public function isProfessor(): bool
    {
        return strtolower(
            trim((string) $this->tipo)
        ) === 'professor';
    }
    /**
     * Verifica se usuário é coordenador
     */
    public function isCoordenador(): bool
    {
        return strtolower(
            trim((string) $this->tipo)
        ) === 'coordenador';
    }
    /**
     * Verifica se usuário é staff
     */
    public function isStaff(): bool
    {
        return in_array(
            strtolower(trim((string) $this->tipo)),
            ['professor', 'coordenador'],
            true
        );
    }
    /**
     * Busca grupo da turma
     */
    public function grupoDaTurma($idTurma)
    {
        return $this->grupos()

            ->where(
                'grupos.id_turma',
                $idTurma
            )

            ->first();
    }
    /**
     * Verifica se participa da turma
     */
    public function participaDaTurma($idTurma): bool
    {
        return $this->grupos()

            ->where(
                'grupos.id_turma',
                $idTurma
            )

            ->exists();
    }
    /**
     * Verifica se já está em grupo
     */
    public function possuiGrupoNaTurma($idTurma): bool
    {
        return $this->participaDaTurma(
            $idTurma
        );
    }
}
