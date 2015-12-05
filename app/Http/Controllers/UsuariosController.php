<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
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

    public function postCreate(Request $request)
    {
        $inventario = new Inventario;
        $inventario->id_producto = $request->input("id_producto");
        $inventario->cantidad = $request->input("cantidad");
        $inventario->factura = $request->input("factura");
        $inventario->save();

        $producto = Productos::find($inventario->id_producto);

        $html = view('market/inventario/inventario_tr')->with("inventario", $inventario)->with('producto', $producto);
        return $html;
    }

    public function getEdit($id)
    {
        $inventario = Inventario::find($id);
        $productos = Productos::all();
        return view('market/inventario/inventario_edit')->with("inventario",$inventario)->with("productos",$productos);
    }

    public function postEdit(Request $request)
    {
        $id = $request->input('_inventario');
        $inventario = Inventario::find($id);
        $inventario->id_producto = $request->input('id_producto');
        $inventario->cantidad = $request->input("cantidad");
        $inventario->factura = $request->input("factura");
        $inventario->save();

        //return redirect('market#nav_proveedores')->withInput();
    }

    public function getShow($id)
    {
        $inventario = Inventario::find($id);
        $producto = Productos::find($inventario->id_producto);
        //$productos = Productos::where("id","=",$inventario->id_producto);
        return view('market/inventario/inventario_view')->with("producto",$producto)->with("inventario",$inventario);
    }

    public function getDelete($id)
    {
        $inventario = Inventario::find($id);
        $crypt =Crypt::encrypt($id);
        return view('market/inventario/inventario_delete')->with("crypt",$crypt);
    }

    public function postDelete(Request $request)
    {
        $id = Crypt::decrypt($request->input('crypt'));
        $inventario = Inventario::find($id);
        $inventario->delete();

        return $id;
        //$html = view('market/proveedores/proveedor_tr')->with("proveedor", $proveedor);
        //return $html;
    }
}