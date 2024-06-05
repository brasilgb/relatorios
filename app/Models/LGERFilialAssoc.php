<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERFilialAssoc extends Model
{
    use HasFactory;
	protected $table = 'lger_filialassoc';
	protected $fillable = [
	    "Atualizacao",
		"FilialId",
		"Filial",
		"Assoc",
		"Faturamento",
		"Margem",
		"RepFat",
		"JurSFat",
		"RepJuros",
		"Estoque",
		"Giro",
		"RepEstoque"
	];
}
