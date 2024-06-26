<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    use HasFactory;

    protected $table = "usuarios_acessos";
    
    protected $fillable = [
        'IdUsuario',
	    'IdFilial',
        'Name',
        'Filial'
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'IdUsuario', 'IdUsuario');
    }
}
