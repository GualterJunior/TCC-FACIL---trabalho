<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $table = 'grupos';
    protected $primaryKey = 'id_grupo';
    protected $fillable = [
        'nome_grupo',
        'id_turma',
        'status_grupo',
    ];
    /**
     * Grupo pertence à turma
     */
    public function turma()
    {
        return $this->belongsTo(
            Turma::class,
            'id_turma',
            'id_turma'
        );
    }

    /**
     * Integrantes do grupo
     */
    public function usuarios()
    {
        return $this->belongsToMany(
            User::class,
            'grupo_integrantes',
            'id_grupo',
            'id_usuario'
        )->withTimestamps();
    }

    /**
     * Entregas do grupo
     */
    public function entregas()
    {
        return $this->hasMany(
            Entrega::class,
            'id_grupo',
            'id_grupo'
        );
    }

    /**
     * Notas do grupo
     */
    public function notas()
    {
        return $this->hasMany(
            Nota::class,
            'id_grupo',
            'id_grupo'
        );
    }

    /**
     * Resultado do sorteio
     */
    public function resultadoSorteio()
    {
        return $this->hasOne(
            ResultadoSorteio::class,
            'id_grupo',
            'id_grupo'
        )->latestOfMany('id_resultado');
    }

    /**
     * Preferências de tema
     */
    public function preferenciasTema()
    {
        return $this->hasMany(
            PreferenciaTema::class,
            'id_grupo',
            'id_grupo'
        )->orderBy('prioridade');
    }

    /**
     * Progresso do grupo
     */
    public function progressos()
    {
        return $this->hasMany(
            ProgressoGrupo::class,
            'id_grupo',
            'id_grupo'
        );
    }

    /**
     * Quantidade integrantes
     */
    public function quantidadeIntegrantes(): int
    {
        return $this->usuarios()->count();
    }

    /**
     * Verifica se grupo está cheio
     */
    public function estaCheio(): bool
    {
        return $this->quantidadeIntegrantes() >= 3;
    }

    /**
     * Verifica se usuário pertence ao grupo
     */
    public function possuiUsuario($userId): bool
    {
        return $this->usuarios()

            ->where('users.id', $userId)

            ->exists();
    }

    /**
     * Adiciona usuário no grupo
     */
    public function adicionarUsuario($userId): bool
    {
        // evita duplicidade
        if ($this->possuiUsuario($userId)) {
            return false;
        }

        // impede grupo cheio
        if ($this->estaCheio()) {
            return false;
        }

        $this->usuarios()->attach($userId);

        return true;
    }

    /**
     * Remove usuário do grupo
     */
    public function removerUsuario($userId): bool
    {
        if (! $this->possuiUsuario($userId)) {
            return false;
        }

        $this->usuarios()->detach($userId);

        return true;
    }

    /**
     * Verifica se grupo pertence à turma
     */
    public function pertenceATurma($idTurma): bool
    {
        return (int) $this->id_turma === (int) $idTurma;
    }

    /**
     * Busca líder do grupo
     * (primeiro integrante)
     */
    public function lider()
    {
        return $this->usuarios()->first();
    }

    /**
     * Nome formatado
     */
    public function nomeCompleto(): string
    {
        return $this->nome_grupo
            . ' ('
            . $this->quantidadeIntegrantes()
            . '/3)';
    }
}
