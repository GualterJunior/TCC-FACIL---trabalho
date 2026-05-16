<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgressoGrupo extends Model
{
    use HasFactory;

    protected $table = 'progresso_grupo';

    protected $primaryKey = 'id_progresso';

    protected $fillable = [
        'id_grupo',
        'id_etapa',
        'status_progresso',
        'percentual',
        'observacao'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function etapa()
    {
        return $this->belongsTo(Etapa::class, 'id_etapa');
    }
}