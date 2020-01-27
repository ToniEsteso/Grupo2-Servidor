<?php

namespace App\Http\Models;

use Eloquent;

class RedesSociales extends Eloquent
{
    protected $table = 'redessociales';
    protected $primaryKey = 'id';
    protected $fillable = array('id', 'nombre', 'enlace', 'icono');
    public $timestamps = false;
}
