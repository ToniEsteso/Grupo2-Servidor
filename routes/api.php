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

Route::get('/categorias/{categoria}', 'CategoriasController@Get');

//PRODUCTOS
Route::get('productos', 'ProductosController@GetAll');

Route::get('productos/{producto}', 'ProductosController@Get');

<<<<<<< HEAD
//CAROUSEL
Route::get('carousel', 'CarouselController@GetAll');

Route::get('carousel/{id}', 'CarouselController@Get');

=======
>>>>>>> e3d47c9199b3530af9eb224551cb451f46045668
//USUARIOS
