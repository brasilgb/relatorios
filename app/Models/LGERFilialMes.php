<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERFilialMes extends Model
{
    use HasFactory;
	protected $table = 'lger_filialmes';
	protected $fillable = [
	    "Atualizacao",
		"AnoMesNum",
		"MesAno",
		"FilialId",
		"Filial",
		"Meta",
		"MediaFatu",
		"Margem",
		"RepFatu",
		"MetaAlcancada",
		"MedJurSParc",
		"RepJuros"
	];
}
