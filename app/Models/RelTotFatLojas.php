<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelTotFatLojas extends Model
{
    use HasFactory;

    protected $table = 'lfat_totcompara';

    protected $fillable = [
        'Atualizacao',
        'FatDia',
        'MargemDia',
        'FatuAnterior',
        'MargemAnterior',
        'FatuSemana',
        'MargemSemana',
        'FatuMes',
        'MargemMes',
        'RepFatu',
        'JurosSPM',
        'RepSemFatu',
        'MetaMes',
        'VendaMes',
        'FaltaVenderMes',
        'MetaParcMes',
        'AtingidoMes',
        'PerfAtualMes',
        'MetaDia',
        'VendaDia',
        'FaltaVenderDia',
        'PerfMetaDia',
        'JurSParcDia',
        'PerfJurDia',
        'MediaDia'
    ];
}
