<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entrega;
use App\Models\User;

class Correcao extends Model
{
    use HasFactory;

    protected $table = 'correcoes';

    protected $primaryKey = 'id_correcao';

    protected $fillable = [
        'id_entrega',
        'id_professor',
        'status_correcao',
        'comentario'
    ];

    public function entrega()
    {
        return $this->belongsTo(Entrega::class, 'id_entrega');
    }

    public function professor()
    {
        return $this->belongsTo(User::class, 'id_professor');
    }
}