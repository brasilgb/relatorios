<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LAcredVencido extends Model
{
    use HasFactory;

    protected $table = "lacr_grafvencidos";

    protected $fillable = [
        'Atualizacao',
        'CodFilial',
        'Filial',
        'AnoMesNum',
        'MesAno',
        'ValorCredito',
        'RepVencer',
        'RepVencidos'
    ];
}
