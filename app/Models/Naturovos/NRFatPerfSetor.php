<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRFatPerfSetor extends Model
{
    use HasFactory;

    protected $table = 'nfat_perfsetor';

    protected $fillable = [
        'Atualizacao',
        'Setor',
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
