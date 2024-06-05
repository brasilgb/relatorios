<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRFatAssoc extends Model
{
    use HasFactory;
    
    protected $table = 'nfat_associacao';

    protected $fillable = [
        'Atualizacao',
        'Grupo',
        'Associacao',
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
