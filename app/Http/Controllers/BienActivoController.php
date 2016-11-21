<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Categoria as Categoria;
use App\BienActivo as BienActivo;
use App\CentroCosto as CentroCosto;
use App\Sector as Sector;
use App\SectorUsuario as SectorUsuario;
use App\Componentes as Componentes;
use App\Logs as Logs;
use App\TipoBien as TipoBien;
use App\CuentaContable as CuentaContable;
use App\Observacion as Observacion;

use DB;
use Crypt;
use Auth;

class BienActivoController extends Controller
{
    /**
     * Responds to requests to GET /users
     */
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getIndex()
    {

        $auth_user = Auth::user();
        if($auth_user->permisos<=2){
          $bienactivos = BienActivo::all();
        }
        elseif($auth_user->permisos==3 || $auth_user->permisos==4){
          $sectorusuarios = SectorUsuario::where("id_usuario",$auth_user->id)->groupBy("id_centro")->get();
          $params = [];
          foreach ($sectorusuarios as $key => $sectorusuario) {
            $params[] =  $sectorusuario->id_centro;
          }
          $bienactivos = BienActivo::whereIn("id_centro",$params)->get();
        }
        elseif($auth_user->permisos==5){
          $sectorusuarios = SectorUsuario::where("id_usuario",$auth_user->id)->groupBy("id_sector")->get();
          $params = [];
          foreach ($sectorusuarios as $key => $sectorusuario) {
            $params[] =  $sectorusuario->id_sector;
          }
          $bienactivos = BienActivo::whereIn("id_sector",$params)->get();
        }
        
        return view('bienactivo/index')->with("bienactivos",$bienactivos);
    }

    public function getView($id)
    {
        $bienactivo = BienActivo::findOrFail($id);
        $componentes = Componentes::where("id_bien",$id)->get();
        return view('bienactivo/modalview')->with("bienactivo", $bienactivo)->with("componentes", $componentes);
    }

