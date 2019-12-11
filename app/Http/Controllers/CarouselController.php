<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Http\Models\Carousel;
use App\Http\Models\Mensaje;

class CarouselController extends BaseController
{
    function GetAll(){
       /*  $mensajes = array("200" => "Todo correcto",
                    "404" => "No encontrado"); */

        // $directorio = opendir('/public/imagenes');
        echo Storage::get('public_images');
        $imagenes =  Storage::disk('public_images')->files();
        //$imagenes = readdir($directorio);
        var_dump($imagenes);
        // Si $imagenes no está vacio, retorna success. Si está vacio retornará error 404. DARLE UNA VUELTA
        if(empty($imagenes)){
             $respuesta = null;
        }  else{
            $respuesta = $imagenes;
        } 

        return $respuesta;
    }
    function Get($id){
        $respuesta = array(
            "mensaje" => "Imagen del carousel " . $id,
            "data" => Carousel::Where("id", $id)->get()
        );

        return $respuesta;
    }
}
