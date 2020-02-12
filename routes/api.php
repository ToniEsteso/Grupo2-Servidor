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

// ADMINISTRADOR
//RESUMENES
Route::get('/auth/numeroUsuarios', 'AuthController@getNumeroUsuarios')->middleware('checkAdmin');
Route::get('/carrito/numeroCompras', 'CarritoController@NumeroCompras')->middleware('checkAdmin');
Route::get('/carrito/resumenIngresos', 'CarritoController@ResumenIngresos')->middleware('checkAdmin');
Route::get('/productos/productosMasComprados', 'ProductosController@productosMasComprados')->middleware('checkAdmin');
Route::get('/productos/numeroProductos', 'ProductosController@NumeroProductos')->middleware('checkAdmin');
Route::get('/recetas/numeroRecetas', 'RecetasController@NumeroRecetas')->middleware('checkAdmin');
//CRUD
Route::post('/redessociales', 'RedesSocialesController@CrearRedSocial')->middleware('checkAdmin');
Route::delete('/redessociales/{id}', 'RedesSocialesController@BorrarRedSocial')->middleware('checkAdmin');
Route::put('/redessociales/{id}', 'RedesSocialesController@ModificarRedSocial')->middleware('checkAdmin');
Route::post('/productos/nuevo', 'ProductosController@anyadirProducto')->middleware('checkAdmin');
Route::delete('/productos/{idProducto}', 'ProductosController@BorrarProducto')->middleware('checkAdmin');
Route::patch('/productos/{idProducto}', 'ProductosController@ModificarProducto')->middleware('checkAdmin');
Route::post('/categorias/nueva', 'CategoriasController@anyadirCategoria')->middleware('checkAdmin');
Route::delete('/categorias/{categoria}', 'CategoriasController@BorrarCategoria')->middleware('checkAdmin');
Route::post('/recetas/nueva', 'RecetasController@anyadirReceta')->middleware('checkAdmin');
Route::delete('/recetas/{idReceta}', 'RecetasController@BorrarReceta')->middleware('checkAdmin');
Route::get('/categorias/productosCategoria', 'CategoriasController@ProductosCategoria')->middleware('checkAdmin');

//CATEGORIAS
Route::get('/categorias', 'CategoriasController@GetAll');
Route::get('/categorias/{categoria}', 'CategoriasController@Get');
Route::get('/categorias/{categoria}/productos', 'CategoriasController@ProductosPorCategoria');
Route::post('/categorias/{idCategoria}', 'CategoriasController@modificarCategoria');

//PRODUCTOS
Route::get('/productos', 'ProductosController@GetAll');
Route::get('/productos/{producto}', 'ProductosController@Get');
Route::get('/busqueda={producto}', 'ProductosController@GetBarra');

//RECETAS
Route::get('/recetas', 'RecetasController@GetAll');

//CAROUSEL
// Route::get('/carousel', 'CarouselController@GetAll');
Route::get('/carousel', 'CarouselController@GetImagenesPromocion');

//REDES SOCIALES
Route::get('/redessociales', 'RedesSocialesController@GetAll');
Route::get('/redessociales/{id}', 'RedesSocialesController@Get');

// CARRITO
Route::get('/carrito/{idUsuario}', 'CarritoController@Get');
Route::get('/historialCarritos/{idUsuario}', 'CarritoController@HistorialCarritos');
Route::post('/insertarCarritoTemporal', 'CarritoController@InsertarCarrito');
Route::post('/comprarCarrito', 'CarritoController@ComprarCarrito');

//LOGIN
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function () {
    // Route::get('numeroUsuarios', 'AuthController@getNumeroUsuarios');
    Route::post('me', 'AuthController@me');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('register', 'AuthController@register');
    Route::get('usuarios', 'AuthController@getAll');
    Route::delete('{idUsuario}', 'AuthController@BorrarUsuario');
});
