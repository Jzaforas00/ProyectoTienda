<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiIdiomaController;
use App\Http\Controllers\ApiRoleController;
use App\Http\Controllers\ApiUsuarioController;
use App\Http\Controllers\ApiCategoriaController;
use App\Http\Controllers\ApiProductoController;
use App\Http\Controllers\ApiPedidoController;
use App\Http\Controllers\ApiTraduccionCategoriaController;
use App\Http\Controllers\ApiTraduccionProductoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('idiomas', ApiIdiomaController::class); //Ruta idiomas
Route::apiResource('roles', ApiRoleController::class); //Ruta roles
Route::apiResource('usuarios', ApiUsuarioController::class); //Ruta usuarios
Route::apiResource('categorias', ApiCategoriaController::class); //Ruta categorias
Route::apiResource('productos', ApiProductoController::class); //Ruta productos
Route::apiResource('pedidos', ApiPedidoController::class); //Ruta pedidos
Route::apiResource('traduccionCategorias', ApiTraduccionCategoriaController::class); //Ruta traduccion categorias
Route::apiResource('traduccionProductos', ApiTraduccionProductoController::class); //Ruta traduccion productos

Route::post('/usuarios/verificarUsuario', [ApiUsuarioController::class, 'verificarCredenciales']);
Route::get('/usuarios/buscarPorNombre/{nombre}', [ApiUsuarioController::class, 'buscarPorNombre']);
Route::post('/traduccionProductos/eliminarTraduccionesPorProducto/{id_producto}', [ApiTraduccionProductoController::class, 'eliminarTraduccionesPorProducto']);
Route::get('/traduccionProductos/obtenerTraduccionesPorProducto/{id_producto}', [ApiTraduccionProductoController::class, 'obtenerTraduccionesPorProducto']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
