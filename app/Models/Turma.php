<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'id_professor'
    ];

    public function professor()
    {
        return $this->belongsTo(User::class, 'id_professor');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'id_turma');
    }

    public function temas()
    {
        return $this->hasMany(Tema::class, 'id_turma');
    }

    public function etapas()
    {
        return $this->hasMany(Etapa::class, 'id_turma');
    }

    public function sorteios()
    {
        return $this->hasMany(Sorteio::class, 'id_turma');
    }

    public function ultimoSorteio()
    {
        return $this->hasOne(Sorteio::class, 'id_turma')->latestOfMany('id_sorteio');
    }
}
