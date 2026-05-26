<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Grupo;
use App\Models\Etapa;
use App\Models\Validacao;
use App\Models\Correcao;



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrega extends Model
{
    use HasFactory;

    protected $table = 'entregas';

    protected $primaryKey = 'id_entrega';

    // O Eloquent assume que a chave primária é um incremento inteiro. 
    // Se 'id_entrega' não for auto-increment, adicione: public $incrementing = true;
    
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
        // Certifique-se que na tabela 'validacoes' a coluna se chama 'id_Entrega'
        return $this->hasMany(Validacao::class, 'id_Entrega');
    }

    public function correcoes()
    {
        // Certifique-se que na tabela 'correcoes' a coluna se chama 'id_entrega'
        return $this->hasMany(Correcao::class, 'id_entrega');
    }
}