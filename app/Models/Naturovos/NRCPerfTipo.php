<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRCPerfTipo extends Model
{
    use HasFactory;

    protected $table = 'ncom_perftipo';

    protected $fillable = [
        'Atualizacao',
        'MateriaPrima',
        'Compra',
        'RepTotal',
        'PrecoMedio',
        'CompraEC',
        'RepTotalEC',
        'PrecoMedioEC'
    ];
}
