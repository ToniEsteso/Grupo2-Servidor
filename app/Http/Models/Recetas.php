<?php

namespace App\Http\Models;

use Eloquent;

class Recetas extends Eloquent
{
    protected $table = 'recetas';
    protected $primarykey = 'id';
    protected $fillable = array('id', 'nombre', 'imagen', 'enlace');
}