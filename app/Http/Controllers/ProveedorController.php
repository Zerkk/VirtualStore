<?php

namespace sistema\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sistema\Proveedor;

class ProveedorController extends Controller {
    public function __construct() {

    }
    public function index(Request $request) {
        if ($request) {
            $query       = trim($request->get('searchText'));
            $Proveedores = DB::table('t_provedores')->where('nombre', 'LIKE', '%' . $query . '%')
                ->where('estado', '=', '1')
                ->orderBy('idt_provedores', 'desc')
                ->paginate(10);
            return view('compras.proveedor.index', ["Proveedores" => $Proveedores, "searchText" => $query]);
        }

    }
    public function create() {
        return view("compras.proveedor.create");
    }
    public function store(request $request) {
        $this->validate($request, ['nombre' => 'required',
            'tipo_documento'                    => 'required',
            'num_documento'                     => 'required',
            'direccion'                         => 'required',
            'telefono'                          => 'required',
            'correo'                            => 'required']);

        $Proveedor                 = new Proveedor;
        $Proveedor->nombre         = $request->nombre;
        $Proveedor->tipo_documento = $request->tipo_documento;
        if ($request->tipo_documento == 'Cedula') {
            $this->validate($request, [
                'num_documento' => 'ecuador:ci',
            ]);

        } else {
            if ($request->tipo_documento == 'Ruc') {
                $this->validate($request, [
                    'num_documento' => 'ecuador:ruc',
                ]);
            }

        }
        $Proveedor->num_documento = $request->num_documento;
        $Proveedor->direccion     = $request->direccion;
        $Proveedor->telefono      = $request->telefono;
        $Proveedor->correo        = $request->correo;
        $Proveedor->estado        = '1';
        $Proveedor->save();
        return Redirect::to('compras/proveedor');

    }
    public function show($id) {
        return view("compras.proveedor.show", ["proveedor" => Proveedor::findOrFail($id)]);
    }
    public function edit($id) {
        return view("compras.proveedor.edit", ["proveedor" => Proveedor::findOrFail($id)]);

    }
    public function update(Request $request, $id) {
        $this->validate($request, ['nombre' => 'required',
            'tipo_documento'                    => 'required',
            'num_documento'                     => 'required',
            'direccion'                         => 'required',
            'telefono'                          => 'required',
            'correo'                            => 'required']);
        $Proveedor                 = Proveedor::findOrFail($id);
        $Proveedor->nombre         = $request->nombre;
        $Proveedor->tipo_documento = $request->tipo_documento;
        if ($request->tipo_documento == 'Cedula') {
            $this->validate($request, [
                'num_documento' => 'ecuador:ci',
            ]);

        } else {
            if ($request->tipo_documento == 'Ruc') {
                $this->validate($request, [
                    'num_documento' => 'ecuador:ruc',
                ]);
            }

        }
        $Proveedor->num_documento = $request->num_documento;
        $Proveedor->direccion     = $request->direccion;
        $Proveedor->telefono      = $request->telefono;
        $Proveedor->correo        = $request->correo;

        $Proveedor->update();
        return Redirect::to('compras/proveedor');
    }
    public function destroy($id) {
        $Proveedor         = Proveedor::findOrFail($id);
        $Proveedor->estado = '0';
        $Proveedor->update();
        return Redirect::to('compras/proveedor');
    }
}
