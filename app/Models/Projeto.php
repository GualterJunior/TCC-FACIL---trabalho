<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $table = 'projetos';

    protected $primaryKey = 'id_projeto';

    protected $fillable = [
        'titulo',
        'descricao',
        'autor',
        'status',
        'banner_path',
        'pdf_path',
    ];
}
