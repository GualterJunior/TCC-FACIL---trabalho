<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nota extends Model
{
    use HasFactory;

    protected $table = 'notas';

    protected $primaryKey = 'id_nota';

    protected $fillable = [
        'id_grupo',
        'id_professor',
        'nota',
        'comentario'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function professor()
    {
        return $this->belongsTo(User::class, 'id_professor');
    }
}