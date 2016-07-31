<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\CentroCosto;
use App\Sector;

class SectorController extends Controller
{
    /**
     * Responds to requests to GET /users
     */
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getIndex()
    {
        $sectores = Sector::all();
        return view('sector/index')->with("sectores", $sectores);
    }

    public function getAdd()
    {
        $centrocostos = CentroCosto::all();
        return view('sector/add')->with("centrocostos", $centrocostos);
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
            'centro'  => 'required|max:255',
            'descripcion'  => 'required|max:255',
            'codigo'  => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $sector = new Sector;
            $sector->nombre = $request->nombre;
            $sector->id_centro_costo = $request->centro;
            $sector->codigo = $request->codigo;
            $sector->descripcion = $request->descripcion;
            $sector->save();

            return redirect("sector")->with('success', 'add');
        }
    }

    public function getEdit($id)
    {
        $centrocostos = CentroCosto::all();
        $sector = Sector::find($id);
        return view('sector/edit')->with("centrocostos",$centrocostos)->with("sector",$sector);
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
            'centro'  => 'required|max:255',
            'descripcion'  => 'required|max:255',
            'codigo'  => 'required|max:255',
        ], $messages);
        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $sector = Sector::find($request->_id);
            $sector->nombre = $request->nombre;
            $sector->codigo = $request->codigo;
            $sector->descripcion = $request->descripcion;
            $sector->id_centro_costo = $request->centro;
            $sector->save();

            return redirect("sector")->with('success', 'edit');
        }
    }

    public function getDelete($id)
    {
        $sector = Sector::findOrFail($id);

        return view('sector/modaldelete')->with("sector", $sector);

    }

    public function postDelete(Request $request)
    {
        $sector = Sector::findOrFail($request->input("_id"));
        $sector->delete();

        return redirect("sector")->with('success', 'delete');
    }
}
