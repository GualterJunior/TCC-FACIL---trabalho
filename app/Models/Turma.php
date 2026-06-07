<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;
    protected $table = 'turmas';
    protected $primaryKey = 'id_turma';
    protected $fillable = [
        'nome_turma',
        'codigo_turma',
        'semestre',
        'descricao',
        'status_turma',
        'id_professor',
    ];
    /**
     * Professor responsável
     */
    public function professor()
    {
        return $this->belongsTo(
            User::class,
            'id_professor',
            'id'
        );
    }
    /**
     * Grupos da turma
     */
    public function grupos()
    {
        return $this->hasMany(
            Grupo::class,
            'id_turma',
            'id_turma'
        );
    }
    /**
     * Temas da turma
     */
    public function temas()
    {
        return $this->hasMany(
            Tema::class,
            'id_turma',
            'id_turma'
        );
    }
    /**
     * Etapas da turma
     */
    public function etapas()
    {
        return $this->hasMany(
            Etapa::class,
            'id_turma',
            'id_turma'
        );
    }
    /**
     * Sorteios da turma
     */
    public function sorteios()
    {
        return $this->hasMany(
            Sorteio::class,
            'id_turma',
            'id_turma'
        );
    }
    /**
     * Último sorteio
     */
    public function ultimoSorteio()
    {
        return $this->hasOne(
            Sorteio::class,
            'id_turma',
            'id_turma'
        )->latestOfMany('id_sorteio');
    }
    /**
     * Usuários da turma através dos grupos
     */
    public function usuarios()
    {
        return $this->hasManyThrough(
            User::class,
            Grupo::class,
            'id_turma',   // FK em grupos
            'id',         // FK em users
            'id_turma',   // PK em turmas
            'id_grupo'    // PK em grupos
        );
    }
    /**
     * Verifica se usuário pertence à turma
     */
    public function possuiUsuario($userId): bool
    {
        return $this->grupos()
            ->whereHas(
                'usuarios',
                fn ($query) => $query->where(
                    'users.id',
                    $userId
                )
            )
            ->exists();
    }
    /**
     * Busca grupo do usuário na turma
     */
    public function grupoDoUsuario($userId)
    {
        return $this->grupos()
            ->whereHas(
                'usuarios',
                fn ($query) => $query->where(
                    'users.id',
                    $userId
                )
            )
            ->first();
    }
}
