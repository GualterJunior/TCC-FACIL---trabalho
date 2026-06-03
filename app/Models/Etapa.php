<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etapa extends Model
{
    use HasFactory;

    protected $table = 'etapas';

    protected $primaryKey = 'id_etapa';

    protected $fillable = [
        'nome_etapa',
        'descricao',
        'prazo_entrega',
        'ordem_etapa',
        'id_turma'
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'id_turma');
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class, 'id_etapa');
    }
}