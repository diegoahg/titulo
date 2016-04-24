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
        //var_dump($request);
        /*$usuarios = User::all();

        foreach ($usuarios as $usuario) {
            if($usuario->name == $request['usuario'] && $usuario->password == $request['contraseña']){
                return Redirect::to('market');
            }
        }

        return Redirect::to('login');
        */

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

    public function postCreate(loginRequest $request){
        $usuario = new User;
        $usuario->name = $request->usuario;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->contraseña);
        $usuario->save();
        return Redirect::to('login');
    }

    public function getLogout(){
        Auth::logout();
        return Redirect::to('login');
    }
}
