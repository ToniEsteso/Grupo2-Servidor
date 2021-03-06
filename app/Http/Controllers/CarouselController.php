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
        $imagenesServidor =  Storage::disk('public_images_carousel')->files();
        // Si $imagenesServidor no está vacio, retorna success. Si está vacio retornará error 404.
        if(empty($imagenesServidor)){
             $respuesta =  config('codigosRespuesta.404');
        }  else{
            $respuesta =  ["mensaje" => config('codigosRespuesta.200'),"rutaServerImagenes" => str_replace("\\", "/", explode("public",Storage::disk('public_images_carousel')->getDriver()->getAdapter()->getPathPrefix())[1]), "imagenes" => $imagenesServidor];
        }

        return $respuesta;
    }
    function GetImagenesPromocion(){
        $imagenesServidor =  Storage::disk('public_images_carousel')->files();
        $imagenesBDarray = [];
        $imagenesPromocion = array();
        if(empty($imagenesServidor)){
             $respuesta =  config('codigosRespuesta.404');
        }  else{
            if(config("carousel.aleatoriedad")){
                for ($i=0; $i < config("carousel.numeroFotos");) {
                        $random = rand(0, count($imagenesServidor) - 1);
                        if(!in_array($imagenesServidor[$random], $imagenesPromocion)){
                            array_push($imagenesPromocion, $imagenesServidor[$random]);
                            $i++;
                        }
                }
            } else{
                $imagenesBD = Carousel::get();
                foreach ($imagenesBD as $key) {
                    array_push($imagenesBDarray, $key->nombre . "." . $key->extension);
                }
                $imagenesPromocion = array_values(array_intersect($imagenesServidor, $imagenesBDarray));
            }
            $respuesta =  ["mensaje" => config('codigosRespuesta.200'),"rutaServerImagenes" => str_replace("\\", "/", explode("public",Storage::disk('public_images_carousel')->getDriver()->getAdapter()->getPathPrefix())[1]), "imagenes" => $imagenesPromocion];
        }

        return $respuesta;
    }
}
