<?php

namespace App\Http\Models;

use Eloquent;

class Carousel extends Eloquent
{
    protected $table = 'imagenescarousel';
    protected $primaryKey = 'id';
    protected $fillable = array('id', 'extension');
}
