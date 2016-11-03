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

class ReporteValorizacionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();
        $filtro = 0;
        return view('reportevalorizacion/index')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("filtro",$filtro);
    }

    public function postBuscar(Request $request)
    {
        $bienes = $this->obtieneBien($request->tipo_bien,$request->centro,$request->oficina);
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();
        $filtro = 1;
        if($request->tipo_bien == "TODOS"){
            $tipos = array("ACTIVO", "REGISTRO", "LICENCIA", "RAIZ");
        }
        else{
           $tipos = array("BIEN"); 
        }
        return view('reportevalorizacion/index')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("bienes",$bienes)->with("filtro",$filtro)->with("centro", $request->centro)->with("oficina", $request->oficina)->with("tipo_bien", $request->tipo_bien)->with("tipos", $tipos);
    }

    public function obtieneBien($tipo_bien, $centro, $oficina){
        switch ($tipo_bien) {
            case 'activo':
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
                break;
            case 'registro':
                if($centro == "TODOS"){
                    $bienes = BienRegistro::all();
                }
                else{
                    if($oficina == "TODOS"){
                        $bienes = BienRegistro::where("id_centro",$centro)->get();
                    }else{
                        $bienes = BienRegistro::where("id_centro",$centro)->where("id_sector",$oficina)->get();
                    }
                }
                break;
            case 'licencia':
                if($centro == "TODOS"){
                    $bienes = BienLicencia::all();
                }
                else{
                    if($oficina == "TODOS"){
                        $bienes = BienLicencia::where("id_centro",$centro)->get();
                    }else{
                        $bienes = BienLicencia::where("id_centro",$centro)->where("id_sector",$oficina)->get();
                    }
                }
                break;
            case 'raiz':
                if($centro == "TODOS"){
                    $bienes = BienRaiz::all();
                }
                else{
                    if($oficina == "TODOS"){
                        $bienes = BienRaiz::where("id_centro",$centro)->get();
                    }else{
                        $bienes = BienRaiz::where("id_centro",$centro)->where("id_sector",$oficina)->get();
                    }
                }
                break;

            case 'TODOS':
                $bienes = [];
                if($centro == "TODOS"){
                    $values = BienActivo::all();
                    foreach ($values as $key => $value) {
                        $data = new \stdClass;
                        $data->codigo = $value->category->codigo."-".$value->numero;
                        $data->descripcion = $value->descripcion;
                        $data->fecha_incorporacion = $value->fecha;
                        $data->valor = $value->valor;
                        $data->bien = "ACTIVO";
                        $bienes[] = $data;
                    }
                    $values = BienLicencia::all();
                    foreach ($values as $key => $value) {
                        $data = new \stdClass;
                        $data->codigo = $value->numero;
                        $data->descripcion = $value->descripcion;
                        $data->fecha_incorporacion = $value->fecha_incorporacion;
                        $data->valor = $value->valor;
                        $data->bien = "LICENCIA";
                        $bienes[] = $data;
                    }
                    $values = BienRegistro::all();
                    foreach ($values as $key => $value) {
                        $data = new \stdClass;
                        $data->codigo = $value->codigo;
                        $data->descripcion = $value->descripcion;
                        $data->fecha_incorporacion = $value->fecha_incorporacion;
                        $data->valor = $value->valor;
                        $data->bien = "REGISTRO";
                        $bienes[] = $data;
                    }
                    $values = BienRaiz::all();
                    foreach ($values as $key => $value) {
                        $data = new \stdClass;
                        $data->codigo = "";
                        $data->descripcion = $value->descripcion;
                        $data->fecha_incorporacion = $value->fecha_incorporacion;
                        $data->valor = $value->avaluo_fiscal;
                        $data->bien = "RAIZ";
                        $bienes[] = $data;
                    }
                }
                else{
                    if($oficina == "TODOS"){
                        $values = BienActivo::where("id_centro",$centro)->get();
                        foreach ($values as $key => $value) {
                            $data = new \stdClass;
                            $data->codigo = $value->category->codigo."-".$value->numero;
                            $data->descripcion = $value->descripcion;
                            $data->fecha_incorporacion = $value->fecha;
                            $data->valor = $value->valor;
                            $data->bien = "ACTIVO";
                            $bienes[] = $data;
                        }
                        $values = BienLicencia::where("id_centro",$centro)->get();
                        foreach ($values as $key => $value) {
                            $data = new \stdClass;
                            $data->codigo = $value->numero;
                            $data->descripcion = $value->descripcion;
                            $data->fecha_incorporacion = $value->fecha_incorporacion;
                            $data->valor = $value->valor;
                            $data->bien = "LICENCIA";
                            $bienes[] = $data;
                        }
                        $values = BienRegistro::where("id_centro",$centro)->get();
                        foreach ($values as $key => $value) {
                            $data = new \stdClass;
                            $data->codigo = $value->codigo;
                            $data->descripcion = $value->descripcion;
                            $data->fecha_incorporacion = $value->fecha_incorporacion;
                            $data->valor = $value->valor;
                            $data->bien = "REGISTRO";
                            $bienes[] = $data;
                        }
                        $values = BienRaiz::where("id_centro",$centro)->get();
                        foreach ($values as $key => $value) {
                            $data = new \stdClass;
                            $data->codigo = "";
                            $data->descripcion = $value->descripcion;
                            $data->fecha_incorporacion = $value->fecha_incorporacion;
                            $data->valor = $value->avaluo_fiscal;
                            $data->bien = "RAIZ";
                            $bienes[] = $data;
                        }
                    }else{
                        $values = BienActivo::where("id_centro",$centro)->where("id_sector",$oficina)->get();
                        foreach ($values as $key => $value) {
                            $data = new \stdClass;
                            $data->codigo = $value->category->codigo."-".$value->numero;
                            $data->descripcion = $value->descripcion;
                            $data->fecha_incorporacion = $value->fecha;
                            $data->valor = $value->valor;
                            $data->bien = "ACTIVO";
                            $bienes[] = $data;
                        }
                        $values = BienLicencia::where("id_centro",$centro)->where("id_sector",$oficina)->get();
                        foreach ($values as $key => $value) {
                            $data = new \stdClass;
                            $data->codigo = $value->numero;
                            $data->descripcion = $value->descripcion;
                            $data->fecha_incorporacion = $value->fecha_incorporacion;
                            $data->valor = $value->valor;
                            $data->bien = "LICENCIA";
                            $bienes[] = $data;
                        }
                        $values = BienRegistro::where("id_centro",$centro)->where("id_sector",$oficina)->get();
                        foreach ($values as $key => $value) {
                            $data = new \stdClass;
                            $data->codigo = $value->codigo;
                            $data->descripcion = $value->descripcion;
                            $data->fecha_incorporacion = $value->fecha_incorporacion;
                            $data->valor = $value->valor;
                            $data->bien = "REGISTRO";
                            $bienes[] = $data;
                        }
                        $values = BienRaiz::where("id_centro",$centro)->where("id_sector",$oficina)->get();
                        foreach ($values as $key => $value) {
                            $data = new \stdClass;
                            $data->codigo = "";
                            $data->descripcion = $value->descripcion;
                            $data->fecha_incorporacion = $value->fecha_incorporacion;
                            $data->valor = $value->avaluo_fiscal;
                            $data->bien = "RAIZ";
                            $bienes[] = $data;
                        }
                    }
                }
                break;
            
            default:
                # code...
                break;
        }
        return $bienes;
    }

}

