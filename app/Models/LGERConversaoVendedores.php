<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERConversaoVendedores extends Model
{
    use HasFactory;
    
    protected $table = "lger_conversaovendedores";

    protected $fillable = [
        'Atualizacao',
        'CodFilial',
        'DescricaoFilial',
        'CodigoVendedorVenda',
        'RotuloMelhorVenda',
        'ValorMelhorVenda',
    ];
}
