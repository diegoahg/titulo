<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Producto as Producto;
use App\Categoria as Categoria;
use App\Inventario as Inventario;
use App\CentroCosto as CentroCosto;
use App\Sector as Sector;
use DB;
use Crypt;
class InventarioController extends Controller
{
    /**
     * Responds to requests to GET /users
     */
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getIndex()
    {
        $inventarios = Inventario::all();
        return view('inventario/index')->with("inventarios",$inventarios);
    }

    public function getIngreso()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();

        $inventarios = Inventario::all();
          $json = array();
          foreach($inventarios as $inventario){
            array_push($json, $inventario->descripcion);
          }
        $json = json_encode($json);

        return view('inventario/ingreso')->with("json",$json)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias)->with("productos",$productos);
    }

    public function postIngreso(Request $request)
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

           $inventario = new Inventario();
           $inventario->id_usuario =  1;
           $inventario->fecha =   date_format(date_create($request->input("fecha")), 'Y-m-d');
           $inventario->centro =  $request->input("centro");
           $inventario->oficina =  $request->input("oficina");
           $inventario->categoria =  $request->input("categoria");
           $inventario->numero =  $request->input("numero");
           $inventario->descripcion =  $request->input("descripcion");
           $inventario->valor =  $request->input("valor");
           $inventario->unidad =  $request->input("unidad");
           $inventario->marca =  $request->input("marca");
           $inventario->modelo =  $request->input("modelo");
           $inventario->serie =  $request->input("serie");
           $inventario->largo =  $request->input("largo");
           $inventario->ancho =  $request->input("ancho");
           $inventario->alto =  $request->input("alto");
           $inventario->orden =  $request->input("orden");
           $inventario->fecha =  $request->input("fecha");
           $inventario->cuenta_contable =  $request->input("cuenta_contable");
           $inventario->vida_util =  $request->input("vida_util");
           $inventario->tipo_inventario =  $request->input("tipo_inventario");
           $inventario->tipo_bien =  $request->input("tipo_bien");
           $inventario->enmienda =  $request->input("enmienda");
           $inventario->estado =  "ACTIVO";
           $inventario->save();
            return redirect("inventario")->with('success', 'ingreso')->with("id_igreso", $inventario->id);
        }
    }

    public function getEdit($key)
    {
        $id = Crypt::decrypt($key);
        $inventario = Inventario::find($id);
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();
        return view('inventario/edit')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias)->with("inventario",$inventario);
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
           $inventario = Inventario::find(Crypt::decrypt($request->input("_key")));
           $inventario->id_usuario =  1;
           $inventario->fecha =   date_format(date_create($request->input("fecha")), 'Y-m-d');
           $inventario->centro =  $request->input("centro");
           $inventario->oficina =  $request->input("oficina");
           $inventario->categoria =  $request->input("categoria");
           $inventario->numero =  $request->input("numero");
           $inventario->descripcion =  $request->input("descripcion");
           $inventario->valor =  $request->input("valor");
           $inventario->unidad =  $request->input("unidad");
           $inventario->marca =  $request->input("marca");
           $inventario->modelo =  $request->input("modelo");
           $inventario->serie =  $request->input("serie");
           $inventario->largo =  $request->input("largo");
           $inventario->ancho =  $request->input("ancho");
           $inventario->alto =  $request->input("alto");
           $inventario->orden =  $request->input("orden");
           $inventario->fecha =  $request->input("fecha");
           $inventario->cuenta_contable =  $request->input("cuenta_contable");
           $inventario->alta =  $request->input("alta");
           $inventario->vida_util =  $request->input("vida_util");
           $inventario->tipo_inventario =  $request->input("tipo_inventario");
           $inventario->tipo_bien =  $request->input("tipo_bien");
           $inventario->enmienda =  $request->input("enmienda");
           $inventario->save();
          return redirect("inventario")->with('edit', 'ingreso')->with("id_igreso", $inventario->id);
        }
    }

    public function getCambiaestado($key, $estado){
          $id = Crypt::decrypt($key);
          $inventario = Inventario::find($id);
          $inventario->estado = $estado;
          $inventario->save();
          return "OK";
    }

    public function postDescripcion(Request $request){
          $inventario = Inventario::where("descripcion","=",$request->input("descripcion"))->first();
          return $inventario;
    }

}