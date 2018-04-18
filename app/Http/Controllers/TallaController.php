<?php

namespace sistema\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use sistema\Http\Requests\TallaFormRequest;
use sistema\Talla;

class TallaController extends Controller {
    public function __construct() {

    }
    public function index(Request $request) {
        if ($request) {
            $query  = trim($request->get('searchText'));
            $tallas = DB::table('t_talla')->where('nombre', 'LIKE', '%' . $query . '%')
                ->where('estado', '=', '1')
                ->orderBy('idt_talla', 'desc')
                ->paginate(10);
            return view('almacen.talla.index', ["tallas" => $tallas, "searchText" => $query]);
        }

    }
    public function create() {
        return view("almacen.talla.create");
    }
    public function store(TallaFormRequest $request) {
        $talla         = new Talla;
        $talla->nombre = $request->get('nombre');

        $BusquedaTalla = DB::table('t_talla')->where('nombre', '=', $request->get('nombre'))->where('estado', '=', '1')->first();
        if ($BusquedaTalla != null) {
            Session::flash('msg', 'Esta Talla ya esta Creada');
            return Redirect::back();
        }
        $talla->estado = '1';
        $talla->save();
        return Redirect::to('almacen/talla');

    }
    public function show($id) {
        return view("almacen.talla.show", ["talla" => Talla::findOrFail($id)]);
    }
    public function edit($id) {
        return view("almacen.talla.edit", ["talla" => Talla::findOrFail($id)]);

    }
    public function update(TallaFormRequest $request, $id) {
        $talla         = Talla::findOrFail($id);
        $talla->nombre = $request->get('nombre');
        $BusquedaTalla = DB::table('t_talla')->where('nombre', '=', $request->get('nombre'))->where('estado', '=', '1')->first();
        if ($BusquedaTalla != null && $BusquedaTalla->idt_talla != $id) {
            Session::flash('msg', 'Esta Talla ya esta Creada');
            return Redirect::back();
        }
        $talla->update();
        return Redirect::to('almacen/talla');
    }
    public function destroy($id) {
        $talla         = Talla::findOrFail($id);
        $talla->estado = '0';
        $talla->update();
        return Redirect::to('almacen/talla');
    }
}
