<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\CentroCosto;

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
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $centrocosto = new CentroCosto;
            $centrocosto->nombre = $request->input("nombre");
            $centrocosto->save();

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
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $centrocosto = CentroCosto::find($request->input("_id"));
            $centrocosto->nombre = $request->input("nombre");
            $centrocosto->save();

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
        $centrocosto->delete();

        return redirect("centrocosto")->with('success', 'delete');
    }
}
