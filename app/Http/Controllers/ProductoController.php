<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Producto;
use Crypt;
use File;
use Image;

class ProductoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getIndex()
    {
        $productos = Producto::all();
        return view('productos/index')->with("productos",$productos);
    }
    
    public function getAdd()
    {
        return view('productos/add');
    }

    public function postAdd(Request $request)
    {
    	//mensajes de los validadores
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
            'codigo'  => 'required|max:255',
            'nombre'  => 'required|max:255',
            'descripcion' => 'required|max:255',
            'precio'  => 'required|numeric|integer',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $producto = new Producto;
        	$producto->codigo = $request->input("codigo");
        	$producto->nombre = $request->input("nombre");
        	$producto->precio = $request->input("precio");
            $producto->categoria = $request->input("categoria");
        	$producto->marca = $request->input("marca");
            $producto->modelo = $request->input("modelo");
            $producto->serie = $request->input("serie");
            $producto->descripcion = $request->input("descripcion");
            $producto->peso = $request->input("peso");
            $producto->largo = $request->input("largo");
            $producto->alto = $request->input("alto");
            $producto->ancho = $request->input("ancho");

            $producto->save();
            
             if($request->file('inputfile')){
                $file = $request->file('inputfile');
                $producto->imagen = $producto->id.".jpg";
                $path = storage_path('app/productos/' . $producto->imagen);
                Image::make($file->getRealPath())->resize(400, 300)->save($path);
            }
            else{
                $producto->imagen = "default.jpg";
            }

        	$producto->save();

            return redirect("productos")->with('success', 'add')->with("id_producto", $producto->id);
        }
    }

    public function getView($id)
    {
        $producto = Producto::findOrFail($id);
        return view('Productos/modalview')->with("producto", $producto);
    }

    public function getEdit($id)
    {
        $producto = Producto::find($id);
        return view('Productos/edit')->with("producto",$producto);
    }

    public function postEdit(Request $request)
    {
        //mensajes de los validadores
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
            'codigo'  => 'required|max:255',
            'nombre'  => 'required|max:255',
            'descripcion' => 'required|max:255',
            'precio'  => 'required|numeric|integer',
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            //echo "hola";
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{

            $producto = Producto::find($request->input("_id"));
            $producto->codigo = $request->input("codigo");
            $producto->nombre = $request->input("nombre");
            $producto->precio = $request->input("precio");
            $producto->categoria = $request->input("categoria");
            $producto->marca = $request->input("marca");
            $producto->modelo = $request->input("modelo");
            $producto->serie = $request->input("serie");
            $producto->descripcion = $request->input("descripcion");
            $producto->peso = $request->input("peso");
            $producto->largo = $request->input("largo");
            $producto->alto = $request->input("alto");
            $producto->ancho = $request->input("ancho");

            $producto->save();
            
             if($request->file('inputfile')){
                $file = $request->file('inputfile');
                $producto->imagen = $producto->id.".jpg";
                $path = storage_path('app/productos/' . $producto->imagen);
                Image::make($file->getRealPath())->resize(400, 300)->save($path);
            }

            $producto->save();

            return redirect("productos")->with('success', 'add')->with("id_producto", $producto->id);
        }
    }

    public function getDelete($id)
    {
        $producto = Producto::find($id);
        return view('productos/modaldelete')->with("producto",$producto);
    }

    public function postDelete(Request $request)
    {
        $id = $request->input('_id');
        $producto = Producto::find($id);
        $producto->delete();

        return redirect("productos")->with('success', 'delete')->with("id_producto", $producto->id);
    }

    public function getProductImage($image)
    {
        if(!File::exists( $image=storage_path("app/productos/".$image) )) abort(404);

        return Image::make($image)->response('jpg'); //will ensure a jpg is always returned
    }


}
