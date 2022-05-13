<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERInadimplencia extends Model
{
    use HasFactory;

    protected $table = "lger_inadimplencia";

    protected $fillable = [
        'Atualizacao',
        'CodFilial',
        'PercentInadimplencia'
    ];
}
