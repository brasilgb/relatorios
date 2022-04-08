<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LAcredVencidoTotal extends Model
{
    use HasFactory;

    protected $table = "lacr_grafvencidostotal";

    protected $fillable = [
        'Atualizacao',
        'AnoMesNum',
        'MesAno',
        'ValorCredito',
        'RepVencer',
        'RepVencidos'
    ];
}
