<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Categoria as Categoria;
use Crypt;

class CategoriasController extends Controller
{
    /**
     * Responds to requests to GET /users
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $categorias = Categoria::all();
        return view('categorias/index')->with("categorias", $categorias);
    }

    public function getAdd()
    {
        return view('categorias/add');
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
            'codigo'  => 'required|max:1',
            'categoria'  => 'required|max:255',
            'descripcion' => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $categoria = new Categoria;
            $categoria->codigo = $request->input("codigo");
            $categoria->categoria = $request->input("categoria");
            $categoria->descripcion = $request->input("descripcion");
            $categoria->save();

            //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "agregar";
           $logs->modulo = "CATEGORIA";
           $logs->id_ref = $categoria->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se agregó el CATEGORIA ".$categoria->descripcion;
           $logs->save();


            return redirect("categorias")->with('success', 'add')->with("id_categoria", $categoria->id);
        }
    }

    public function getEdit($id)
    {
        $categoria = Categoria::find($id);
        return view('categorias/edit')->with("categoria",$categoria);
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
            'codigo'  => 'required|max:1',
            'categoria'  => 'required|max:255',
            'descripcion' => 'required|max:255',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $categoria = Categoria::find($request->input("_id"));
            $categoria->codigo = $request->input("codigo");
            $categoria->categoria = $request->input("categoria");
            $categoria->descripcion = $request->input("descripcion");
            $categoria->save();

            //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "editar";
           $logs->modulo = "CATEGORIA";
           $logs->id_ref = $categoria->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se editó el CATEGORIA ".$categoria->descripcion;
           $logs->save();

            return redirect("categorias")->with('success', 'edit')->with("id_categoria", $categoria->id);
        }
    }

    public function getDelete($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categorias/modaldelete')->with("categoria", $categoria);

    }

    public function postDelete(Request $request)
    {

        $categoria = Categoria::findOrFail($request->input("_id"));

        //Registro de logs
           $logs = new Logs();
           $logs->fecha =  date("Y-m-d H:m:s");
           $logs->accion = "eliminar";
           $logs->modulo = "CATEGORIA";
           $logs->id_ref = $categoria->id;
           $logs->id_user = Auth::user()->id;
           $logs->detalle = "Se eliminó el CATEGORIA ".$categoria->descripcion;
           $logs->save();

        $categoria->delete();

        return redirect("categorias")->with('success', 'delete')->with("id_categoria",$request->input("_id"));
    }
}