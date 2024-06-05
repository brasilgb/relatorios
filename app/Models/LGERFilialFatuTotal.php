<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERFilialFatuTotal extends Model
{
    use HasFactory;
	protected $table = 'lger_filialfatutotal';
	protected $fillable = [
    'Atualizacao',
    'FilialId',
    'Filial',
    'FatuDia',
    'MargemDia',
	'DiaAtual',
	'DiaAnterior',
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
