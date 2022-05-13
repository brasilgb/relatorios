<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERGiroSubGrupo extends Model
{
    use HasFactory;

    protected $table = "lger_girosubgrupo";

    protected $fillable = [
        'Atualizacao',
        'CodFilial',
        'Filial',
        'SubGrupo',
        'CodSubGrupo',
        'ValorEstoque',
        'ValorAtual',
        'GiroFilial',
        'GiroRede'
    ];
}
