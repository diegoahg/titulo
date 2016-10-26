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

class ReporteInventarioController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getIndex()
    {
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();
        $bienactivos = array();
        $filtro = 0;
        return view('reporteinventario/index')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("bienactivos",$bienactivos)->with("bienactivos",$bienactivos)->with("filtro",$filtro);
    }

    public function postBuscar(Request $request)
    {
        $bienes = $this->obtieneBien($request->tipo_bien,$request->centro,$request->oficina);
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();
        $filtro = 1;
        return view('reporteinventario/index')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("bienes",$bienes)->with("filtro",$filtro)->with("centro", $request->centro)->with("oficina", $request->oficina)->with("tipo_bien", $request->tipo_bien);
    }

    public function postExportarPdf(Request $request)
    {
        $bienes = $this->obtieneBien($request->tipo_bien,$request->centro,$request->oficina);
        if($request->centro == "TODOS"){
            $centrocostos = CentroCosto::all();
        }else{
            $centrocostos = CentroCosto::where("id",$request->centro);
        }

        if($request->oficina == "TODOS"){
            $sectors = CentroCosto::all();
        }else{
            $sectors = CentroCosto::where("id",$request->oficina);
        }
        $componentes = array();

        if($request->tipo_bien == "activo"){
            foreach ($bienes as $bien) {
                $components = Componentes::where("id_bien","=",$bien->id)->get();
                foreach ($components as $key => $component) {
                    $array =  array('codigo' => $component->codigo,
                                'descripcion' => $component->descripcion,
                                'serie' => $component->serie,
                                'marca' => $component->marca,
                                'modelo' => $component->modelo,
                                'categoria' => $component->categoria,
                                'tipo' => $component->tipo,
                            );
                    $componentes[$component->id_bien][] = ($array);
                }
            }
        }
        else{
            $componentes = "";
        }

        $html = view('reporteinventario/pdf')->with("componentes",$componentes)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("bienes",$bienes)->with("tipo_bien",$request->tipo_bien);
         return PDF::loadHTML($html)->setPaper('letter')->setWarnings(false)->stream();
    }

    public function postExportarExcel(Request $request){
        Excel::create('Reporte Inventario', function($excel) use ($request){
            $excel->sheet('Reporte Inventario', function($sheet) use ($request){
                $bienes = $this->obtieneBien($request->tipo_bien,$request->centro,$request->oficina);
                $centrocostos = CentroCosto::all();
                $sectors = Sector::all();
                $componentes = array();

                if($request->tipo_bien == "activo"){
                    foreach ($bienes as $bien) {
                        $components = Componentes::where("id_bien","=",$bien->id)->get();
                        foreach ($components as $key => $component) {
                            $array =  array('codigo' => $component->codigo,
                                        'descripcion' => $component->descripcion,
                                        'serie' => $component->serie,
                                        'marca' => $component->marca,
                                        'modelo' => $component->modelo,
                                        'categoria' => $component->categoria,
                                        'tipo' => $component->tipo,
                                    );
                            $componentes[$component->id_bien][] = ($array);
                        }
                    }
                }
                else{
                    $componentes = "";
                }
                
                //$prueba = array_get($componentes, "10");
                //dd($prueba);
                
                
                $sheet->loadView('reporteinventario/excel')->with("componentes",$componentes)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("bienes",$bienes)->with("tipo_bien",$request->tipo_bien);
            });
        })->export('xls');
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
            
            default:
                # code...
                break;
        }
        return $bienes;
    }

}
