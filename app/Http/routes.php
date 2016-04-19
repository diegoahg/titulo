<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('main');
});

Route::controller('productos','ProductoController');
Route::controller('inventario', 'InventarioController');
Route::controller('usuarios', 'UsuariosController');
Route::controller('categorias', 'CategoriasController');
Route::controller('centrocosto', 'CentroCostoController');
Route::controller('sector', 'SectorController');


