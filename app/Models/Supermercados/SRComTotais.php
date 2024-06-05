<?php

namespace App\Models\Supermercados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRComTotais extends Model
{
    use HasFactory;

    protected $table = 'scom_totais';

    protected $fillable = [
        'Atualizacao',
        'DiaAtual',
        'DiaAnterior',
        'CompraDia',
        'CompraAnterior',
        'CompraSemana',
        'CompraMes',
        'RepMes',
        'PrazoMedio',
        'MediaCompraPerfMes',
        'RepPerfMes',
        'PrazoMedioPerfMes',
        'ComprasPerfAssoc',
        'RepPerfAssoc',
        'PrazoMedioPerfAssoc'
    ];
}
