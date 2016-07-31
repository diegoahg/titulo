<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use Hash;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use App\Http\Controllers\Controller;
use App\User as User;
use Crypt;
use Validator;
use Mail;

class LoginController extends Controller
{

    public function getIndex()
    {
        if(Auth::check()){
            return redirect()->intended('market');
        }

        return view('login');
    }

    public function postAcceder(Request $request){
    

        $data = array(
            'email' => $request->email,
            'password' => $request->contraseña);

        if (Auth::attempt($data)) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        else{
        echo "datos incorrectos";
        return $data;
        }
    }

    public function getCorreo(){
        return view('correo');
    }

    public function getRecuperarClave($id,$token){
        return view('recuperar')->with("id",$id);
    }

    public function postRecuperar(Request $request){

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
            'password' => 'required|max:255|confirmed',
            'password_confirmation ' => 'confirmed',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{
        $user = User::find($request->_key);
        $user->password = Hash::make($request->password);
        $user->save();

            $data = array(
                'email' => $user->email,
                'password' => $request->password);


            if (Auth::attempt($data)) {
                // Authentication passed...
                return redirect()->intended('/');
            }
            else{
            echo "datos incorrectos";
            return $data;
            }
        }
    }

     public function postCorreo(Request $request){

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
            'email' => 'email',
        ], $messages);

        $user = User::where("email", $request->email)->first();

        $data = array( "email" => $request->email,
                        "usuario" => $user->name,
                        "id"=> $user->id,
                        "token" => 1);
        Mail::send('email', ["data" => $data], function ($m) use ($data){
            $m->from('admin@utem.cl', 'UTEM INVENTARIO');

            $m->to("diego.hernandez@ceinf.cl", "DIEGO")->subject('Cambiar Contraseña');
        });

        return "Mensaje Enviado con Exito";
    }

    public function getLogout(){
        Auth::logout();
        return Redirect::to('login');
    }
}
