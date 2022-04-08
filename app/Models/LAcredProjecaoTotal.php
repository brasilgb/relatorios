<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LAcredProjecaoTotal extends Model
{
    use HasFactory;

    protected $table = "lacr_grafprojecaototal";

    protected $fillable = [
        'Atualizacao',
        'AnoMesNum',
        'MesAno',
        'RepVencidos',
        'ProjVencidos'
    ];
}
