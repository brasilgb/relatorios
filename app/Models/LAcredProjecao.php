<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LAcredProjecao extends Model
{
    use HasFactory;

    protected $table = "lacr_grafprojecao";

    protected $fillable = [
        'Atualizacao',
        'CodFilial',
        'Filial',
        'AnoMesNum',
        'MesAno',
        'RepVencidos',
        'ProjVencidos'
    ];
}
