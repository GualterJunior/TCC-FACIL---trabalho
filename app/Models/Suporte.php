<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suporte extends Model
{
    use HasFactory;

    protected $table = 'suportes';

    protected $primaryKey = 'id_suporte';

    protected $fillable = [
        'id_usuario',
        'id_turma',
        'assunto',
        'mensagem',
        'status_suporte',
        'resposta',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'id_turma');
    }
}
