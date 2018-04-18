<?php

namespace sistema\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use sistema\Categoria;
use sistema\Http\Requests\CategoriaFormRequest;

class CategoriaController extends Controller {
    public function __construct() {

    }
    public function index(Request $request) {
        if ($request) {
            $query      = trim($request->get('searchText'));
            $categorias = DB::table('t_categoria')->where('nombre', 'LIKE', '%' . $query . '%')
                ->where('estado', '=', '1')
                ->orderBy('idt_categoria', 'desc')
                ->paginate(7);
            return view('almacen.categoria.index', ["categorias" => $categorias, "searchText" => $query]);
        }

    }

    public function create() {
        return view("almacen.categoria.create");
    }
    public function store(CategoriaFormRequest $request) {
        $categoria         = new Categoria;
        $categoria->nombre = $request->get('nombre');
        $categoria->estado = '1';
        $BusquedaCategoria = DB::table('t_categoria')->where('nombre', '=', $request->get('nombre'))->where('estado', '=', '1')->first();
        if ($BusquedaCategoria != null) {
            Session::flash('msg', 'Esta Categoria ya esta Creada');
            return Redirect::back();
        }

        $categoria->save();
        return Redirect::to('almacen/categoria');

    }
    public function show($id) {
        return view("almacen.categoria.show", ["categoria" => Categoria::findOrFail($id)]);
    }
    public function edit($id) {
        return view("almacen.categoria.edit", ["categoria" => Categoria::findOrFail($id)]);

    }
    public function update(CategoriaFormRequest $request, $id) {
        $categoria         = Categoria::findOrFail($id);
        $categoria->nombre = $request->get('nombre');
        $BusquedaCategoria = DB::table('t_categoria')->where('nombre', '=', $request->get('nombre'))->where('estado', '=', '1')->first();
        if ($BusquedaCategoria != null && $BusquedaCategoria->idt_categoria != $id) {
            Session::flash('msg', 'Esta Categoria ya esta Creada');
            return Redirect::back();
        }

        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
    public function destroy($id) {
        $categoria         = Categoria::findOrFail($id);
        $categoria->estado = '0';
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }

}
