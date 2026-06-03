<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Grupo;
use App\Models\Etapa;
use App\Models\Validacao;
use App\Models\Correcao;

class Entrega extends Model
{
    use HasFactory;

    protected $table = 'entrega';

    protected $primaryKey = 'id_entrega';

    protected $fillable = [
        'id_grupo',
        'id_etapa',
        'nome_arquivo',
        'caminho_arquivo',
        'status_Entrega',
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

    public function validacoes()
    {
<<<<<<< HEAD
        return $this->hasMany(Validacao::class, 'id_Entrega');
=======
        return $this->hasMany(Validacao::class, 'id_entrega');
>>>>>>> 89fa71c (correção de bugs)
    }

    public function correcoes()
    {
        return $this->hasMany(Correcao::class, 'id_entrega');
    }
}