<?php

namespace App\Models\Supermercados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRComPerfMes extends Model
{
    use HasFactory;

    protected $table = 'scom_perfmes';

    protected $fillable = [
        'Atualizacao',
        'AnoMesNum',
        'MesAno',
        'MediaCompra',
        'Rep',
        'PrazoMedio'
    ];
}
