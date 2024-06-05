<?php

namespace App\Models\Supermercados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRFatPerfMes extends Model
{
    use HasFactory;

    protected $table = 'sfat_perfmes';

    protected $fillable = [
        'Atualizacao',
        'AnoMesNum',
        'MesAno',
        'MediaFat',
        'Margem',
        'Rep',
        'Meta'
    ];
}
