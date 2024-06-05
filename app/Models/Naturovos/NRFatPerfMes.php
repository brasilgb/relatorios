<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRFatPerfMes extends Model
{
    use HasFactory;

    protected $table = 'nfat_perfmes';

    protected $fillable = [
        'Atualizacao',
        'AnoMesNum',
        'MesAno',
        'Faturamento',
        'Margem',
        'RepTotal',
        'PrecoMedioKg'
    ];
}
