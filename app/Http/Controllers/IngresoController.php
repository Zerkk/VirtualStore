<?php

namespace sistema\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sistema\Http\Requests\IngresoFormRequest;
use sistema\Ingreso;
use sistema\IngresoDetalle;
use sistema\Producto;

class IngresoController extends Controller {
    public function __construct() {

    }
    public function index(Request $request) {
        if ($request) {
            $query    = trim($request->get('searchText'));
            $Ingresos = DB::table('t_ingreso')->where('num_comprobante', 'LIKE', '%' . $query . '%')
                ->where('estado', '=', '1')
                ->orderBy('idt_ingreso', 'desc')
                ->paginate(10);
            return view('compras.ingreso.index', ["Ingresos" => $Ingresos, "searchText" => $query]);
        }

    }
    public function create() {
        $proveedores = DB::table('t_provedores as a')->where('a.estado', '=', '1')->get();
        $productos   = DB::table('t_producto as b')->where('b.estado', '=', '1')->get();

        return view("compras.ingreso.create", ["proveedores" => $proveedores, "productos" => $productos]);
    }
    public function store(IngresoFormRequest $request) {

        $Ingreso                              = new Ingreso;
        $Ingreso->tipo_comprobante            = $request->tipo_comprobante;
        $Ingreso->num_comprobante             = $request->num_comprobante;
        $Ingreso->fecha                       = $request->fecha;
        $Ingreso->impuesto                    = $request->impuesto;
        $Ingreso->Suma_precioCompra           = '0';
        $Ingreso->t_provedores_idt_provedores = $request->idProveedor;

        $BuscarIngreso = DB::table('t_ingreso')->where('num_comprobante', '=', $request->get('num_comprobante'))->where('estado', '=', '1')->first();
        if ($BuscarIngreso != null) {
            Session::flash('msg', 'Este Ingreso ya esta Creado');
            return Redirect::back();
        }

        $Ingreso->estado = '1';
        $Ingreso->save();
        $BuscarIngresos = DB::table('t_ingreso as b')->where('b.num_comprobante', '=', $Ingreso->num_comprobante)->where('b.estado', '=', '1')->first();
        if ($BuscarIngresos != null) {
            $ArrayDetalleDatos = json_decode($request->arrayDetalle);
            foreach ($ArrayDetalleDatos as $arrayDetKey) {

                $arraySplit                        = explode('%', $arrayDetKey, 4);
                $idt_producto                      = $arraySplit[0];
                $cantidad                          = $arraySplit[1];
                $PrecioCompra                      = $arraySplit[2];
                $PrecioTotalCompra                 = $arraySplit[3];
                $IngresoDetalle                    = new IngresoDetalle; //crea una fila en la tabla CatalogoCategoria
                $IngresoDetalle->cantidad          = $cantidad;
                $IngresoDetalle->PrecioCompra      = $PrecioCompra;
                $IngresoDetalle->PrecioTotalCompra = $PrecioTotalCompra;
                $IngresoSuma                       = Ingreso::findOrFail($BuscarIngresos->idt_ingreso);
                $IngresoSuma->Suma_precioCompra    = $PrecioTotalCompra + $IngresoSuma->Suma_precioCompra;
                $IngresoSuma->update();
                $IngresoDetalle->t_producto_idt_producto = $idt_producto;
                $IngresoDetalle->t_ingreso_idt_ingreso   = $BuscarIngresos->idt_ingreso;
                $IngresoDetalle->estado                  = '1';
                $IngresoDetalle->save();
                $ProductoE        = Producto::findOrFail($idt_producto);
                $stock            = $ProductoE->stock;
                $ProductoE->stock = $stock + $IngresoDetalle->cantidad;
                $ProductoE->update();
            }
        }
        return Redirect::to('compras/ingreso');

    }
    public function show($id) {
        return view("compras.proveedor.show", ["proveedor" => Proveedor::findOrFail($id)]);
    }
    public function edit($id) {
        $proveedores    = DB::table('t_provedores as a')->where('a.estado', '=', '1')->get();
        $productos      = DB::table('t_producto as b')->where('b.estado', '=', '1')->get();
        $ingresoDetalle = DB::table('t_ingresodetalle as c')->join('t_producto', 't_producto_idt_producto', '=', 'idt_producto')->select('c.*', 't_producto.nombre as productoNombre')->where('c.t_ingreso_idt_ingreso', '=', $id)->where('c.estado', '=', '1')->get();
        $ingreso        = Ingreso::findOrFail($id);

        return view("compras.ingreso.edit", ["proveedores" => $proveedores, "productos" => $productos, "ingreso" => $ingreso, "ingresoDetalle" => $ingresoDetalle]);

    }
    public function update(IngresoFormRequest $request) {

        $Ingreso                              = Ingreso::findOrFail($request->id);
        $Ingreso->tipo_comprobante            = $request->tipo_comprobante;
        $Ingreso->num_comprobante             = $request->num_comprobante;
        $Ingreso->fecha                       = $request->fecha;
        $Ingreso->impuesto                    = $request->impuesto;
        $Ingreso->Suma_precioCompra           = '0';
        $Ingreso->t_provedores_idt_provedores = $request->idProveedor;
        $Ingreso->estado                      = '1';
        $BusquedaIngreso                      = DB::table('t_ingreso')->where('num_comprobante', '=', $request->get('num_comprobante'))->where('estado', '=', '1')->first();
        if ($BusquedaIngreso != null && $BusquedaIngreso->idt_ingreso != $request->id) {
            Session::flash('msg', 'Este Ingreso ya esta Creado');
            return Redirect::back();
        }
        $Ingreso->update();

        $ingresoDetalle = DB::table('t_ingresodetalle as a')->where('a.t_ingreso_idt_ingreso', '=', $request->id)->where('a.estado', '=', '1')->get();
        foreach ($ingresoDetalle as $keyIngresoDetalle) {
            $ingresoDetalleBorrar         = IngresoDetalle::findOrFail($keyIngresoDetalle->idt_ingresoDetalle);
            $ingresoDetalleBorrar->estado = '0';
            $ingresoDetalleBorrar->update();

            $ProductoE        = Producto::findOrFail($ingresoDetalleBorrar->t_producto_idt_producto);
            $stock            = $ProductoE->stock;
            $ProductoE->stock = $stock - $ingresoDetalleBorrar->cantidad;
            $ProductoE->update();

        }
        $ArrayDetalleDatos = json_decode($request->arrayDetalle);
        foreach ($ArrayDetalleDatos as $arrayDetKey) {

            $arraySplit        = explode('%', $arrayDetKey, 4);
            $idt_producto      = $arraySplit[0];
            $cantidad          = $arraySplit[1];
            $PrecioCompra      = $arraySplit[2];
            $PrecioTotalCompra = $arraySplit[3];

            $IngresoDetalle                          = new IngresoDetalle; //crea una fila en la tabla CatalogoCategoria
            $IngresoDetalle->cantidad                = $cantidad;
            $IngresoDetalle->PrecioCompra            = $PrecioCompra;
            $IngresoDetalle->PrecioTotalCompra       = $PrecioTotalCompra;
            $IngresoDetalle->t_producto_idt_producto = $idt_producto;
            $IngresoSuma                             = Ingreso::findOrFail($request->id);
            $IngresoSuma->Suma_precioCompra          = $PrecioTotalCompra + $IngresoSuma->Suma_precioCompra;
            $IngresoSuma->update();
            $IngresoDetalle->t_ingreso_idt_ingreso = $request->id;
            $IngresoDetalle->estado                = '1';
            $IngresoDetalle->save();
            $ProductoE        = Producto::findOrFail($idt_producto);
            $stock            = $ProductoE->stock;
            $ProductoE->stock = $stock + $IngresoDetalle->cantidad;
            $ProductoE->update();

        }

        return Redirect::to('compras/ingreso');

    }
    public function destroy($id) {
        $Ingreso         = Ingreso::findOrFail($id);
        $Ingreso->estado = '0';
        $Ingreso->update();
        return Redirect::to('compras/ingreso');
    }

    public function detalle($id) {
        $proveedores    = DB::table('t_provedores as a')->where('a.estado', '=', '1')->get();
        $productos      = DB::table('t_producto as b')->where('b.estado', '=', '1')->get();
        $ingresoDetalle = DB::table('t_ingresodetalle as c')->join('t_producto', 't_producto_idt_producto', '=', 'idt_producto')->select('c.*', 't_producto.nombre as productoNombre', 't_producto.codigo as productoCodigo')->where('c.t_ingreso_idt_ingreso', '=', $id)->where('c.estado', '=', '1')->get();
        $ingreso        = DB::table('t_ingreso as d')->join('t_provedores', 't_provedores_idt_provedores', '=', 'idt_provedores')->select('d.*', 't_provedores.nombre as proveedorNombre')->where('d.idt_ingreso', '=', $id)->where('d.estado', '=', '1')->first();

        return view("compras.ingreso.detalle", ["proveedores" => $proveedores, "productos" => $productos, "ingreso" => $ingreso, "ingresoDetalle" => $ingresoDetalle]);

    }
}
