<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRFatPerfGrupo extends Model
{
    use HasFactory;

    protected $table = 'nfat_perfgrupo';

    protected $fillable = [
        'Atualizacao',
        'Setor',
        'Grupo',
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
