<?php

namespace App\Http\Models;

use Eloquent;

class Categorias extends Eloquent
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable = array('id', 'nombre', 'icono', 'imagen');
    public $timestamps = false;
}
