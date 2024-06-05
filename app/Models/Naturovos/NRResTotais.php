<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRResTotais extends Model
{
    use HasFactory;

    protected $table = 'nres_totais';

    protected $fillable = [
        'Atualizacao',
        'ValorMesAtual',
        'RotValorMesAtual',
        'ValRepValorMesAnterior',
        'RotRepValorMesAnterior',
        'ValRepValorAnoAnterior',
        'RotRepValorAnoAnterior',
        'ValQtdMesAtual',
        'RotQtdMesAtual',
        'ValRepQtdMesAnterior',
        'RotRepQtdMesAnterior',
        'ValRepQtdAnoAnterior',
        'RotRepQtdAnoAnterior',
        'RotPrecMedioMesAtual',
        'RotRepPrecMedioMesAnterior',
        'RotPrecMedioAnoAnterior',
        'ValMargemAtual',
        'RotMargemAtual',
        'ProjecaoFaturamento',
        'TituloProjecao',
        'DifMesAntAtual',
        'TituloDif',
        'TituloGrafico',
        'RotuloGrafMesAnoAtual',
        'RotuloGrafMesAnterAnoAtual',
        'RotuloGrafAnoAnter'
    ];
}
