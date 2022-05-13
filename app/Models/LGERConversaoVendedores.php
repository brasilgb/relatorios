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
        'CodigoFilial',
        'DescricaoFilial',
        'CodigoVendedorGE',
        'RotuloMelhorGE',
        'ValorMelhorGE',
        'CodigoVendedorPP',
        'RotuloMelhorPP',
        'ValorMelhorPP',
        'CodigoVendedorVenda',
        'RotuloMelhorVenda',
        'ValorMelhorVenda',
    ];
}
