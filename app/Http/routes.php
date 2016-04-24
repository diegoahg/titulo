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

Route::get('/',  ['middleware' => 'auth', function () {

	$user = App\User::count();
	$inventario = App\Inventario::count();
	$centro = App\CentroCosto::count();
	$sector = App\Sector::count();

    return view('main')->with("sector",$sector)->with("centro",$centro)->with("inventario",$inventario)->with("user",$user);
}]);

Route::controller('productos','ProductoController');
Route::controller('inventario', 'InventarioController');
Route::controller('usuarios', 'UsuariosController');
Route::controller('categorias', 'CategoriasController');
Route::controller('centrocosto', 'CentroCostoController');
Route::controller('sector', 'SectorController');
Route::controller('login','LoginController');


