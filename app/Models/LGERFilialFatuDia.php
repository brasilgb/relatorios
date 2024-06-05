<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERFilialFatuDia extends Model
{
    use HasFactory;
	protected $table = 'lger_filialfatudia';
    protected $fillable = [
	'Atualizacao',
	'FilialId',
	'Filial',
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
	'RepSemFatu'
	];
}
