<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRCTipo extends Model
{
    use HasFactory;

    protected $table = 'ncom_tipo';

    protected $fillable = [
        'Atualizacao',
        'MateriaPrima',
        'CompraDia',
        'CompraSemana',
        'CompraMes',
        'RepTotal',
        'RepAno',
        'PrecoMedio',
        'RepPrecoMedio'
    ];
}
