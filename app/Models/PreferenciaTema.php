<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferenciaTema extends Model
{
    use HasFactory;

    protected $table = 'preferencias_tema';

    protected $primaryKey = 'id_preferencia';

    protected $fillable = [
        'id_grupo',
        'id_tema',
        'prioridade',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function tema()
    {
        return $this->belongsTo(Tema::class, 'id_tema');
    }
}
