<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TVFaturamento extends Model
{
    use HasFactory;

    protected $table = "ltv_faturamento";

    protected $fillable = [
        'Atualizacao',
        'Dia',
        'Mes',
        'Ano',
        'MetaDia',
        'MetaAlcancadaDia',
        'VendaDia',
        'PerformanceDia',
        'DiferencaDia',
        'MetaMes',
        'VendaAlcancadaMes',
        'MetaAlcancadaMes',
        'VendaMes',
        'PerformanceMes',
        'MetaAcumuladaMes',
        'DiferencaMes',
        'MetaAcumuladaAno',
        'VendaAlcancadaAno',
        'VendaAno',
        'PerformanceAno',
        'DiferencaAno'
    ];
}
