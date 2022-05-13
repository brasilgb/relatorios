<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    use HasFactory;
    protected $table = 'res_filiais';

    protected $fillable = [
        'Atualizacao',
        'Departamento',
        'Filial',
        'Faturamento',
        'RepFaturamento',
        'Projecao',
        'Margem',
        'TicketMedio',
        'PrecoMedio',
        'MetaAlcancada'
    ];
}
