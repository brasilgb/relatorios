<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRResAssoc extends Model
{
    use HasFactory;

    protected $table = 'nres_associacao';

    protected $fillable = [
    'Atualizacao',
    'GrupoPai',
    'Associacao',
    'ValorMesAtual',
    'RepValorMesAnterior',
    'RepValorAnoAnterior',
    'QtdMesAtual',
    'RepQtdMesAnterior',
    'RepQtdAnoAnterior',
    'PrecMedioMesAtual',
    'RepPrecMedioMesAnterior',
    'RepPrecMedioAnoAnterior',
    'RepMargemAtual'
    ];
}
