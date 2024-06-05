<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRCPerfMes extends Model
{
    use HasFactory;

    protected $table = 'ncom_perfmes';

    protected $fillable = [
        'Atualizacao',
        'AnoMesNum',
        'MesAno',
        'Media',
        'ColorMedia',
        'RepTotal'
    ];
}
