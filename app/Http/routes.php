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
	$inventario = App\BienActivo::count();
	$centro = App\CentroCosto::count();
	$sector = App\Sector::count();

    return view('main')->with("sector",$sector)->with("centro",$centro)->with("inventario",$inventario)->with("user",$user);
}]);

Route::get('/pdf',  ['middleware' => 'auth', function () {
 return PDF::loadHTML("<h1>TEST</h1>")->setPaper('a4', 'landscape')->setWarnings(false)->stream();
}]);


Route::controller('bien-activo', 'BienActivoController');
Route::controller('bien-registro', 'BienRegistroController');
Route::controller('bien-licencia', 'BienLicenciaController');
Route::controller('bien-raiz', 'BienRaizController');
Route::controller('usuarios', 'UsuariosController');
Route::controller('categorias', 'CategoriasController');
Route::controller('centrocosto', 'CentroCostoController');
Route::controller('sector', 'SectorController');
Route::controller('reporte-inventario', 'ReporteInventarioController');
Route::controller('login','LoginController');
Route::controller('cuentacontable', 'CuentaContableController');


