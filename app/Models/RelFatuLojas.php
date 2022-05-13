<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelFatuLojas extends Model
{
    use HasFactory;

    protected $table = 'lfat_comparadia';

    protected $fillable = [
        'Atualizacao',
        'Associacao',
        'FatuDia',
        'MargemDia',
        'FatuAnterior',
        'MargemAnterior',
        'FatuSemana',
        'MargemSemana',
        'FatuMes',
        'MargemMes',
        'CompDia',
        'CompMes',
        'RepFatu',
        'JurosSPM',
        'RepSemFatu',
    ];
}
