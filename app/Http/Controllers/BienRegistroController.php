<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Categoria as Categoria;
use App\BienRegistro as BienRegistro;
use App\CentroCosto as CentroCosto;
use App\Sector as Sector;
use App\Logs as Logs;
use DB;
use Auth;
use Crypt;
class BienRegistroController extends Controller
{
    /**
     * Responds to requests to GET /users
     */
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getIndex()
    {
        $bienregistros = BienRegistro::all();
        return view('bienregistro/index')->with("bienregistros",$bienregistros);
    }

    public function getAdd()
    {
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();

        $bienregistros = BienRegistro::all();
          $json = array();
          foreach($bienregistros as $bienregistro){
            array_push($json, $bienregistro->descripcion);
          }
        $json = json_encode($json);

        return view('bienregistro/add')->with("json",$json)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias);
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
            'data_centro'  => 'required|max:255',
            'data_oficina'  => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

           $codigo =  $request->data_codigo;
           $descripcion =  $request->data_descripcion;
           $cantidad =  $request->data_cantidad;
           $valor =  $request->data_valor;
           $orden_compra =  $request->data_orden_compra;
           $fecha_incorporacion =  $request->data_fecha;

           foreach ($deletes as $delete) {
             $delete->delete();
           }


           for($i=0; $i<count($codigo);$i++){

             $bienregistro = new BienRegistro();
             $bienregistro->id_centro =  $request->data_centro;
             $bienregistro->id_sector =  $request->data_oficina;
             $bienregistro->correlativo =  $i + 1;
             $bienregistro->codigo =  $codigo[$i];
             $bienregistro->descripcion =  $descripcion[$i];
             $bienregistro->cantidad =  $cantidad[$i];
             $bienregistro->valor =  $valor[$i];
             $bienregistro->orden_compra =  $orden_compra[$i];
             $bienregistro->fecha_incorporacion = $fecha_incorporacion[$i];
             $bienregistro->save();  

           }

            return redirect("bien-registro")->with('success', 'ingreso')->with("id_igreso", $bienregistro->id);
        }

        return redirect("bien-registro")->with('success', 'add');

    }

    public function getEdit($key)
    {
        $id = Crypt::decrypt($key);

        $bienregistro = BienRegistro::find($id);
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();

        $bienregistros = BienRegistro::all();
          $json = array();
          foreach($bienregistros as $bienregistro){
            array_push($json, $bienregistro->descripcion);
          }
        $json = json_encode($json);

        $bienregistro = BienRegistro::find($id);

        return view('bienregistro/edit')->with("json",$json)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias)->with("bienregistro",$bienregistro);
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
            'data_centro'  => 'required|max:255',
            'data_oficina'  => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{
           $codigo =  $request->data_codigo;
           $descripcion =  $request->data_descripcion;
           $cantidad =  $request->data_cantidad;
           $valor =  $request->data_valor;
           $orden_compra =  $request->data_orden_compra;
           $fecha=  $request->data_fecha;

           $deletes = BienRegistro::where("id_centro", $request->data_centro)->where("id_sector", $request->data_oficina)->get();

           foreach ($deletes as $delete) {
             $delete->delete();
           }

           for($i=0; $i<count($codigo);$i++){

             $bienregistro = new BienRegistro();
             $bienregistro->id_centro =  $request->data_centro;
             $bienregistro->id_sector =  $request->data_oficina;
             $bienregistro->correlativo =  $i + 1;
             $bienregistro->codigo =  $codigo[$i];
             $bienregistro->descripcion =  $descripcion[$i];
             $bienregistro->cantidad =  $cantidad[$i];
             $bienregistro->valor =  $valor[$i];
             $bienregistro->orden_compra =  $orden_compra[$i];
             $bienregistro->fecha_incorporacion = $fecha[$i];
             $bienregistro->save();  

           }
          return redirect("bien-registro")->with('success', 'edit')->with("id_igreso", $bienregistro->id);
        }
        return redirect("bien-registro")->with('success', 'edit');
    }

    public function getCambiaestado($key, $estado){
          $id = Crypt::decrypt($key);
          $bienregistro = BienRegistro::find($id);
          $bienregistro->estado = $estado;
          $bienregistro->save();
          return "OK";
    }

    public function postDescripcion(Request $request){
          $bienregistro = BienRegistro::where("descripcion","=",$request->input("descripcion"))->first();
          return $bienregistro;
    }

    public function postRegistros(Request $request){
          $registros = BienRegistro::where("id_centro","=",$request->centro)->where("id_sector","=",$request->sector)->get();

          $total = 0;
          foreach ($registros as $registro) {
              $total = ($registro->valor*$registro->cantidad) + $total;
          }
          return view('bienregistro/registros')->with("total",$total)->with("registros",$registros);
    }

    public function postAddregistros(Request $request){
           $bienregistro = new BienRegistro();
           $bienregistro->id_centro =  $request->centro;
           $bienregistro->id_sector =  $request->oficina;
           $bienregistro->correlativo =  0;
           $bienregistro->codigo =  $request->codigo;
           $bienregistro->descripcion =  $request->descripcion;
           $bienregistro->cantidad =  $request->cantidad;
           $bienregistro->valor =  $request->valor;
           $bienregistro->orden_compra =  $request->orden_compra;
           $bienregistro->fecha_incorporacion =  $request->fecha;
           $bienregistro->save();

          $registros = BienRegistro::where("id_centro",$request->centro)->where("id_sector",$request->oficina)->get();

          $total = 0;
          foreach ($registros as $registro) {
              $total = ($registro->valor*$registro->cantidad) + $total;
          }
           return view('bienregistro/registros')->with("total",$total)->with("registros",$registros);
    }

    public function postDeleteregistros(Request $request){
          $bienregistro = BienRegistro::find($request->key);
          $bienregistro->delete();
          $registros = BienRegistro::where("id_centro","=",$request->centro)->where("id_sector","=",$request->sector)->get();
          $total = 0;

          foreach ($registros as $registro) {
              $total = ($registro->valor*$registro->cantidad) + $total;
          }
          return view('bienregistro/registros')->with("total",$total)->with("registros",$registros);
    }


}