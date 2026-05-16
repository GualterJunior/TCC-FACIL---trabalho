<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Entrega;
use App\Models\User;

class Validacao extends Model
{
    use HasFactory;

    protected $table = 'validacoes';

    protected $primaryKey = 'id_validacao';

    protected $fillable = [
        'id_entrega',
        'id_professor',
        'status_validacao',
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