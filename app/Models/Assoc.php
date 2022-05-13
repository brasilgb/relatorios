<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assoc extends Model
{
    use HasFactory;
    protected $table = 'res_associacoes';

    protected $fillable = [
        'Atualizacao',
        'Departamento',
        'Associacao',
        'Faturamento',
        'RepFaturamento',
        'Projecao',
        'Margem',
        'PrecoMedio',
        'TicketMedio',
        'MetaAlcancada'
    ];
}
