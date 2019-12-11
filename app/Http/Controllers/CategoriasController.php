<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Categorias;
use App\Http\Models\Productos;

class CategoriasController extends BaseController
{
    function GetAll(){
        $respuesta = array(
            "mensaje" => "Todas las categorias",
            "data" => Categorias::get()
        );

        return $respuesta;
    }
    function Get($categoria){
        $respuesta = array(
            "mensaje" => "Todas las categorias",
            "data" => Categorias::Where("nombre", $categoria)->get()
        );

        return $respuesta;
    }
    function ProductosPorCategoria($categoria){
        $respuesta = array(
            "mensaje" => "Todas los productos de la categoria " . $categoria,
            "data" => DB::table('productos')
                ->join('productos_categorias', 'productos.id', '=', 'productos_categorias.idProducto')
                ->join('categorias', 'categorias.id', '=', 'productos_categorias.idCategoria')
                ->where('categorias.nombre', $categoria)
                ->select('productos.*')->get()
        );

        return $respuesta;
    }
}
