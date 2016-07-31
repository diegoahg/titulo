<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Producto as Producto;
use App\Categoria as Categoria;
use App\bienactivo as bienactivo;
use App\CentroCosto as CentroCosto;
use App\Sector as Sector;
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
        $bienactivos = BienActivo::all();
        return view('bienactivo/index')->with("bienactivos",$bienactivos);
    }

    public function getAdd()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();

        $bienactivos = BienActivo::all();
          $json = array();
          foreach($bienactivos as $bienactivo){
            array_push($json, $bienactivo->descripcion);
          }
        $json = json_encode($json);

        return view('bienactivo/add')->with("json",$json)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias)->with("productos",$productos);
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

           $bienactivo = new BienActivo();
           $bienactivo->fecha =   date_format(date_create($request->input("fecha")), 'Y-m-d');
           $bienactivo->id_centro =  $request->input("centro");
           $bienactivo->id_sector =  $request->input("oficina");
           $bienactivo->categoria =  $request->input("categoria");
           $bienactivo->numero =  $request->input("numero");
           $bienactivo->descripcion =  $request->input("descripcion");
           $bienactivo->valor =  $request->input("valor");
           $bienactivo->unidad =  $request->input("unidad");
           $bienactivo->marca =  $request->input("marca");
           $bienactivo->modelo =  $request->input("modelo");
           $bienactivo->serie =  $request->input("serie");
           $bienactivo->largo =  $request->input("largo");
           $bienactivo->ancho =  $request->input("ancho");
           $bienactivo->alto =  $request->input("alto");
           $bienactivo->orden =  $request->input("orden");
           $bienactivo->fecha =  $request->input("fecha");
           $bienactivo->cuenta_contable =  $request->input("cuenta_contable");
           $bienactivo->alta =  $request->input("alta");
           $bienactivo->vida_util =  $request->input("vida_util");
           $bienactivo->tipo_inventario=  $request->input("tipo_inventario");
           $bienactivo->tipo_bien =  $request->input("tipo_bien");
           $bienactivo->enmienda =  $request->input("enmienda");
           $bienactivo->estado =  "ACTIVO";
           $bienactivo->save();
            return redirect("bien-activo")->with('success', 'bienactivo')->with("id_igreso", $bienactivo->id);
        }
    }

    public function getEdit($key)
    {
        $id = Crypt::decrypt($key);
        $bienactivo = BienActivo::find($id);
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();
        return view('bienactivo/edit')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias)->with("bienactivo",$bienactivo);
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
           $bienactivo->fecha =   date_format(date_create($request->input("fecha")), 'Y-m-d');
           $bienactivo->id_centro =  $request->input("centro");
           $bienactivo->id_sector =  $request->input("oficina");
           $bienactivo->categoria =  $request->input("categoria");
           $bienactivo->numero =  $request->input("numero");
           $bienactivo->descripcion =  $request->input("descripcion");
           $bienactivo->valor =  $request->input("valor");
           $bienactivo->unidad =  $request->input("unidad");
           $bienactivo->marca =  $request->input("marca");
           $bienactivo->modelo =  $request->input("modelo");
           $bienactivo->serie =  $request->input("serie");
           $bienactivo->largo =  $request->input("largo");
           $bienactivo->ancho =  $request->input("ancho");
           $bienactivo->alto =  $request->input("alto");
           $bienactivo->orden =  $request->input("orden");
           $bienactivo->fecha =  $request->input("fecha");
           $bienactivo->cuenta_contable =  $request->input("cuenta_contable");
           $bienactivo->alta =  $request->input("alta");
           $bienactivo->vida_util =  $request->input("vida_util");
           $bienactivo->tipo_inventario =  $request->input("tipo_inventario");
           $bienactivo->tipo_bien =  $request->input("tipo_bien");
           $bienactivo->enmienda =  $request->input("enmienda");
           $bienactivo->save();
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
          $bienactivo = BienActivo::where("descripcion","=",$request->input("descripcion"))->first();
          return $bienactivo;
    }

}