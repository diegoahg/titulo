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
        $filtro = 0;
        return view('logs/index')->with("usuarios",$usuarios)->with("filtro",$filtro);
    }

    public function postBuscar(Request $request)
    {
        $usuarios = User::all();
        $filtro = 1;
        if($request->usuario == "TODOS"){
            $infos = logs::where("modulo", "BIEN ".$request->tipo_bien)->get();
        }else{
            $infos = logs::where("modulo", "BIEN ".$request->tipo_bien)->where("id_user", $request->usuario)->get();
        }
        return view('logs/index')->with("data_usuario",$request->usuario)->with("tipo_bien",$request->tipo_bien)->with("usuarios",$usuarios)->with("filtro",$filtro)->with("infos",$infos);
    }
}
