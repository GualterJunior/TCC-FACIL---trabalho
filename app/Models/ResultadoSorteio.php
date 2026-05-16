<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResultadoSorteio extends Model
{
    use HasFactory;

    protected $table = 'resultado_sorteio';

    protected $primaryKey = 'id_resultado';

    protected $fillable = [
        'id_sorteio',
        'id_grupo',
        'id_tema'
    ];

    public function sorteio()
    {
        return $this->belongsTo(Sorteio::class, 'id_sorteio');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }
    
    public function tema()
    {
        return $this->belongsTo(Tema::class, 'id_tema');
    }
}