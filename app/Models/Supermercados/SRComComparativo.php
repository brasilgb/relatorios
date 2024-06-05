<?php

namespace App\Models\Supermercados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRComComparativo extends Model
{
    use HasFactory;

    protected $table = 'scom_comparativo';

    protected $fillable = [
        'Atualizacao',
        'Associacao',
        'CompraDia',
        'CompraAnterior',
        'CompraSemana',
        'CompraMes',
        'RepMes',
        'RepAno',
        'PrazoMedio',
        'PrazoMedioColor',
        'RepMesAnoColor'
    ];
}