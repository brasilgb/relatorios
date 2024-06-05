<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppBgImages extends Model
{
    use HasFactory;
    protected $table = "appbgimages";
    protected $fillable = [
        'app',
        'bgimage'
    ];
}
