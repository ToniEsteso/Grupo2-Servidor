<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Http\Models\Carousel;

class CarouselController extends BaseController
{
    
    function GetAll(){
        $imagenesServidor =  Storage::disk('public_images')->files();
        // Si $imagenesServidor no está vacio, retorna success. Si está vacio retornará error 404.
        if(empty($imagenesServidor)){
             $respuesta =  config('codigosRespuesta.404');
        }  else{
            $respuesta =  ["mensaje" => config('codigosRespuesta.200'),"rutaServer" => str_replace("\\", "/", explode("public", public_path('imagenes'))[1]), "imagenes" => $imagenesServidor];
        }

        return $respuesta;
    }
    function GetImagenesPromocion(){
        $imagenesServidor =  Storage::disk('public_images')->files();
        $imagenesBDarray = [];
        if(empty($imagenesServidor)){
             $respuesta =  config('codigosRespuesta.404');
        }  else{
            $imagenesBD = Carousel::get();
            foreach ($imagenesBD as $key) {
                array_push($imagenesBDarray, $key->nombre . "." . $key->extension);
            }
            $imagenesPromocion = array_intersect($imagenesServidor, $imagenesBDarray);
            $respuesta =  ["mensaje" => config('codigosRespuesta.200'),"rutaServer" => str_replace("\\", "/", explode("public", public_path('imagenes'))[1]), "imagenes" => $imagenesPromocion];
        }

        return $respuesta;
    }
}
