<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelPerfMesVenLojas extends Model
{
    use HasFactory;

    protected $table = "lfat_perfmes";

    protected $fillable = [
        'Atualizacao',
        'MesAno',
        'Meta',
        'ColorMedia',
        'MediaFatu',
        'Margem',
        'RepFatu',
        'MetaAlcancada',
        'MedJurSParc',
        'RepJuros'
    ];
}
