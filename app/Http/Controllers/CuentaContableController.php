<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\CuentaContable;
use App\Logs as Logs;
use Auth;

class CuentaContableController extends Controller
{
    /**
     * Responds to requests to GET /users
     */
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getIndex()
    {
        $cuentacontables = CuentaContable::all();
        return view('cuentacontable/index')->with("cuentacontables", $cuentacontables);
    }

    public function getAdd()
    {
        return view('cuentacontable/add');
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
            'codigo'  => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $cuentacontable = new CuentaContable;
            $cuentacontable->codigo = strtoupper($request->codigo);
            $cuentacontable->nombre = strtoupper($request->nombre);
            $cuentacontable->vida_util = strtoupper($request->vida_util);
            $cuentacontable->save();

            //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "agregar";
           $logs->modulo = "CUENTACONTABLE";
           $logs->id_ref = $cuentacontable->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se agrego el CuentaContable ".$cuentacontable->nombre;
           $logs->save();


            return redirect("cuentacontable")->with('success', 'add');
        }
    }

    public function getEdit($id)
    {
        $cuentacontable = CuentaContable::find($id);
        return view('cuentacontable/edit')->with("cuentacontable",$cuentacontable);
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
            'codigo'  => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $cuentacontable = CuentaContable::find($request->input("_id"));
            $cuentacontable->codigo = strtoupper($request->codigo);
            $cuentacontable->nombre = strtoupper($request->nombre);
            $cuentacontable->vida_util = strtoupper($request->vida_util);
            $cuentacontable->save();

            //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "editar";
           $logs->modulo = "CUENTACONTABLE";
           $logs->id_ref = $cuentacontable->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se editó el CUENTACONTABLE ".$cuentacontable->nombre;
           $logs->save();

            return redirect("cuentacontable")->with('success', 'edit');
        }
    }

    public function getDelete($id)
    {
        $cuentacontable = CuentaContable::findOrFail($id);

        return view('cuentacontable/modaldelete')->with("cuentacontable", $cuentacontable);

    }

    public function postDelete(Request $request)
    {
        $cuentacontable = CuentaContable::findOrFail($request->input("_id"));
        //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "eliminar";
           $logs->modulo = "CUENTACONTABLE";
           $logs->id_ref = $cuentacontable->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se eliminó el CUENTACONTABLE ".$cuentacontable->nombre;
           $logs->save();

        $cuentacontable->delete();

        return redirect("cuentacontable")->with('success', 'delete');
    }
}
