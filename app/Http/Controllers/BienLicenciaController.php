<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Categoria as Categoria;
use App\Inventario as Inventario;
use App\CentroCosto as CentroCosto;
use App\Sector as Sector;
use App\SectorUsuario as SectorUsuario;
use App\BienLicencia as BienLicencia;
use App\Logs as Logs;
use DB;
use Auth;
use Crypt;
class BienLicenciaController extends Controller
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
        $bienlicencias = BienLicencia::all();
      }
      elseif($auth_user->permisos==3 || $auth_user->permisos==4){
        $sectorusuarios = SectorUsuario::where("id_usuario",$auth_user->id)->groupBy("id_centro")->get();
          $params = [];
          foreach ($sectorusuarios as $key => $sectorusuario) {
            $params[] =  $sectorusuario->id_centro;
          }
        $bienlicencias = BienLicencia::whereIn("id_centro",$params)->get();
      }
      elseif($auth_user->permisos==5){
          $sectorusuarios = SectorUsuario::where("id_usuario",$auth_user->id)->groupBy("id_sector")->get();
          $params = [];
          foreach ($sectorusuarios as $key => $sectorusuario) {
            $params[] =  $sectorusuario->id_sector;
          }
          $bienlicencias = BienLicencia::where("id_sector",$params)->get();
      }
      return view('bienlicencia/index')->with("bienlicencias",$bienlicencias);
    }

    public function getView($id)
    {
        $bienlicencia = BienLicencia::findOrFail($id);
        return view('bienlicencia/modalview')->with("bienlicencia", $bienlicencia);
    }

    public function getAdd()
    {
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();

        $bienlicencias = BienLicencia::all();
          $json = array();
          foreach($bienlicencias as $bienlicencia){
            array_push($json, $bienlicencia->descripcion);
          }
        $json = json_encode($json);

        return view('bienlicencia/add')->with("json",$json)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias);
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
            //'categoria' => 'required|max:255',
            'numero' => 'required|max:255',
            'valor' => 'required|max:255',
            'unidad' => 'required|max:255',
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            //'serie' => 'required|max:255',
            //'largo' => 'required|max:255',
            //'ancho' => 'required|max:255',
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

           $bienlicencia = new BienLicencia();
           $bienlicencia->id_centro =  $request->input("centro");
           $bienlicencia->id_sector =  $request->input("oficina");
           $bienlicencia->categoria =  0;
           $bienlicencia->numero =  $request->input("numero");
           $bienlicencia->descripcion =  strtoupper($request->input("descripcion"));
           $bienlicencia->valor =  $request->input("valor");
           $bienlicencia->unidad =  strtoupper($request->input("unidad"));
           $bienlicencia->marca =  strtoupper($request->input("marca"));
           $bienlicencia->modelo =  strtoupper($request->input("modelo"));
           $bienlicencia->serie =  $request->input("serie");
           $bienlicencia->largo = 0;
           $bienlicencia->ancho = 0;
           $bienlicencia->alto =  0;
           $bienlicencia->orden =  $request->input("orden");
           $bienlicencia->fecha =  $request->input("fecha");
           $bienlicencia->cuenta_contable =  strtoupper($request->input("cuenta_contable"));
           $bienlicencia->alta =  $request->input("alta");
           $bienlicencia->vida_util =  $request->input("vida_util");
           $bienlicencia->tipo_inventario =  $request->input("tipo_inventario");
           $bienlicencia->tipo_bien =  $request->input("tipo_bien");
           $bienlicencia->enmienda =  $request->input("enmienda");
           $bienlicencia->estado =  "ACTIVO";
           $bienlicencia->save();

           //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "agregar";
           $logs->modulo = "BIEN LICENCIA";
           $logs->id_ref = $bienlicencia->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se agrego el BIEN LICENCIA ".$bienlicencia->descripcion;
           $logs->save();

            return redirect("bien-licencia")->with('success', 'ingreso')->with("id_igreso", $bienlicencia->id);
        }
    }

    public function getEdit($key)
    {
        $id = Crypt::decrypt($key);
        $bienlicencia = BienLicencia::find($id);
        $categorias = Categoria::all();
        $centrocostos = CentroCosto::all();
        $sectors = Sector::all();
        return view('bienlicencia/edit')->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("categorias",$categorias)->with("bienlicencia",$bienlicencia);
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
           $bienlicencia = BienLicencia::find(Crypt::decrypt($request->input("_key")));
           $bienlicencia->id_centro =  $request->input("centro");
           $bienlicencia->id_sector =  $request->input("oficina");
           $bienlicencia->categoria =  0;
           $bienlicencia->numero =  $request->input("numero");
           $bienlicencia->descripcion =  strtoupper($request->input("descripcion"));
           $bienlicencia->valor =  $request->input("valor");
           $bienlicencia->unidad = strtoupper( $request->input("unidad"));
           $bienlicencia->marca =  strtoupper($request->input("marca"));
           $bienlicencia->modelo =  strtoupper($request->input("modelo"));
           $bienlicencia->serie = strtoupper( $request->input("serie"));
           $bienlicencia->largo =  0;
           $bienlicencia->ancho =  0;
           $bienlicencia->alto =  0;
           $bienlicencia->orden =  $request->input("orden");
           $bienlicencia->fecha =  $request->input("fecha");
           $bienlicencia->cuenta_contable =  strtoupper($request->input("cuenta_contable"));
           $bienlicencia->alta =  $request->input("alta");
           $bienlicencia->vida_util =  $request->input("vida_util");
           $bienlicencia->tipo_inventario =  $request->input("tipo_inventario");
           $bienlicencia->tipo_bien =  $request->input("tipo_bien");
           $bienlicencia->enmienda =  $request->input("enmienda");
           $bienlicencia->save();

           //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "editar";
           $logs->modulo = "BIEN LICENCIA";
           $logs->id_ref = $bienlicencia->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se editó el BIEN LICENCIA ".$bienlicencia->descripcion;
           $logs->save();

          return redirect("bien-licencia")->with('success', 'edit')->with("id_igreso", $bienlicencia->id);
        }
    }

    public function getCambiaestado($key, $estado){
          $id = Crypt::decrypt($key);
          $bienlicencia = BienLicencia::find($id);
          $bienlicencia->estado = $estado;
          $bienlicencia->save();
          return "OK";
    }

    public function postDescripcion(Request $request){
          $bienlicencia = BienLicencia::where("descripcion","=",strtoupper($request->input("descripcion")))->first();
          return $bienlicencia;
    }

}