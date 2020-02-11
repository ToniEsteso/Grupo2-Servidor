<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Http\Models\Recetas;

class RecetasController extends BaseController
{
    function GetAll(){
        $recetas = Recetas::get();

        if(empty($recetas)){
            $respuesta =  config('codigosRespuesta.404');
       }  else{
           $respuesta =  ["mensaje" => config('codigosRespuesta.200'),"rutaImagenesServer" => str_replace("\\", "/", explode("public",Storage::disk('public_images_recetas')->getDriver()->getAdapter()->getPathPrefix())[1]), "data" => $recetas];
       }

       return $respuesta;
    }

    public function numeroRecetas()
    {
        $numRecetas = Recetas::count();
        $respuesta = [
            "mensaje" => config('codigosRespuesta.200'),
            "data" => $numRecetas];

            return $respuesta;
    }



    public function anyadirReceta()
    {
        $credentials = request(['nombre', 'enlace', 'imagen']);
        echo "credentials";
        var_dump($credentials);
        echo "anyadirProducto";
        foreach ($credentials as $key => $value) {
            $key = strip_tags($key);
        }

        //insertar el usuario
        $receta = new Recetas();
        echo "receta";
        var_dump($receta);
        echo "receta";
        $receta->nombre = $credentials["nombre"];
        $receta->enlace = $credentials["enlace"];

        $nombreImagen = $this->subirImagen($credentials["nombre"]);
        $receta->imagen = $nombreImagen;

        if ($nombreImagen != null) {
            $receta->save();
            return response()->json(['receta' => $receta]);
        } else {
            return response()->json(['mensaje' => "Vas a engañar a otro"]);
        }
    }

    public function subirImagen($nick)
    {
        $dir_subida = public_path() . str_replace("\\", "/", explode("public", Storage::disk('public_images_recetas')->getDriver()->getAdapter()->getPathPrefix())[1]);
        // $dir_subida = '/var/www/html/public/'.str_replace("\\", "/", explode("public",Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]);

        $tipos = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/PNG', 'image/JPEG', 'image/JPG');

        if (in_array($_FILES['imagen']['type'], $tipos)) {
            $fichero_subido = $dir_subida . $nick . "." . explode("/", $_FILES['imagen']['type'])[1];
            var_dump($fichero_subido);
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)) {
                return $nick . "." . explode("/", $_FILES['imagen']['type'])[1];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function BorrarReceta($idReceta){
        $rutaImagenes = Storage::disk('public_images_recetas')->getDriver()->getAdapter()->getPathPrefix();
        $receta = Recetas::find($idReceta);

        $mi_imagen = $rutaImagenes . $receta->imagen;

        if (@getimagesize($mi_imagen)) {
            echo "El archivo existe";
            unlink($mi_imagen);
        }
        else
        {
            echo "El archivo no existe";
        }
        $receta->delete();

        $respuesta = array("mensaje" => config('codigosRespuesta.200'), "data" => "Borrada exitosamente.");
        return $respuesta;
    }
}
