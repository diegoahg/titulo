<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\CentroCosto;
use App\Logs as Logs;
use Auth;

class CentroCostoController extends Controller
{
    /**
     * Responds to requests to GET /users
     */
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getIndex()
    {
        $centrocostos = CentroCosto::all();
        return view('centrocosto/index')->with("centrocostos", $centrocostos);
    }

    public function getAdd()
    {
        return view('centrocosto/add');
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
            'nombre'  => 'required|max:255',
            'descripcion'  => 'required|max:255',
            'codigo'  => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $centrocosto = new CentroCosto;
            $centrocosto->codigo = $request->codigo;
            $centrocosto->nombre = $request->nombre;
            $centrocosto->descripcion = $request->descripcion;
            $centrocosto->direccion = $request->direccion;
            $centrocosto->save();

            //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "agregar";
           $logs->modulo = "CENTROCOSTO";
           $logs->id_ref = $centrocosto->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se agrego el CENTROCOSTO ".$centrocosto->descripcion;
           $logs->save();


            return redirect("centrocosto")->with('success', 'add');
        }
    }

    public function getEdit($id)
    {
        $centrocosto = CentroCosto::find($id);
        return view('centrocosto/edit')->with("centrocosto",$centrocosto);
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
            'nombre'  => 'required|max:255',
            'descripcion'  => 'required|max:255',
            'codigo'  => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $centrocosto = CentroCosto::find($request->input("_id"));
            $centrocosto->codigo = $request->codigo;
            $centrocosto->nombre = $request->nombre;
            $centrocosto->descripcion = $request->descripcion;
            $centrocosto->direccion = $request->direccion;
            $centrocosto->save();

            //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "editar";
           $logs->modulo = "CENTROCOSTO";
           $logs->id_ref = $centrocosto->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se editó el CENTROCOSTO ".$centrocosto->descripcion;
           $logs->save();

            return redirect("centrocosto")->with('success', 'edit');
        }
    }

    public function getDelete($id)
    {
        $centrocosto = CentroCosto::findOrFail($id);

        return view('centrocosto/modaldelete')->with("centrocosto", $centrocosto);

    }

    public function postDelete(Request $request)
    {
        $centrocosto = CentroCosto::findOrFail($request->input("_id"));
        //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "eliminar";
           $logs->modulo = "CENTROCOSTO";
           $logs->id_ref = $centrocosto->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se eliminó el CENTROCOSTO ".$centrocosto->descripcion;
           $logs->save();

        $centrocosto->delete();

        return redirect("centrocosto")->with('success', 'delete');
    }
}
