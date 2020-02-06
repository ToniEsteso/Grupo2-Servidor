<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//CATEGORIAS
Route::get('/categorias', 'CategoriasController@GetAll');

Route::get('/categorias/productosCategoria', 'CategoriasController@ProductosCategoria');

Route::post('/categorias/nuevo', 'CategoriasController@anyadirCategoria');

Route::get('/categorias/{categoria}', 'CategoriasController@Get');

Route::get('/categorias/{categoria}/productos', 'CategoriasController@ProductosPorCategoria');

//PRODUCTOS
Route::get('/productos', 'ProductosController@GetAll');

Route::get('/productos/numeroProductos', 'ProductosController@NumeroProductos');

Route::get('/productos/productosMasComprados', 'ProductosController@productosMasComprados');

Route::post('/productos/nuevo', 'ProductosController@anyadirProducto');

Route::get('/productos/{producto}', 'ProductosController@Get');

Route::get('/busqueda={producto}', 'ProductosController@GetBarra');

//RECETAS
Route::get('/recetas', 'RecetasController@GetAll');

Route::get('/recetas/numeroRecetas', 'RecetasController@NumeroRecetas');

//CAROUSEL
// Route::get('/carousel', 'CarouselController@GetAll');

Route::get('/carousel', 'CarouselController@GetImagenesPromocion');

//USUARIOS

//REDES SOCIALES
Route::get('/redessociales', 'RedesSocialesController@GetAll');

Route::get('/redessociales/{id}', 'RedesSocialesController@Get');

// CARRITO
Route::get('/carrito/numeroCompras', 'CarritoController@NumeroCompras');
Route::get('/carrito/{idUsuario}', 'CarritoController@Get');
Route::get('/historialCarritos/{idUsuario}', 'CarritoController@HistorialCarritos');
Route::post('/insertarCarritoTemporal', 'CarritoController@InsertarCarrito');
Route::post('/comprarCarrito', 'CarritoController@ComprarCarrito');

//LOGIN


Route::group([
    'prefix' => 'auth',
], function () {
    Route::get('numeroUsuarios', 'AuthController@getNumeroUsuarios');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');
});
