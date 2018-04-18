<?php

namespace sistema\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use sistema\Articulo;
use sistema\Http\Requests\ArticuloFormRequest;
use sistema\Producto;

class ArticuloController extends Controller {
    public function index(Request $request) {
        if ($request) {
            $query     = trim($request->get('searchText'));
            $articulos = DB::table('t_articulo as a')
                ->join('t_producto', 't_producto_idt_producto', '=', 'idt_producto')
                ->select('a.*', 't_producto.nombre as productoNombre')
                ->where('a.Precio', 'LIKE', '%' . $query . '%')
                ->where('a.estado', '=', '1')
                ->orderBy('a.idt_articulo', 'desc')
                ->paginate(7);

            return view('compras.articulo.index', ["articulos" => $articulos, "searchText" => $query]);
        }

    }
    public function create() {
        $productos = DB::table('t_producto')->where('estado', '=', '1')->get();
        return view('compras.articulo.create', ["productos" => $productos]);
    }
    public function store(ArticuloFormRequest $request) {
        $articulo                          = new Articulo;
        $articulo->t_producto_idt_producto = $request->get('t_producto_idt_producto');
        $articulo->Precio                  = $request->get('Precio');
        $Producto                          = Producto::findOrFail($request->get('t_producto_idt_producto'));
        $RestaStock                        = $Producto->stock - $request->get('stock');
        if ($RestaStock < 0) {
            Session::flash('msg', 'Este producto no tiene suficiente stock');
            return Redirect::back();
        }
        $Producto->stock = $RestaStock;
        $Producto->update();
        $articulo->stock  = $request->get('stock');
        $articulo->estado = '1';
        $articulo->save();
        return Redirect::to('compras/articulo');

    }
    public function show($id) {
        return view("compras.articulo.show", ["articulo" => Articulo::findOrFail($id)]);
    }
    public function edit($id) {
        $productos = DB::table('t_producto')->where('estado', '=', '1')->get();
        return view("compras.articulo.edit", ["articulo" => Articulo::findOrFail($id), "productos" => $productos]);

    }
    public function update(ArticuloFormRequest $request, $id) {
        $articulo                          = Articulo::findOrFail($id);
        $articulo->t_producto_idt_producto = $request->get('t_producto_idt_producto');
        $articulo->Precio                  = $request->get('Precio');
        $Producto                          = Producto::findOrFail($request->get('t_producto_idt_producto'));
        $Producto->stock                   = $Producto->stock + $articulo->stock;

        $RestaStock = $Producto->stock - $request->get('stock');
        if ($RestaStock < 0) {
            Session::flash('msg', 'Este producto no tiene suficiente stock');
            return Redirect::back();
        }
        $Producto->stock = $RestaStock;
        $Producto->update();
        $articulo->stock  = $request->get('stock');
        $articulo->estado = '1';
        $articulo->update();
        return Redirect::to('compras/articulo');
    }
    public function destroy($id) {
        $articulo         = Articulo::findOrFail($id);
        $articulo->estado = '0';
        $Producto         = Producto::findOrFail($articulo->t_producto_idt_producto);
        $Producto->stock  = $Producto->stock + $articulo->stock;
        $Producto->update();
        $articulo->update();
        return Redirect::to('compras/articulo');
    }
}
