<?php

namespace sistema\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use sistema\Color;
use sistema\Http\Requests\ColorFormRequest;

class ColorController extends Controller {
    public function __construct() {

    }
    public function index(Request $request) {
        if ($request) {
            $query   = trim($request->get('searchText'));
            $colores = DB::table('t_color')->where('nombre', 'LIKE', '%' . $query . '%')
                ->where('estado', '=', '1')
                ->orderBy('idt_color', 'desc')
                ->paginate(7);
            return view('almacen.color.index', ["colores" => $colores, "searchText" => $query]);
        }

    }
    public function create() {
        return view("almacen.color.create");
    }
    public function store(ColorFormRequest $request) {
        $color         = new Color;
        $color->nombre = $request->get('nombre');
        $color->color  = $request->get('color');
        $color->estado = '1';

        $BusquedaColor = DB::table('t_color')->where('nombre', '=', $request->get('nombre'))->where('estado', '=', '1')->first();
        if ($BusquedaColor != null) {
            Session::flash('msg', 'Este Color ya esta Creado');
            return Redirect::back();
        }
        $color->save();
        return Redirect::to('almacen/color');

    }
    public function show($id) {
        return view("almacen.color.show", ["color" => Color::findOrFail($id)]);
    }
    public function edit($id) {
        return view("almacen.color.edit", ["color" => Color::findOrFail($id)]);

    }
    public function update(ColorFormRequest $request, $id) {
        $color         = Color::findOrFail($id);
        $color->nombre = $request->get('nombre');
        $color->color  = $request->get('color');
        $BusquedaColor = DB::table('t_color')->where('nombre', '=', $request->get('nombre'))->where('estado', '=', '1')->first();
        if ($BusquedaColor != null && $BusquedaColor->idt_color != $id) {
            Session::flash('msg', 'Este Color ya esta Creado');
            return Redirect::back();
        }
        $color->update();
        return Redirect::to('almacen/color');
    }
    public function destroy($id) {
        $color         = Color::findOrFail($id);
        $color->estado = '0';
        $color->update();
        return Redirect::to('almacen/color');
    }
}
