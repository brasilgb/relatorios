<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LComTotais extends Model
{
    use HasFactory;
    
    protected $table = "lcom_totais";

    protected $fillable = [
        'Atualizacao',
        'DiaAtual',
        'DiaAnterior',
        'CompraDia',
        'CompraAnterior',
        'CompraSemana',
        'CompraMes',
        'Rep',
        'PrazoMedio',
        'MediaCompraMes',
        'RepMes',
        'PrazoMedioMes',
        'ComprasAssoc',
        'RepAssoc',
        'PrazoMedioAssoc'
    ];
}
