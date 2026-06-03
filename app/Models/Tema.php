<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tema extends Model
{
    use HasFactory;

    protected $table = 'temas';

    protected $primaryKey = 'id_tema';

    protected $fillable = [
        'titulo',
            'descricao',
            'area',
            'data_conclusao',
            'status_tema',
            'id_turma'
        ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'id_turma');
    }
}
