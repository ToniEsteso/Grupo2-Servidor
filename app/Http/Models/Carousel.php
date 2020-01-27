<?php

namespace App\Http\Models;

use Eloquent;

class Carousel extends Eloquent
{
    protected $table = 'imagenescarouselpromocion';
    protected $primaryKey = 'id';
    protected $fillable = array('id', 'nombre', 'extension');
    public $timestamps = false;
}
