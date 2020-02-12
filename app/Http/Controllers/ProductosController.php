<?php

namespace App\Http\Controllers;

use App\Http\Models\Productos;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
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

        $nombreImagen = $this->subirImagen($credentials["nombre"]);
        $producto->imagen = $nombreImagen;

        if ($nombreImagen != null) {
            $producto->save();
            return response()->json(['producto' => $producto]);
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

    public function numeroProductos()
    {
        $numProductos = Productos::count();
        $respuesta = [
            "mensaje" => config('codigosRespuesta.200'),
            "data" => $numProductos];

        return $respuesta;
    }

    public function productosMasComprados()
    {
        $productosMasComprados = DB::table('productos_carrito')
            ->join('productos', 'productos_carrito.idProducto', '=', 'productos.id')
            ->join('carritos', 'productos_carrito.idCarrito', "=", "carritos.idCarrito")
            ->select(['productos.*', DB::raw('SUM(productos_carrito.cantidad) as numVendidos')])
            ->where("carritos.estado", "comprado")
            ->groupBy('productos.nombre')
            ->orderBy('numVendidos', 'desc')
            ->limit(3)
            ->get();

        $respuesta = [
            "mensaje" => config('codigosRespuesta.200'),
            "data" => $productosMasComprados];

        return $respuesta;
    }

    public function BorrarProducto($idProducto)
    {
        $producto = Productos::find($idProducto);
        $rutaImagenes = public_path() . str_replace("\\", "/", explode("public", Storage::disk('public_images_categorias')->getDriver()->getAdapter()->getPathPrefix())[1]);
        $mi_imagen = $rutaImagenes . $producto->imagen;

        if (@getimagesize($mi_imagen)) {
            echo "El archivo existe";
            unlink($mi_imagen);
        } else {
            echo "El archivo no existe";
        }
        $producto->delete();
        $respuesta = array("mensaje" => config('codigosRespuesta.200'), "data" => "Borrado exitosamente.");
        return $respuesta;
    }

    public function ModificarProducto($idProducto)
    {
        $producto = Productos::find($idProducto);
        var_dump($producto);
    }
}
