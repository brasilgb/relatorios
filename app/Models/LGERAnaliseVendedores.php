<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERAnaliseVendedores extends Model
{
    use HasFactory;

    protected $table = "lger_analisevendedores";

    protected $fillable = [
        'Atualizacao',
        'Filial',
        'CodigoVendedor',
        'NomeVendedor',
        'ValorGE',
        'MetaGE',
        'PercentualGE',
        'ValorPP',
        'MetaPP',
        'PercentualPP',
        'ValorVenda',
        'MetaVenda',
        'PercentualVenda',
        'ValorJurosVendidos',
        'PercentJurosVendidos'  
    ];
}
