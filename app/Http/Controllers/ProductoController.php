<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto as Producto;
use Crypt;

class ProductoController extends Controller
{
    public function getIndex()
    {
        //$productos = Productos::all();
        return view('productos/index');
    }
    
    public function getAddproductos()
    {
        return view('test/productos/producto_add');
    }

    public function postCreate(Request $request)
    {
    	$producto = new Productos;
    	$producto->codigo = $request->input("codigo");
    	$producto->nombre = $request->input("nombre");
    	$producto->precio = $request->input("precio");
        $producto->descuento = $request->input("descuento");
    	$producto->marca = $request->input("marca");
        $producto->descripcion = $request->input("descripcion");
        $producto->peso = $request->input("peso");
        $producto->largo = $request->input("largo");
        $producto->alto = $request->input("alto");
        $producto->ancho = $request->input("ancho");

        $producto->save();
        
        if($request->file('inputFile')){
            $file = $request->file('inputFile');
            $producto->foto = $producto->id.".jpg";

            \Storage::put(
            'productos/'.$producto->id.".jpg",
            file_get_contents($request->file('inputFile')->getRealPath())
            );
        }
        else{
            $producto->foto = "defecto.jpg";
        }

    	$producto->save();

    	//return redirect('market#nav_productos')->withInput();

        //esto es para agregar una columna
        $html = view('market/productos/producto_tr')->with("producto",$producto);
        return $html;
    }

    public function getShow($id)
    {
        $producto = Productos::find($id);
        return view('market/productos/producto_view')->with("producto",$producto);
    }

    public function getEdit($id)
    {
        $producto = Productos::find($id);
        return view('market/productos/producto_edit')->with("producto",$producto);
    }

    public function postEdit(Request $request)
    {
        $id = $request->input('_producto');
        $producto = Productos::find($id);
        $producto->codigo = $request->input("codigo");
        $producto->nombre = $request->input("nombre");
        $producto->precio = $request->input("precio");
        $producto->descuento = $request->input("descuento");
        $producto->marca = $request->input("marca");
        $producto->descripcion = $request->input("descripcion");
        $producto->peso = $request->input("peso");
        $producto->largo = $request->input("largo");
        $producto->alto = $request->input("alto");
        $producto->ancho = $request->input("ancho");

        $producto->save();
        
        if($request->file('inputFile')){
            $file = $request->file('inputFile');
            $producto->foto = $producto->id.".jpg";

            \Storage::put(
            'productos/'.$producto->id.".jpg",
            file_get_contents($request->file('inputFile')->getRealPath())
            );
        }
        else{
            $producto->foto = "defecto.jpg";
        }

        $producto->save();
        
        $html = view('market/productos/producto_td')->with("producto",$producto);
        return $html;
    }

    public function getDelete($id)
    {
        $producto = Productos::find($id);
        $crypt =Crypt::encrypt($id);
        return view('market/productos/producto_delete')->with("producto",$producto)->with("crypt",$crypt);
    }

    public function postDelete(Request $request)
    {
        $id = Crypt::decrypt($request->input('crypt'));
        $producto = Productos::find($id);
        $producto->delete();

        return $id ;
    }

    public function getAll($id)
    {
        $producto = Productos::all();
    }

    public function getPrecio($id)
    {
        $producto = Productos::find($id);
        return $producto->precio;
    }


}
