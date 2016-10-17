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
     /*   $messages = [
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
            'numero' => 'required|max:255',
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

           $bienregistro = new Inventario();
           $bienregistro->id_usuario =  Auth::user()->id;
           $bienregistro->fecha =   date_format(date_create($request->input("fecha")), 'Y-m-d');
           $bienregistro->centro =  $request->input("centro");
           $bienregistro->oficina =  $request->input("oficina");
           $bienregistro->categoria =  $request->input("categoria");
           $bienregistro->numero =  $request->input("numero");
           $bienregistro->descripcion =  $request->input("descripcion");
           $bienregistro->valor =  $request->input("valor");
           $bienregistro->unidad =  $request->input("unidad");
           $bienregistro->marca =  $request->input("marca");
           $bienregistro->modelo =  $request->input("modelo");
           $bienregistro->serie =  $request->input("serie");
           $bienregistro->largo =  $request->input("largo");
           $bienregistro->ancho =  $request->input("ancho");
           $bienregistro->alto =  $request->input("alto");
           $bienregistro->orden =  $request->input("orden");
           $bienregistro->fecha =  $request->input("fecha");
           $bienregistro->cuenta_contable =  $request->input("cuenta_contable");
           $bienregistro->alta =  $request->input("alta");
           $bienregistro->vida_util =  $request->input("vida_util");
           $bienregistro->tipo_inventario =  $request->input("tipo_inventario");
           $bienregistro->tipo_bien =  $request->input("tipo_bien");
           $bienregistro->enmienda =  $request->input("enmienda");
           $bienregistro->estado =  "ACTIVO";
           $bienregistro->save();
            return redirect("bien-registro")->with('success', 'ingreso')->with("id_igreso", $bienregistro->id);
                  }
*/

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

        return view('bienregistro/edit')->with("json",$json)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias)->with("bienregistro",$bienregistro);
    }

    public function postEdit(Request $request)
    {
        /*$messages = [
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
           $bienregistro = BienRegistro::find(Crypt::decrypt($request->input("_key")));
           $bienregistro->id_usuario =  Auth::user()->id;
           $bienregistro->fecha =   date_format(date_create($request->input("fecha")), 'Y-m-d');
           $bienregistro->centro =  $request->input("centro");
           $bienregistro->oficina =  $request->input("oficina");
           $bienregistro->categoria =  $request->input("categoria");
           $bienregistro->numero =  $request->input("numero");
           $bienregistro->descripcion =  $request->input("descripcion");
           $bienregistro->valor =  $request->input("valor");
           $bienregistro->unidad =  $request->input("unidad");
           $bienregistro->marca =  $request->input("marca");
           $bienregistro->modelo =  $request->input("modelo");
           $bienregistro->serie =  $request->input("serie");
           $bienregistro->largo =  $request->input("largo");
           $bienregistro->ancho =  $request->input("ancho");
           $bienregistro->alto =  $request->input("alto");
           $bienregistro->orden =  $request->input("orden");
           $bienregistro->fecha =  $request->input("fecha");
           $bienregistro->cuenta_contable =  $request->input("cuenta_contable");
           $bienregistro->alta =  $request->input("alta");
           $bienregistro->vida_util =  $request->input("vida_util");
           $bienregistro->tipo_inventario =  $request->input("tipo_inventario");
           $bienregistro->tipo_bien =  $request->input("tipo_bien");
           $bienregistro->enmienda =  $request->input("enmienda");
           $bienregistro->save();
          return redirect("inventario")->with('success', 'edit')->with("id_igreso", $bienregistro->id);
        }*/
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