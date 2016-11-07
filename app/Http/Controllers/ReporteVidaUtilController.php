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
        return view('reportevidautil/index')->with("filtro",$filtro);
    }

    public function postBuscar(Request $request)
    {
        $bienes = $this->obtieneBien($request->ano);
        $bienes = $this->filtroBien($bienes,$request->ano);
        $filtro = 1;
        return view('reportevidautil/index')->with("bienes",$bienes)->with("filtro",$filtro)->with("ano", $request->ano);
    }

    public function obtieneBien(){
        $values = BienActivo::all();
        $bienes = [];
        foreach ($values as $key => $value) {
            $data = new \stdClass;
            $data->codigo = $value->category->codigo."-".$value->numero;
            $data->descripcion = $value->descripcion;
            $data->fecha_incorporacion = $value->fecha;
            $data->id_centro = $value->id_centro;
            $data->id_sector = $value->id_sector;
            $data->id_cuenta_contable = $value->id_sector;
            $data->centro = $value->centrocosto->nombre;
            $data->sector = $value->sector->nombre;
            $data->cuenta_contable = $value->cuenta_contable->nombre;
            $data->vida_util = $value->vida_util;

            $particion = explode("/", $data->fecha_incorporacion);
            $data->expiracion = $particion[2]+$value->vida_util;
            $bienes[] = $data;
        }
        return $bienes;
    }

    public function filtroBien($values, $ano){
        $bienes = [];
        if($ano == 0){
            foreach ($values as $key => $value) {
                if($value->expiracion < date("Y")){
                    $bienes[] = $value;
                }
            }
        }else{
            foreach ($values as $key => $value) {
                if($value->expiracion = $ano){
                    $bienes[] = $value;
                }
            }
        }
        return $bienes;
    }

}

