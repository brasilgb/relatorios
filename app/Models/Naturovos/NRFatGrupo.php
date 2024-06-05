<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRFatGrupo extends Model
{
    use HasFactory;

    protected $table = 'nfat_grupo';

    protected $fillable = [
        'Atualizacao',
        'Setor',
        'Grupo',
        'VendaDia',
        'MargemDia',
        'VendaSemana',
        'MargemSemana',
        'VendaMes',
        'MargemMes',
        'RepTotal',
        'RepAno',
        'PrecoMedio',
        'RepPrecoMedio',
        'PrecoMedioKg',
        'RepPrecoMedioKg'
    ];
}
