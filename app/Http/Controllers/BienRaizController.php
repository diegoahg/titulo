<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Categoria as Categoria;
use App\Inventario as Inventario;
use App\CentroCosto as CentroCosto;
use App\Sector as Sector;
use App\SectorUsuario as SectorUsuario;
use App\BienRaiz as BienRaiz;
use App\Logs as Logs;
use App\CuentaContable as CuentaContable;
use DB;
use Auth;
use Crypt;
class BienRaizController extends Controller
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
        $bienraices = BienRaiz::all();
      }
      elseif($auth_user->permisos>=3 ){
        $sectorusuarios = SectorUsuario::where("id_usuario",$auth_user->id)->groupBy("id_centro")->get();
          $params = [];
          foreach ($sectorusuarios as $key => $sectorusuario) {
            $params[] =  $sectorusuario->id_centro;
          }
        $bienraices = BienRaiz::whereIn("id_centro",$params)->get();
      }
      return view('bienraiz/index')->with("bienraices",$bienraices);
    }

    public function getView($id)
    {
        $bienraiz = BienRaiz::findOrFail($id);
        return view('bienraiz/modalview')->with("bienraiz", $bienraiz);
    }

    public function getAdd()
    {
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();
        $cuentacontables = CuentaContable::all();

        $bienraices = BienRaiz::all();
          $json = array();
          foreach($bienraices as $bienraiz){
            array_push($json, $bienraiz->descripcion);
          }
        $json = json_encode($json);

        return view('bienraiz/add')->with("json",$json)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias)->with("cuentacontables",$cuentacontables);
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
            'valor_inicial' => 'required|max:255',
            'avaluo_fiscal' => 'required|max:255',
            'num_rol' => 'required|max:255',
            'valor_total' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

           $bienraiz = new BienRaiz();
           $bienraiz->id_centro =  $request->input("centro");
           //$bienraiz->id_sector =  $request->input("oficina");
           $bienraiz->id_sector =  0;
           $bienraiz->descripcion =  strtoupper($request->input("descripcion"));
           $bienraiz->valor_inicial =  $request->input("valor_inicial");
           $bienraiz->avaluo_fiscal =  $request->input("avaluo_fiscal");
           $bienraiz->num_rol =  $request->input("num_rol");
           $bienraiz->valor_total =  $request->input("valor_total");
           $bienraiz->cuenta_contable =  $request->input("cuenta_contable");
           $bienraiz->num_alta =  $request->input("num_alta");
           $bienraiz->mejora =  $request->input("mejora");
           $bienraiz->observacion =  strtoupper($request->input("observacion"));
           $bienraiz->orden_compra =  $request->input("orden_compra");
           $bienraiz->fecha_incorporacion =  $request->input("fecha");
           $bienraiz->tipo_inventario =  $request->input("tipo_inventario");
           $bienraiz->tipo_bien =  $request->input("tipo_bien");
           $bienraiz->save();

           //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "agregar";
           $logs->modulo = "BIEN RAIZ";
           $logs->id_ref = $bienraiz->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se agrego el BIEN RAIZ ".$bienraiz->descripcion;
           $logs->save();

            return redirect("bien-raiz")->with('success', 'ingreso')->with("id_igreso", $bienraiz->id);
        }
    }

    public function getEdit($key)
    {
        $id = Crypt::decrypt($key);
        $bienraiz = BienRaiz::find($id);
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::all();
        $cuentacontables = CuentaContable::all();
        $sectors = Sector::all();
        return view('bienraiz/edit')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias)->with("bienraiz",$bienraiz)->with("cuentacontables",$cuentacontables);
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
            'centro'  => 'required|max:255',
            'valor_inicial' => 'required|max:255',
            'avaluo_fiscal' => 'required|max:255',
            'num_rol' => 'required|max:255',
            'valor_total' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{
           $bienraiz = BienRaiz::find(Crypt::decrypt($request->input("_key")));
           $bienraiz->id_centro =  $request->input("centro");
           //$bienraiz->id_sector =  $request->input("oficina");
           $bienraiz->id_sector =  0;
           $bienraiz->descripcion =  strtoupper($request->input("descripcion"));
           $bienraiz->valor_inicial =  $request->input("valor_inicial");
           $bienraiz->avaluo_fiscal =  $request->input("avaluo_fiscal");
           $bienraiz->num_rol =  $request->input("num_rol");
           $bienraiz->valor_total =  $request->input("valor_total");
           $bienraiz->cuenta_contable =  $request->input("cuenta_contable");
           $bienraiz->num_alta =  $request->input("num_alta");
           $bienraiz->mejora =  $request->input("mejora");
           $bienraiz->observacion =  strtoupper($request->input("observacion"));
           $bienraiz->orden_compra =  $request->input("orden_compra");
           $bienraiz->fecha_incorporacion =  $request->input("fecha");
           $bienraiz->tipo_inventario =  $request->input("tipo_inventario");
           $bienraiz->tipo_bien =  $request->input("tipo_bien");
           $bienraiz->save();

           //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "editar";
           $logs->modulo = "BIEN RAIZ";
           $logs->id_ref = $bienraiz->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se editó el BIEN RAIZ ".$bienraiz->descripcion;
           $logs->save();

          return redirect("bien-raiz")->with('success', 'edit')->with("id_igreso", $bienraiz->id);
        }
    }

    public function getCambiaestado($key, $estado){
          $id = Crypt::decrypt($key);
          $bienraiz = BienRaiz::find($id);
          $bienraiz->estado = $estado;
          $bienraiz->save();
          return "OK";
    }

    public function postDescripcion(Request $request){
          $bienraiz = BienRaiz::where("descripcion","=",$request->input("descripcion"))->first();
          return $bienraiz;
    }

}