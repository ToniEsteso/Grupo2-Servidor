<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Http\Models\Productos;

class ProductosController extends BaseController
{
    function GetAll(){
        $productos = Productos::get();

        if(empty($productos)){
             $respuesta =  config('codigosRespuesta.404');
        }  else{
            $respuesta =  ["mensaje" => config('codigosRespuesta.200'),"rutaImagenesServer" => str_replace("\\", "/", explode("public",Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]), "data" => $productos];
        }

        return $respuesta;
    }

    function Get($producto){
        $producto = Productos::Where("nombre", $producto)->get();

        if(empty($producto)){
            $respuesta =  config('codigosRespuesta.404');
        } else{
            $respuesta =  ["mensaje" => config('codigosRespuesta.200'),"rutaImagenesServer" => str_replace("\\", "/", explode("public",Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]), "data" => $producto];
        }

        return $respuesta;
    }
}
