<?php

namespace App\Http\Controllers;

use App\Http\Models\Productos;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class ProductosController extends BaseController
{
    public function GetAll()
    {
        $productos = Productos::get();

        if (empty($productos)) {
            $respuesta = config('codigosRespuesta.404');
        } else {
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "rutaImagenesServer" => str_replace("\\", "/", explode("public", Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]), "data" => $productos];
        }

        return $respuesta;
    }

    public function Get($producto)
    {
        $producto = Productos::Where("nombre", $producto)->get();

        if (empty($producto)) {
            $respuesta = config('codigosRespuesta.404');
        } else {
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "rutaImagenesServer" => str_replace("\\", "/", explode("public", Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]), "data" => $producto];
        }

        return $respuesta;
    }

    public function GetBarra($producto)
    {
        $producto = Productos::Where("nombre", 'like', '%' . $producto . '%')->get();

        if (empty($producto)) {
            $respuesta = config('codigosRespuesta.404');
        } else {
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "rutaImagenesServer" => str_replace("\\", "/", explode("public", Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]), "data" => $producto];
        }

        return $respuesta;
    }

    public function anyadirProducto()
    {
        $credentials = request(['nombre', 'precio', 'descripcion', 'imagen']);
        foreach ($credentials as $key => $value) {
            $key = strip_tags($key);
        }

        //insertar el usuario
        $producto = new Productos();
        $producto->nombre = $credentials["nombre"];
        $producto->precio = $credentials["precio"];
        $producto->descripcion = $credentials["descripcion"];

        $nombreImagen = $this->subirImagen($credentials["imagen"]);
        $producto->imagen = $nombreImagen;

        if ($nombreImagen != null) {
            $usuario->save();
            return response()->json(['usuario' => $usuario]);
        } else {
            return response()->json(['mensaje' => "Vas a engañar a otro"]);
        }
    }

    public function subirImagen($nick)
    {
        $dir_subida = public_path() . str_replace("\\", "/", explode("public", Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]);
        // $dir_subida = '/var/www/html/public/'.str_replace("\\", "/", explode("public",Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]);

        $tipos = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/PNG', 'image/JPEG', 'image/JPG');

        if (in_array($_FILES['imagen']['type'], $tipos)) {
            $fichero_subido = $dir_subida . $nick . "." . explode("/", $_FILES['imagen']['type'])[1];
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)) {
                return $nick . "." . explode("/", $_FILES['imagen']['type'])[1];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
