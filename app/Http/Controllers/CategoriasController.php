<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Models\Categorias;
use App\Http\Models\Productos;

class CategoriasController extends BaseController
{
    function GetAll(){
        $categorias = Categorias::get();

        if(empty($categorias)){
            $respuesta =  config('codigosRespuesta.404');
        } else{
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "data" => $categorias];
        }

        return $respuesta;
    }

    function Get($categoria){
        $cat = Categorias::Where("nombre", $categoria)->get();

        if(empty($cat)){
            $respuesta =  config('codigosRespuesta.404');
        } else{
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "data" => $cat];
        }

        return $respuesta;
    }
    function ProductosPorCategoria($categoria){
        $productos = DB::table('productos')
        ->join('productos_categorias', 'productos.id', '=', 'productos_categorias.idProducto')
        ->join('categorias', 'categorias.id', '=', 'productos_categorias.idCategoria')
        ->where('categorias.nombre', $categoria)
        ->select('productos.*')->get();
        
        if(empty($productos)){
            $respuesta =  config('codigosRespuesta.404');
        } else{
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "rutaServerImagenes" => str_replace("\\", "/", explode("public",Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]),"data" => $productos];
        }

        return $respuesta;
    }
}
