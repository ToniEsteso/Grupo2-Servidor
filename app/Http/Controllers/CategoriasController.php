<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Categorias;

class CategoriasController extends BaseController
{
    function GetAll(){
        return Categorias::get();
    }
    function Get($categoria){
        return Categorias::Where("tipo", $categoria)->get();
    }
}
