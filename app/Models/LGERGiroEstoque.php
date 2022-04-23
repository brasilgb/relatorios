<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERGiroEstoque extends Model
{
    use HasFactory;

    protected $table = "lger_giroestoque";

    protected $fillable = [
        'Atualizacao',
        'GiroAno',
        'CodFilial',
        'Filial',
        'GiroEstoqueLoja',
        'GiroEstoqueRede'
    ];
}
