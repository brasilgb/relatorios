<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERFilialGrafico extends Model
{
    use HasFactory;
	protected $table = 'lger_filialgrafico';
	protected $fillable = [
	"Atualizacao",
    "FilialId",
    "Filial",
    "DiaSemana",
    "Venda",
    "Margem",
    "Meta"
	];
}
