<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Categoria as Categoria;
use App\BienActivo as BienActivo;
use App\BienRegistro as BienRegistro;
use App\BienLicencia as BienLicencia;
use App\BienRaiz as BienRaiz;
use App\CentroCosto as CentroCosto;
use App\Sector as Sector;
use App\Componentes as Componentes;
use App\Logs as Logs;
use App\User as User;

use Crypt;
use File;
use Image;
use PDF;
use Excel;
use Auth;

class LogsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $usuarios = User::all();
        $opciones = Logs::groupBy("modulo")->get();
        $filtro = 0;
        return view('logs/index')->with("usuarios",$usuarios)->with("filtro",$filtro)->with("opciones",$opciones);
    }

    public function postBuscar(Request $request)
    {
        $usuarios = User::all();
        $filtro = 1;
        $opciones = Logs::groupBy("modulo")->get();
        if($request->usuario == "TODOS"){
            if($request->modulo == "TODOS"){
                $infos = logs::all();
            }else{
                $infos = logs::where("modulo", $request->modulo)->get();
            }
        }else{
            if($request->modulo == "TODOS"){
                $infos = logs::where("id_user", $request->usuario)->get();
            }else{
                $infos = logs::where("modulo", $request->modulo)->where("id_user", $request->usuario)->get();
            }
            
        }
        return view('logs/index')->with("data_usuario",$request->usuario)->with("modulo",$request->modulo)->with("usuarios",$usuarios)->with("filtro",$filtro)->with("infos",$infos)->with("opciones",$opciones);
    }
}
