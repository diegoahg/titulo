<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\User;
use Crypt;
use Hash;
use App\Logs as Logs;
use Auth;
use App\CentroCosto as CentroCosto;
use App\Sector as Sector;
use App\SectorUsuario as SectorUsuario;

class UsuariosController extends Controller
{
    /**
     * Responds to requests to GET /users
     */

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getIndex()
    {
        $users = User::all();
        return view('usuarios/index')->with("users", $users);
    }

    public function getAdd()
    {

        $centrocostos = CentroCosto::orderBy("nombre", "ASC")->get();
        $sectors = Sector::orderBy("nombre", "ASC")->get();
        return view('usuarios/add')->with("centrocostos",$centrocostos)->with("sectors",$sectors);
    }

    public function postAdd(Request $request)
    {
        //mensajes de los validadores
        $messages = [
            'required'    => 'Debe ingresar el  :attribute',
            'email.required'    => 'Debe ingresar el  correo',
            'numeric' => 'El :attribute debe solo contener números',
            'unique' => '¡El :attribute ya existe!',
            'max' => 'El :attribute no debe exeder los :max caracteres',
            'min' => 'El :attribute debe tener minimo :min caracteres',
            'confirmed' => 'Debe ingresar las 2 contraseñas iguales',
            'email' => 'Debe ingresar un correo vaildo',
        ];
        //validador de los input del formulario
        $validator = Validator::make($request->all(), [
            'name'             => 'required|max:255',
            'apellido_paterno' => 'required|max:255',
            'apellido_materno' => 'required|max:255',
            'correo' => 'required|email|unique:users,email|max:255',
            'password' => 'required|max:255|confirmed',
            'password_confirmation ' => 'confirmed',
            'fono' => 'required|numeric|min:9',
            'centro' => 'required',
            'oficina' => 'required',
            //'movil' => 'required|numeric|min:9',
            'cargo' => 'required|max:255'
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

           $user = new User();
           $user->name = strtoupper($request->input("name"));
           $user->apellido_paterno = strtoupper($request->input("apellido_paterno"));
           $user->apellido_materno = strtoupper($request->input("apellido_materno"));
           $user->email =strtoupper($request->input("correo"));
           $user->password = Hash::make($request->input("password"));
           $user->fono = strtoupper($request->input("fono"));
           $user->movil = strtoupper($request->input("movil"));
           $user->departamento = "";
           $user->cargo = strtoupper($request->input("cargo"));
           $user->permisos = $request->permiso;
           $user->activo = $request->estado;
           $user->centro = $request->centro[0];
           $user->sector = $request->oficina[0];
           $user->save();

           $sectores = $request->oficina;

           //ARREGLO DE SECTORES Y OFICINA
           for($i=0; $i<count($sectores); $i++){
              $sector = Sector::find($sectores[$i]);
              $sectorusuario = new SectorUsuario();
              $sectorusuario->id_usuario = $user->id;
              $sectorusuario->id_centro  = $sector->id_centro_costo;
              $sectorusuario->id_sector  = $sector->id;
              $sectorusuario->save();
           }

           //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "agregar";
           $logs->modulo = "USUARIOS";
           $logs->id_ref = $user->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se agrego el USUARIO ".$user->name. " " . $user->apellido_paterno;
           $logs->save();

           return redirect("usuarios")->with('success', 'add')->with("id_usuario", $user->id);
        }
    }       

    /*public function getView($id)
    {
        $user = User::findOrFail($id);
        return view('Usuarios/view')->with("user", $user);
    }*/

    public function getView($id)
    {
        $user = User::findOrFail($id);

        //PERMISOS A CENTROS Y SECTORES
        $centros = SectorUsuario::where("id_usuario",$id)->groupBy("id_centro")->get();
        $sectors = SectorUsuario::where("id_usuario",$id)->groupBy("id_sector")->get();
        //FIN PERMISOS A CENTROS Y SECTOES

        return view('usuarios/modalview')->with("user", $user)->with("centros", $centros)->with("sectors", $sectors);
    }

    public function getEdit($id)
    {
        $user = User::findOrFail($id);
        $centrocostos = CentroCosto::orderBy("nombre", "ASC")->get();
        $sectors = Sector::orderBy("nombre", "ASC")->get();
        $permisos = Auth::user();
        $centros = SectorUsuario::where("id_usuario", $id)->groupBy("id_centro")->get();
        $oficinas = SectorUsuario::where("id_usuario", $id)->groupBy("id_sector")->get();
        return view('usuarios/edit')->with("user", $user)->with("centrocostos",$centrocostos)->with("sectors",$sectors)->with("permisos",$permisos)->with("centros",$centros)->with("oficinas",$oficinas);
    }

    public function postEdit(Request $request)
    {
        //mensajes de los validadores
        $messages = [
            'required'    => 'Debe ingresar el  :attribute',
            'email.required'    => 'Debe ingresar el  correo',
            'numeric' => 'El :attribute debe solo contener números',
            'unique' => '¡El :attribute ya existe!',
            'max' => 'El :attribute no debe exeder los :max caracteres',
            'min' => 'El :attribute debe tener minimo :min caracteres',
            'confirmed' => 'Debe ingresar las 2 contraseñas iguales',
            'email' => 'Debe ingresar un correo vaildo',
        ];
        //validador de los input del formulario
        $validator = Validator::make($request->all(), [
            'name'             => 'required|max:255',
            'apellido_paterno' => 'required|max:255',
            'apellido_materno' => 'required|max:255',
            'correo' => 'required|email|exists:users,email|max:255',
            'fono' => 'required|numeric|min:9',
            //'movil' => 'required|numeric|min:9',

            'centro' => 'required',
            'oficina' => 'required',
            'cargo' => 'required|max:255'
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

           $user = User::findOrFail($request->input("_id"));
           $user->name = strtoupper($request->input("name"));
           $user->apellido_paterno = strtoupper($request->input("apellido_paterno"));
           $user->apellido_materno = strtoupper($request->input("apellido_materno"));
           $user->email = strtoupper($request->input("correo"));
           //$user->password = Hash::make($request->input("password"));
           $user->fono = strtoupper($request->input("fono"));
           $user->movil = strtoupper($request->input("movil"));
           $user->departamento = "";
           $user->cargo = strtoupper($request->input("cargo"));
           $user->permisos = $request->permiso;
           $user->activo = $request->estado;
           $user->centro = $request->centro[0];
           $user->sector = $request->oficina[0];
           $user->save();

           $sectorusuarios = SectorUsuario::where("id_usuario",$request->input("_id"))->get();
           foreach ($sectorusuarios as $key => $sectorusuario) {
             $sectorusuario->delete();
           }
           $sectores = $request->oficina;

           //ARREGLO DE SECTORES Y OFICINA
           for($i=0; $i<count($sectores); $i++){
              $sector = Sector::find($sectores[$i]);
              $sectorusuario = new SectorUsuario();
              $sectorusuario->id_usuario = $user->id;
              $sectorusuario->id_centro  = $sector->id_centro_costo;
              $sectorusuario->id_sector  = $sector->id;
              $sectorusuario->save();
           }

           //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "editar";
           $logs->modulo = "USUARIOS";
           $logs->id_ref = $user->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se editó el USUARIO ".$user->name. " " . $user->apellido_paterno;
           $logs->save();

           return redirect("usuarios")->with('success', 'edit')->with("id_usuario", $request->input("_id"));
        }
    }

    public function getDelete($id)
    {
        $user = User::findOrFail($id);

        return view('usuarios/modaldelete')->with("user", $user);
    }

    public function postDelete(Request $request)
    {
        $user = User::findOrFail($request->input("_id"));

        //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "eliminar";
           $logs->modulo = "USUARIOS";
           $logs->id_ref = $user->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se eliminó el USUARIO ".$user->name. " " . $user->apellido_paterno;
           $logs->save();

        $user->delete();

        return redirect("usuarios")->with('success', 'delete')->with("id_usuario",$request->input("_id"));
    }

    public function getPermisos($id)
    {
        $user = User::findOrFail($id);
        $permits = Module::all();
        return view('Usuarios/permisos')->with("user", $user)->with("permits", $permits);
    }

    public function postPermisos(Request $request)
    {
        return redirect("usuarios");
    }
}