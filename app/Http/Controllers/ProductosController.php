<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Models\Productos;

class ProductosController extends BaseController
{
    function GetAll(){
        return Productos::get();
    }
    function Get($producto){
        return Productos::Where("nombre", $producto)->get();
    }
}
