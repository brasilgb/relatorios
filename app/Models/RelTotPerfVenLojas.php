<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelTotPerfVenLojas extends Model
{
    use HasFactory;

    protected $table = "lfat_totperform";

    protected $fillable = [
        'Atualizacao',
        'MetaMes',
        'MediaFatuMes',
        'MargemMes',
        'RepFatuMes',
        'MetaAlcancadaMes',
        'MedJurSParcMes',
        'RepJurosMes',
        'FaturamentoAss',
        'MargemAss',
        'RepFatAss',
        'JurSFatAss',
        'RepJurosAss',
        'EstoqueAss',
        'GiroAss',
        'RepEstoqueAss'
    ];
}
