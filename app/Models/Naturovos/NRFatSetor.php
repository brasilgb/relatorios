<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRFatSetor extends Model
{
    use HasFactory;

    protected $table = 'nfat_setor';

    protected $fillable = [
        'Atualizacao',
        'Setor',
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
