<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRFatPerfAssoc extends Model
{
    use HasFactory;

    protected $table = 'nfat_perfassociacao';

    protected $fillable = [
        'Atualizacao',
        'Grupo',
        'Associacao',
        'Faturamento',
        'Margem',
        'RepTotal',
        'PrecoMedio',
        'PrecoMedioKg',
        'FaturamentoEC',
        'RepEC',
        'MargemEC'
    ];
}
