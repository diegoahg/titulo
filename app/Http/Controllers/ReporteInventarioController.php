<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Categoria as Categoria;
use App\bienactivo as Bienactivo;
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
        $bienactivos = Bienactivo::all();
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();
        $filtro = 1;
        return view('reporteinventario/index')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("bienactivos",$bienactivos)->with("filtro",$filtro);
    }

    public function getExportarPdf(Request $request)
    {
        $bienactivos = Bienactivo::all();
        $centrocostos = CentroCosto::all();
        $componentes = array();

        foreach ($bienactivos as $bienactivo) {
            $components = Componentes::where("id_bien","=",$bienactivo->id)->get();
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
        
        //$prueba = array_get($componentes, "10");
        //dd($prueba);
        
        $sectors = Sector::all();
        $html = view('reporteinventario/pdf')->with("componentes",$componentes)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("bienactivos",$bienactivos);
         return PDF::loadHTML($html)->setPaper('letter')->setWarnings(false)->stream();
    }

    public function getExportarExcel(Request $request){
        Excel::create('Reporte Inventario', function($excel) {
            $excel->sheet('Reporte Inventario', function($sheet) {
                $bienactivos = Bienactivo::all();
                $centrocostos = CentroCosto::all();
                $componentes = array();

                foreach ($bienactivos as $bienactivo) {
                    $components = Componentes::where("id_bien","=",$bienactivo->id)->get();
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
                
                //$prueba = array_get($componentes, "10");
                //dd($prueba);
                
                $sectors = Sector::all();
                $sheet->loadView('reporteinventario/pdf')->with("componentes",$componentes)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("bienactivos",$bienactivos);
            });
        })->export('xls');
    }

}
