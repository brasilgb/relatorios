<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LSerResumoDia extends Model
{
    use HasFactory;
    
    protected $table = "lser_resumodia";

    protected $fillable = [
        'Atualizacao',
        'Supervisor',
        'GEDia',
        'PPDia',
        'GESemana',
        'PPSemana',
        'GEMes',
        'GEMesRep',
        'PPMes',
        'PPMesRep',
        'APMes',
        'APMesRep',
        'TotServicos',
        'TotRep'
    ];
}
