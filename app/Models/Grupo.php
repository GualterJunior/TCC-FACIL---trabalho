<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';

    protected $primaryKey = 'id_grupo';

    protected $fillable = [
        'nome_grupo',
        'id_turma',
        'status_grupo'
    ];

    // GRUPO PERTENCE A UMA TURMA
    public function turma()
    {
        return $this->belongsTo(Turma::class, 'id_turma');
    }

    // GRUPO POSSUI MUITOS USUÁRIOS
    public function usuarios()
    {
        return $this->belongsToMany(
            User::class,
            'grupo_integrantes',
            'id_grupo',
            'id_usuario'
        );
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class, 'id_grupo');
    }

    public function notas()
    {
        return $this->hasMany(Nota::class, 'id_grupo');
    }
}