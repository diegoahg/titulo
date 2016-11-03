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

use Crypt;
use File;
use Image;
use PDF;
use Excel;
use Auth;

class ReporteVidaUtilController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();
        $filtro = 0;
        return view('reportevidautil/index')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("filtro",$filtro);
    }

    public function postBuscar(Request $request)
    {
        $bienes = $this->obtieneBien($request->centro,$request->oficina);
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();
        $filtro = 1;
        return view('reportevidautil/index')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("bienes",$bienes)->with("filtro",$filtro)->with("centro", $request->centro)->with("oficina", $request->oficina);
    }

    public function obtieneBien($centro, $oficina){
        if($centro == "TODOS"){
            $bienes = BienActivo::all();
        }
        else{
            if($oficina == "TODOS"){
                $bienes = BienActivo::where("id_centro",$centro)->get();
            }else{
                $bienes = BienActivo::where("id_centro",$centro)->where("id_sector",$oficina)->get();
            }
        }
        return $bienes;
    }

}

