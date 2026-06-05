<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sorteio extends Model
{
    use HasFactory;

    protected $table = 'sorteios';

    protected $primaryKey = 'id_sorteio';

    protected $fillable = [
        'id_turma',
        'data_sorteio',
        'status_sorteio',
        'executado_por',
        'executado_em',
        'resumo_sorteio'
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'id_turma');
    }

    public function resultados()
    {
        return $this->hasMany(ResultadoSorteio::class, 'id_sorteio');
    }

    public function executor()
    {
        return $this->belongsTo(User::class, 'executado_por');
    }
}
