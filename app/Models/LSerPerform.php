<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LSerPerform extends Model
{
    use HasFactory;
    
    protected $table = "lser_perform";

    protected $fillable = [
        'Atualizacao',
        'PerfMesAno',
        'PerfValorGE',
        'PerfRepGE',
        'PerfMetaGE',
        'PerfValorPP',
        'PerfRepPP',
        'PerfMetaPP',
        'PerfValorAP',
        'PerfRepAP',
        'PerfMetaAP',
        'PerfValorEP',
        'PerfRepEP'
    ];
}
