<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    use HasFactory;
    protected $table = 'res_exportacoes';

    protected $fillable = [
        'Atualizacao',
        'Departamento',
        'Pais',
        'Faturamento',
        'RepFaturamento',
        'Margem',
        'PrecoMedio'
    ];
}
