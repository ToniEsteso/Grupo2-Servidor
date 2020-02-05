<?php

namespace App\Http\Controllers;

use App\Http\Models\Carrito;
use App\Http\Models\Productos;
use App\Http\Models\Producto_Carrito;
use Illuminate\Support\Facades\Storage;

class CarritoController extends Controller
{
    public function Get($idUsuario)
    {
        $carrito = Carrito::where([
            ['idUsuario', $idUsuario],
            ['estado', 'pendiente'],
        ])->first();

        if ($carrito == null) {
            $respuesta = config('codigosRespuesta.404');
        } else {
            $productosCarrito = Producto_Carrito::where('idCarrito', $carrito->idCarrito)->get();
            $dataProductos = array();
            foreach ($productosCarrito as $prod) {
                $producto = Productos::where('id', $prod->idProducto)->get()[0];
                $dataProductos[] = [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'descripcion' => $producto->descripcion,
                    'imagen' => str_replace("\\", "/", explode("public", Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]) . $producto->imagen,
                    'unidades' => $prod->cantidad,
                ];
            }
            $data[] = [
                'idUsuario' => $idUsuario,
                'fechaCompra' => $carrito->fechaCompra,
                'productos' => $dataProductos,
            ];
            $respuesta = ["mensaje" => config('codigosRespuesta.200'), "data" => $data];
        }

        return $respuesta;
    }
    public function HistorialCarritos($idUsuario)
    {
        $data = array();
        $carritos = Carrito::Where("idUsuario", $idUsuario)->get();

        foreach ($carritos as $carr) {
            $productosCarrito = Producto_Carrito::where('idCarrito', $carr->idCarrito)->get();
            $dataProductos = array();
            foreach ($productosCarrito as $prod) {
                $producto = Productos::where('id', $prod->idProducto)->get()[0];
                $dataProductos[] = [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'descripcion' => $producto->descripcion,
                    'imagen' => str_replace("\\", "/", explode("public", Storage::disk('public_images_productos')->getDriver()->getAdapter()->getPathPrefix())[1]) . $producto->imagen,
                    'unidades' => $prod->cantidad,
                ];
            }
            $data[] = [
                'idUsuario' => $idUsuario,
                'fechaCompra' => $carr->fechaCompra,
                'productos' => $dataProductos,
            ];
        }
        if (empty($carritos)) {
            $respuesta = ["Error" => config('codigosRespuesta.400')];
        } else {
            // DEVOLVER TODOS LOS CARRITOS
            $respuesta = [
                "mensaje" => config('codigosRespuesta.200'),
                "data" => $data];
        }

        return $respuesta;
    }

    public function InsertarCarrito()
    {
        $credentials = request(['idUsuario', 'fechaCompra', "productos"]);
        $idUsuario = $credentials['idUsuario'];
        $fechaCompra = $credentials['fechaCompra'];
        try {
            $productos = $credentials['productos'];
        } catch (\Throwable $th) {
        }

        if ($credentials['idUsuario'] == 'invitado') {
            $respuesta = config('codigosRespuesta.404');
        } else {
            //comprobar si ya tiene un carrito
            $carrito = Carrito::where([
                ['idUsuario', $credentials['idUsuario']],
                ['estado', 'pendiente'],
            ])->first();

            if ($carrito) {
                echo 'existe un carrito pendiente';
                $carrito->estado = 'pendiente';
                $carrito->fechaCompra = $credentials["fechaCompra"];
                $carrito->save();

                //TABLA PRODUCTOS_CARRITO
                Producto_Carrito::where('idCarrito', $carrito->idCarrito)->delete();
                foreach ($productos as $key) {
                    $productoCarrito = new Producto_Carrito();
                    $productoCarrito->idProducto = $key["id"];
                    $productoCarrito->idCarrito = $carrito->idCarrito;
                    $productoCarrito->cantidad = $key["unidades"];
                    $productoCarrito->save();
                }
            } else {
                echo 'no tiene un carrito pendiente';
                $carrito = new Carrito();
                $carrito->idUsuario = $credentials["idUsuario"];
                $carrito->estado = 'pendiente';
                $carrito->fechaCompra = $credentials["fechaCompra"];
                $carrito->save();

                //TABLA PRODUCTOS_CARRITO
                foreach ($productos as $key) {
                    $productoCarrito = new Producto_Carrito();
                    $productoCarrito->idProducto = $key["id"];
                    $productoCarrito->idCarrito = $carrito->idCarrito;
                    $productoCarrito->cantidad = $key["unidades"];
                    $productoCarrito->save();
                }
            }
        }
    }
    public function ComprarCarrito()
    {
        $credentials = request(['idUsuario', 'fechaCompra']);

        $carrito = Carrito::where([
            ['idUsuario', $credentials['idUsuario']],
            ['estado', 'pendiente'],
        ])->first();
        try {
            $carrito->estado = 'comprado';
            $carrito->save();
        } catch (\Throwable $th) {
            $respuesta = ["error" => config('codigosRespuesta.401')];
            return $respuesta;
        }
    }

    public function numeroCompras()
    {
        $numCompras = Carrito::where('estado', 'comprado')->count();
        $respuesta = [
            "mensaje" => config('codigosRespuesta.200'),
            "data" => $numCompras];

            return $respuesta;
    }
}