    public function getAdd()
    {
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::orderBy("nombre", "ASC")->get();
        $sectors = Sector::orderBy("nombre", "ASC")->get();
        $cuentacontables = CuentaContable::all();

        $tipobienes = TipoBien::orderBy("descripcion","ASC")->groupBy("descripcion")->get();
          $json = array();
          foreach($tipobienes as $tipobien){
            array_push($json, $tipobien->descripcion);
          }
        $json = json_encode($json);

        return view('bienactivo/add')->with("json",$json)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias)->with("cuentacontables",$cuentacontables);
    }

    public function postAdd(Request $request)
    {
        $messages = [
            'required'    => 'Debe ingresar el  :attribute',
            'email.required'    => 'Debe ingresar el  correo',
            'numeric' => 'El :attribute debe solo contener números',
            'integer' => 'El :attribute debe solo contener números enteros',
            'unique' => '¡El :attribute ya existe!',
            'max' => 'El :attribute no debe exeder los :max caracteres',
            'min' => 'El :attribute debe tener minimo :min caracteres',
            'confirmed' => 'Debe ingresar las 2 contraseñas iguales',
            'email' => 'Debe ingresar un correo vaildo',
        ];
        //validador de los input del formulario
        $validator = Validator::make($request->all(), [
            'centro'  => 'required|max:255',
            'oficina'  => 'required|max:255',
            'categoria' => 'required|max:255',
            'numero' => 'unique:bien_activo,numero,NULL,NULL,categoria,'.$request->categoria,
            'valor' => 'required|max:255',
            'unidad' => 'required|max:255',
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'serie' => 'required|max:255',
            'largo' => 'required|max:255',
            'ancho' => 'required|max:255',
            'orden' => 'required|max:255',
            'fecha' => 'required|max:255',
            'cuenta_contable' => 'required|max:255',
            'alta' => 'required|max:255',
            'vida_util' => 'required|max:255',
            'tipo_inventario' => 'required|max:255',
            'tipo_bien' => 'required|max:255',
            'enmienda' => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{
         

           $bienactivo = new BienActivo();
           $date = str_replace('/', '-', $request->fecha);
           $bienactivo->fecha = date('Y-m-d', strtotime($date));
           $bienactivo->id_centro =  $request->input("centro");
           $bienactivo->id_sector =  $request->input("oficina");
           $bienactivo->categoria =  $request->input("categoria");
           $bienactivo->numero =  $request->input("numero");
           $bienactivo->descripcion =  strtoupper($request->input("descripcion"));
           $bienactivo->valor =  $request->input("valor");
           $bienactivo->unidad =  strtoupper($request->input("unidad"));
           $bienactivo->marca =  strtoupper($request->input("marca"));
           $bienactivo->modelo =  strtoupper($request->input("modelo"));
           $bienactivo->serie =  strtoupper($request->input("serie"));
           $bienactivo->largo =  $request->input("largo");
           $bienactivo->ancho =  $request->input("ancho");
           $bienactivo->alto =  strtoupper($request->input("alto"));
           $bienactivo->orden =  strtoupper($request->input("orden"));
           $bienactivo->fecha =  $request->input("fecha");
           $bienactivo->cuenta_contable =  strtoupper($request->input("cuenta_contable"));
           $bienactivo->alta =  $request->input("alta");
           $bienactivo->vida_util =  $request->input("vida_util");
           $bienactivo->tipo_inventario=  strtoupper($request->input("tipo_inventario"));
           $bienactivo->tipo_bien =  strtoupper($request->input("tipo_bien"));
           $bienactivo->enmienda =  strtoupper($request->input("enmienda"));
           $bienactivo->estado =  "ACTIVO";
           $bienactivo->save();

           if($bienactivo->tipo_bien == "COMPLEJO"){
              $comp_codigo = $request->comp_codigo;
              $comp_descripcion = $request->comp_descripcion;
              $comp_serie = $request->comp_serie;
              $comp_marca = $request->comp_marca;
              $comp_modelo = $request->comp_modelo;
              $comp_categoria = $request->comp_categoria;
              $comp_tipo = $request->comp_tipo;
              for($i = 0; $i < count($comp_codigo); $i++){
                  $componente = new Componentes();
                  $componente->id_bien = $bienactivo->id;
                  $componente->codigo = strtoupper($comp_codigo[$i]);
                  $componente->descripcion = strtoupper($comp_descripcion[$i]);
                  $componente->serie = strtoupper($comp_serie[$i]);
                  $componente->marca = strtoupper($comp_marca[$i]);
                  $componente->modelo = strtoupper($comp_modelo[$i]);
                  $componente->categoria = strtoupper($comp_categoria[$i]);
                  $componente->tipo = strtoupper($comp_tipo[$i]);
                  $componente->save();
              }
           }

           //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "agregar";
           $logs->modulo = "BIEN ACTIVO";
           $logs->id_ref = $bienactivo->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se agrego el BIEN ACTIVO ".$bienactivo->descripcion;
           $logs->save();

           //Registro de Tipo Bien
           $tipobienes = TipoBien::where("codigo",$bienactivo->codigo)->get();
           if(count($tipobienes)==0){
              $tipobien = new TipoBien();
              $tipobien->codigo = $bienactivo->numero;
              $tipobien->descripcion = strtoupper($bienactivo->descripcion);
              $tipobien->save();
           }
            return redirect("bien-activo")->with('success', 'bienactivo')->with("id_igreso", $bienactivo->id);
        }
    }

    public function getEdit($key)
    {
        $id = Crypt::decrypt($key);
        $bienactivo = BienActivo::find($id);
        $componentes = Componentes::where("id_bien",$id)->get();
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::orderBy("nombre", "ASC")->get();
        $sectors = Sector::orderBy("nombre", "ASC")->get();
        $cuentacontables = CuentaContable::all();
        return view('bienactivo/edit')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias)->with("bienactivo",$bienactivo)->with("componentes",$componentes)->with("cuentacontables",$cuentacontables);
    }

    public function postEdit(Request $request)
    {
        $messages = [
            'required'    => 'Debe ingresar el  :attribute',
            'email.required'    => 'Debe ingresar el  correo',
            'numeric' => 'El :attribute debe solo contener números',
            'integer' => 'El :attribute debe solo contener números enteros',
            'unique' => '¡El :attribute ya existe!',
            'max' => 'El :attribute no debe exeder los :max caracteres',
            'min' => 'El :attribute debe tener minimo :min caracteres',
            'confirmed' => 'Debe ingresar las 2 contraseñas iguales',
            'email' => 'Debe ingresar un correo vaildo',
        ];
        //validador de los input del formulario
        $validator = Validator::make($request->all(), [
            'fecha'  => 'required|max:255',
            'centro'  => 'required|max:255',
            'oficina' => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{
           $bienactivo = BienActivo::find(Crypt::decrypt($request->input("_key")));
           $date = str_replace('/', '-', $request->fecha);
           $bienactivo->fecha = date('Y-m-d', strtotime($date));
           $bienactivo->id_centro =  $request->input("centro");
           $bienactivo->id_sector =  $request->input("oficina");
           $bienactivo->categoria =  $request->input("categoria");
           $bienactivo->numero =  $request->input("numero");
           $bienactivo->descripcion =  strtoupper($request->input("descripcion"));
           $bienactivo->valor =  $request->input("valor");
           $bienactivo->unidad =  strtoupper($request->input("unidad"));
           $bienactivo->marca =  strtoupper($request->input("marca"));
           $bienactivo->modelo =  strtoupper($request->input("modelo"));
           $bienactivo->serie =  strtoupper($request->input("serie"));
           $bienactivo->largo =  $request->input("largo");
           $bienactivo->ancho =  $request->input("ancho");
           $bienactivo->alto =  $request->input("alto");
           $bienactivo->orden = strtoupper( $request->input("orden"));
           $bienactivo->fecha =  $request->input("fecha");
           $bienactivo->cuenta_contable =  strtoupper($request->input("cuenta_contable"));
           $bienactivo->alta =  strtoupper($request->input("alta"));
           $bienactivo->vida_util =  $request->input("vida_util");
           $bienactivo->tipo_inventario =  strtoupper($request->input("tipo_inventario"));
           $bienactivo->tipo_bien = strtoupper( $request->input("tipo_bien"));
           $bienactivo->enmienda =  strtoupper($request->input("enmienda"));
           $bienactivo->save();

           if($bienactivo->tipo_bien == "COMPLEJO"){

              $deletes = Componentes::where("id_bien", $bienactivo->id)->get();
              foreach ($deletes as $delete) {
                $delete->delete();
              }
              $comp_codigo = $request->comp_codigo;
              $comp_descripcion = $request->comp_descripcion;
              $comp_serie = $request->comp_serie;
              $comp_marca = $request->comp_marca;
              $comp_modelo = $request->comp_modelo;
              $comp_categoria = $request->comp_categoria;
              $comp_tipo = $request->comp_tipo;
              for($i = 0; $i < count($comp_codigo); $i++){
                  $componente = new Componentes();
                  $componente->id_bien = $bienactivo->id;
                  $componente->codigo = strtoupper($comp_codigo[$i]);
                  $componente->descripcion = strtoupper($comp_descripcion[$i]);
                  $componente->serie = strtoupper($comp_serie[$i]);
                  $componente->marca = strtoupper($comp_marca[$i]);
                  $componente->modelo = strtoupper($comp_modelo[$i]);
                  $componente->categoria = strtoupper($comp_categoria[$i]);
                  $componente->tipo = strtoupper($comp_tipo[$i]);
                  $componente->save();
              }
           }

           //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "editar";
           $logs->modulo = "BIEN ACTIVO";
           $logs->id_ref = $bienactivo->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se agrego el BIEN ACTIVO ".$bienactivo->descripcion;
           $logs->save();

          return redirect("bien-activo")->with('success', 'edit')->with("id_igreso", $bienactivo->id);
        }
    }

    public function getCambiaestado($key, $estado){
          $id = Crypt::decrypt($key);
          $bienactivo = BienActivo::find($id);
          $bienactivo->estado = $estado;
          $bienactivo->save();
          return "OK";
    }

    public function postDescripcion(Request $request){
          $bienactivo = BienActivo::where("descripcion","=",strtoupper($request->input("descripcion")))->first();
          return $bienactivo;
    }

    public function postComponentes(Request $request){
          $bienactivo = BienActivo::where("descripcion","=",strtoupper($request->input("descripcion")))->first();
          $componentes = Componentes::where("id_bien",$bienactivo->id)->get();
          return $componentes;
    }

    public function postCuentacontable(Request $request){
          $cuentacontable = CuentaContable::find($request->input("id_cuenta_contable"));
          return $cuentacontable;
    }

    public function getObservacion($tipo, $id){
          $observaciones = Observacion::where("tipo_bien",$tipo)->where("id_bien",Crypt::decrypt($id))->get();
          return view('bienactivo/modalobservacion')->with('observaciones', $observaciones)->with('id', $id)->with('tipo', $tipo);
    }

    public function postObservacion(Request $request){
          $observacion = new Observacion();
          $observacion->observacion = $request->observacion;
          $observacion->tipo_bien = $request->tipo_bien;
          $observacion->id_bien = Crypt::decrypt($request->id_bien);
          $observacion->save();

          //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "observacion";
           $logs->modulo = "BIEN ACTIVO";
           $logs->id_ref =  Crypt::decrypt($request->id_bien);
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se agregó Observacion el BIEN ACTIVO (".$logs->id_ref."): ".$observacion->observacion;
           $logs->save();

          return back();
    }

}