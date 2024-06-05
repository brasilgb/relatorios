<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRResGrupo extends Model
{
    use HasFactory;

    protected $table = 'nres_grupo';

    protected $fillable = [
        'Atualizacao',
        'Grupo',
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
