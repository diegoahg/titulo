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
use App\SectorUsuario as SectorUsuario;
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
        $auth_user = Auth::user();

        //PERMISOS A CENTROS Y SECTORES
         $sectorusuarios = SectorUsuario::where("id_usuario",$auth_user->id)->groupBy("id_centro")->get();
          $params_centro = [];
          foreach ($sectorusuarios as $key => $sectorusuario) {
            $params_centro[] =  $sectorusuario->id_centro;
          }
        $sectorusuarios = SectorUsuario::where("id_usuario",$auth_user->id)->groupBy("id_sector")->get();
          $params_sector = [];
          foreach ($sectorusuarios as $key => $sectorusuario) {
            $params_sector[] =  $sectorusuario->id_sector;
          }
        //FIN PERMISOS A CENTROS Y SECTOES


        if($auth_user->permisos<=2){
          $centrocostos = CentroCosto::all();
          $sectors = Sector::all();
        }
        elseif($auth_user->permisos==3 ){
          $centrocostos = CentroCosto::whereIn("id",$params_centro)->get();
          $sectors = Sector::all();
        }
        elseif($auth_user->permisos==5 || $auth_user->permisos==4){
          $centrocostos = CentroCosto::whereIn("id",$params_centro)->get();
          $sectors = Sector::whereIn("id",$params_sector)->get();
        }
        $filtro = 0;
        $preg_sectors = array();
        return view('reportevalorizacion/index')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("filtro",$filtro)->with("preg_sectors",$preg_sectors);
    }

    public function postBuscar(Request $request)
    {
        $bienes = $this->obtieneBien($request->tipo_bien,$request->centro,$request->oficina);
        $auth_user = Auth::user();

        //PERMISOS A CENTROS Y SECTORES
         $sectorusuarios = SectorUsuario::where("id_usuario",$auth_user->id)->groupBy("id_centro")->get();
          $params_centro = [];
          foreach ($sectorusuarios as $key => $sectorusuario) {
            $params_centro[] =  $sectorusuario->id_centro;
          }
        $sectorusuarios = SectorUsuario::where("id_usuario",$auth_user->id)->groupBy("id_sector")->get();
          $params_sector = [];
          foreach ($sectorusuarios as $key => $sectorusuario) {
            $params_sector[] =  $sectorusuario->id_sector;
          }
        //FIN PERMISOS A CENTROS Y SECTOES

        if($auth_user->permisos<=2){
          $centrocostos = CentroCosto::all();
          $sectors = Sector::all();
        }
        elseif($auth_user->permisos==3 ){
          $centrocostos = CentroCosto::whereIn("id",$params_centro)->get();
          $sectors = Sector::whereIn("id",$params_sector)->get();
        }
        elseif($auth_user->permisos==5 || $auth_user->permisos==4){
          $centrocostos = CentroCosto::whereIn("id",$params_centro)->get();
          $sectors = Sector::whereIn("id",$params_sector)->get();
        }
        $filtro = 1;
        if($request->tipo_bien == "TODOS"){
            $tipos = array("ACTIVO", "REGISTRO", "LICENCIA");
        }
        else{
           $tipos = array("BIEN"); 
        }

        if($request->oficina == "TODOS"){
            $preg_sectors = Sector::orderBy("id_centro_costo")->get();
        }else{
            $preg_sectors = Sector::where("id",$request->oficina)->orderBy("id_centro_costo")->get();
        }

        return view('reportevalorizacion/index')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("preg_sectors",$preg_sectors)->with("bienes",$bienes)->with("filtro",$filtro)->with("centro", $request->centro)->with("oficina", $request->oficina)->with("tipo_bien", $request->tipo_bien)->with("tipos", $tipos);
    }

    public function postExportarPdf(Request $request)
    {
        $bienes = $this->obtieneBien($request->tipo_bien,$request->centro,$request->oficina);

        if($request->centro == "TODOS"){
            $centrocostos = CentroCosto::all();
        }else{
            $centrocostos = CentroCosto::where("id",$request->centro)->get();;
        }

        if($request->oficina == "TODOS"){
            $sectors = Sector::orderBy("id_centro_costo")->get();
        }else{
            $sectors = Sector::where("id",$request->oficina)->orderBy("id_centro_costo")->get();
        }

        $filtro = 1;
        if($request->tipo_bien == "TODOS"){
            $tipos = array("ACTIVO", "REGISTRO", "LICENCIA");
        }
        else{
           $tipos = array("BIEN"); 
        }

        $html = view('reportevalorizacion/pdf')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("bienes",$bienes)->with("filtro",$filtro)->with("centro", $request->centro)->with("oficina", $request->oficina)->with("tipo_bien", $request->tipo_bien)->with("tipos", $tipos);
         return PDF::loadHTML($html)->setPaper('letter')->setWarnings(false)->stream();
    }

     public function postExportarExcel(Request $request){
        Excel::create('Reporte Inventario', function($excel) use ($request){
            $excel->sheet('Reporte Inventario', function($sheet) use ($request){
                $bienes = $this->obtieneBien($request->tipo_bien,$request->centro,$request->oficina);
                
                
                $sheet->loadView('reportevalorizacion/excel')->with("bienes",$bienes);
            });
        })->export('xls');
    }

    public function obtieneBien($tipo_bien, $centro, $oficina){
        $bienes = [];
        switch ($tipo_bien) {
            case 'activo':
                if($centro == "TODOS"){
                    $values = BienActivo::all();
                }
                else{
                    if($oficina == "TODOS"){
                        $values = BienActivo::where("id_centro",$centro)->get();
                    }else{
                        $values = BienActivo::where("id_centro",$centro)->where("id_sector",$oficina)->get();
                    }
                }
                foreach ($values as $key => $value) {
                    $data = new \stdClass;
                    $data->codigo = $value->category->codigo."-".$value->numero;
                    $data->descripcion = $value->descripcion;
                    $data->fecha_incorporacion = $value->fecha;
                    $data->valor = $value->valor;
                    $data->id_centro = $value->id_centro;
                    $data->id_sector = $value->id_sector;
                    $data->vida_util = $value->vida_util;
                    $particion = explode("/", $data->fecha_incorporacion);

                    //CALCULAR VALOR RESIDUAL
                    $depreciacion = $value->valor/(pow($value->vida_util,1));
                    $valor_final = $value->valor;
                    $anos = date("Y")-$particion[2];
                    if($anos>=$data->vida_util){
                        $valor_final = 0;
                    }else{
                        $valor_final = $valor_final - ($depreciacion * $anos);
                    }
                    //FINCALCULAR VALOR RESIDUAL

                    $data->residual = round($valor_final);
                    $data->bien = "ACTIVO";
                    $bienes[] = $data;
                }
                break;
            case 'registro':
                if($centro == "TODOS"){
                    $values = BienRegistro::all();
                }
                else{
                    if($oficina == "TODOS"){
                        $values = BienRegistro::where("id_centro",$centro)->get();
                    }else{
                        $values = BienRegistro::where("id_centro",$centro)->where("id_sector",$oficina)->get();
                    }
                }
                foreach ($values as $key => $value) {
                    $data = new \stdClass;
                    $data->codigo = $value->numero;
                    $data->descripcion = $value->descripcion;
                    $data->fecha_incorporacion = $value->fecha_incorporacion;
                    $data->valor = $value->valor;
                    $data->id_centro = $value->id_centro;
                    $data->id_sector = $value->id_sector;
                    $data->residual = $value->valor;
                    $data->bien = "LICENCIA";
                    $bienes[] = $data;
                }
                break;
            case 'licencia':
                if($centro == "TODOS"){
                    $values = BienLicencia::all();
                }
                else{
                    if($oficina == "TODOS"){
                        $values = BienLicencia::where("id_centro",$centro)->get();
                    }else{
                        $values = BienLicencia::where("id_centro",$centro)->where("id_sector",$oficina)->get();
                    }
                }
                foreach ($values as $key => $value) {
                    $data = new \stdClass;
                    $data->codigo = $value->numero;
                    $data->descripcion = $value->descripcion;
                    $data->fecha_incorporacion = $value->fecha_incorporacion;
                    $data->valor = $value->valor;
                    $data->id_centro = $value->id_centro;
                    $data->id_sector = $value->id_sector;
                    $data->residual = $value->valor;
                    $data->bien = "LICENCIA";
                    $bienes[] = $data;
                }
                break;
            case 'raiz':
                if($centro == "TODOS"){
                    $values = BienRaiz::all();
                }
                else{
                    if($oficina == "TODOS"){
                        $values = BienRaiz::where("id_centro",$centro)->get();
                    }else{
                        $values = BienRaiz::where("id_centro",$centro)->where("id_sector",$oficina)->get();
                    }
                }
                foreach ($values as $key => $value) {
                    $data = new \stdClass;
                    $data->codigo = "";
                    $data->descripcion = $value->descripcion;
                    $data->fecha_incorporacion = $value->fecha_incorporacion;
                    $data->valor = $value->avaluo_fiscal;
                    $data->id_centro = $value->id_centro;
                    $data->id_sector = $value->id_sector;
                    $data->residual = $value->valor;
                    $data->bien = "RAIZ";
                    $bienes[] = $data;
                }
                break;

            case 'TODOS':
                if($centro == "TODOS"){
                    $values = BienActivo::all();
                    foreach ($values as $key => $value) {
                        $data = new \stdClass;
                        $data->codigo = $value->category->codigo."-".$value->numero;
                        $data->descripcion = $value->descripcion;
                        $data->fecha_incorporacion = $value->fecha;
                        $data->valor = $value->valor;
                        $data->id_centro = $value->id_centro;
                        $data->id_sector = $value->id_sector;
                        $data->vida_util = $value->vida_util;
                        $particion = explode("/", $data->fecha_incorporacion);

                        //CALCULAR VALOR RESIDUAL
                        $depreciacion = $value->valor/(pow($value->vida_util,1));
                        $valor_final = $value->valor;
                        $anos = date("Y")-$particion[2];
                        if($anos>=$data->vida_util){
                            $valor_final = 0;
                        }else{
                            $valor_final = $valor_final - ($depreciacion * $anos);
                        }
                        //FINCALCULAR VALOR RESIDUAL

                        $data->residual = round($valor_final);
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
                        $data->id_centro = $value->id_centro;
                        $data->id_sector = $value->id_sector;
                        $data->residual = $value->valor;
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
                        $data->id_centro = $value->id_centro;
                        $data->id_sector = $value->id_sector;
                        $data->residual = $value->valor;
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
                        $data->id_centro = $value->id_centro;
                        $data->id_sector = $value->id_sector;
                        $data->residual = $value->valor;
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
                            $data->id_centro = $value->id_centro;
                            $data->id_sector = $value->id_sector;
                            $data->vida_util = $value->vida_util;

                            $particion = explode("/", $data->fecha_incorporacion);
                            
                            //CALCULAR VALOR RESIDUAL
                            $depreciacion = $value->valor/(pow($value->vida_util,1));
                            $valor_final = $value->valor;
                            $anos = date("Y")-$particion[2];
                            if($anos>=$data->vida_util){
                                $valor_final = 0;
                            }else{
                                $valor_final = $valor_final - ($depreciacion * $anos);
                            }
                            //FINCALCULAR VALOR RESIDUAL

                            $data->residual = round($valor_final);
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
                            $data->id_centro = $value->id_centro;
                            $data->id_sector = $value->id_sector;
                            $data->vida_util = 0;
                            $data->residual = $value->valor;
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
                            $data->id_centro = $value->id_centro;
                            $data->id_sector = $value->id_sector;
                            $data->vida_util = 0;
                            $data->residual = $value->valor;
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
                            $data->id_centro = $value->id_centro;
                            $data->id_sector = $value->id_sector;
                            $data->vida_util = 0;
                            $data->residual = $value->valor;
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
                            $data->id_centro = $value->id_centro;
                            $data->id_sector = $value->id_sector;
                            $data->vida_util = $value->vida_util;

                            $particion = explode("/", $data->fecha_incorporacion);
                            //CALCULAR VALOR RESIDUAL
                            $depreciacion = $value->valor/(pow($value->vida_util,1));
                            $valor_final = $value->valor;
                            $anos = date("Y")-$particion[2];
                            if($anos>=$data->vida_util){
                                $valor_final = 0;
                            }else{
                                $valor_final = $valor_final - ($depreciacion * $anos);
                            }
                            //FINCALCULAR VALOR RESIDUAL

                            $data->residual = round($valor_final);
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
                            $data->id_centro = $value->id_centro;
                            $data->id_sector = $value->id_sector;
                            $data->vida_util = 0;
                            $data->residual = $value->valor;
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
                            $data->id_centro = $value->id_centro;
                            $data->id_sector = $value->id_sector;
                            $data->vida_util = 0;
                            $data->residual = $value->valor;
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
                            $data->id_centro = $value->id_centro;
                            $data->id_sector = $value->id_sector;
                            $data->vida_util = 0;
                            $data->residual = $value->valor;
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

