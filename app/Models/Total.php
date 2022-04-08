<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Total extends Model
{
    use HasFactory;
    protected $table = 'res_totais';

    protected $fillable = [
        'Atualizacao',
        'Departamento',
        'Meta',
        'Faturamento',
        'Projecao',
        'Margem',
        'PrecoMedio',
        'TicketMedio',
        'MetaAlcancada',
        'FaturamentoSemBrasil',
        'MargemSemBrasil',
        'PrecoMedioSemBrasil'
    ];
}
