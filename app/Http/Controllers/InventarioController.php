<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario as Inventario;
use App\Productos as Productos;
use Crypt;

class InventarioController extends Controller
{
    /**
     * Responds to requests to GET /users
     */
    public function getIndex()
    {
        $dataInventario = Inventario::all();
        $productos = Productos::all();
        $inventario = [];

        foreach ($dataInventario as $inv)
            {
                $dataProducto = Productos::find($inv->id_producto);
                
                $data = array(
                    'id' => $inv->id,
                    'codigo' => $dataProducto->codigo, 
                    'producto' => $dataProducto->nombre,
                    'cantidad' => $inv->cantidad,
                    'factura' => $inv->factura,
                    'precio' => $dataProducto->precio,
                    'total' => ($dataProducto->precio)*($inv->cantidad));

                array_push($inventario, $data);
            }

        return view('market/inventario/inventario_main')->with("inventario", $inventario)->with('productos', $productos);
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