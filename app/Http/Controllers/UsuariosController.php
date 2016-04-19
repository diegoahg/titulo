<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\User;
use Crypt;

class UsuariosController extends Controller
{
    /**
     * Responds to requests to GET /users
     */
    public function getIndex()
    {
        $users = User::all();
        return view('usuarios/index')->with("users", $users);
    }

    public function getAdd()
    {
        return view('usuarios/add');
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
            'movil' => 'required|numeric|min:9',
            'cargo' => 'required|max:255'
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

           $user = new User();
           $user->name = $request->input("name");
           $user->apellido_paterno = $request->input("apellido_paterno");
           $user->apellido_materno = $request->input("apellido_materno");
           $user->email = $request->input("correo");
           $user->password = $request->input("password");
           $user->fono = $request->input("fono");
           $user->movil = $request->input("movil");
           $user->departamento = $request->input("departamento");
           $user->cargo = $request->input("cargo");
           $user->save();

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
        return view('Usuarios/modalview')->with("user", $user);
    }

    public function getEdit($id)
    {
        $user = User::findOrFail($id);
        return view('Usuarios/edit')->with("user", $user);
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
            'password' => 'required|max:255|confirmed',
            'password_confirmation ' => 'confirmed',
            'fono' => 'required|numeric|min:9',
            'movil' => 'required|numeric|min:9',
            'cargo' => 'required|max:255'
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

           $user = User::findOrFail($request->input("_id"));
           $user->name = $request->input("name");
           $user->apellido_paterno = $request->input("apellido_paterno");
           $user->apellido_materno = $request->input("apellido_materno");
           $user->email = $request->input("correo");
           $user->password = $request->input("password");
           $user->fono = $request->input("fono");
           $user->movil = $request->input("movil");
           $user->departamento = $request->input("departamento");
           $user->cargo = $request->input("cargo");
           $user->save();

           return redirect("usuarios")->with('success', 'edit')->with("id_usuario", $request->input("_id"));
        }
    }

    public function getDelete($id)
    {
        $user = User::findOrFail($id);

        return view('Usuarios/modaldelete')->with("user", $user);
    }

    public function postDelete(Request $request)
    {
        $user = User::findOrFail($request->input("_id"));
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