<?php

namespace sistema\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use sistema\ConfigCatalogo;
use sistema\Configuracion;

class ConfiguracionController extends Controller {
    public function index(Request $request) {
        $configuracion  = DB::table('t_configuracion as b')->first();
        $catalogoConfig = DB::table('t_catalogoconfig as a')
            ->join('t_articulo as b', 'a.t_articulo_idt_articulo', '=', 'idt_articulo')
            ->join('t_producto as c', 'b.t_producto_idt_producto', '=', 'idt_producto')
            ->select('a.*', 'b.stock as stockArticulo', 'b.Precio as PrecioArticulo', 'c.nombre as nombreProducto')->get();
        $articulos = DB::table('t_articulo as d')->join('t_producto', 't_producto_idt_producto', '=', 'idt_producto')
            ->select('d.*', 't_producto.nombre as nombreProducto')->where('d.estado', '=', '1')->get();

        return view("configuracion.index", ["configuracion" => $configuracion, "catalogo" => $catalogoConfig, "articulos" => $articulos]);

    }
    public function GuardarNombre(Request $request) {
        $configuracion               = Configuracion::findOrFail('1');
        $configuracion->NombrePagina = $request->NombrePagina;
        $configuracion->update();
        return Redirect::to('configuracion');

    }

    public function GuardarImagen(Request $request) {
        if (Input::hasFile('imagen1')) {
            $configuracion  = Configuracion::findOrFail('1');
            $file           = Input::file('imagen1');
            $nombre_fichero = '' . time() . '' . $file->getClientOriginalName() . '';
            $file->move(public_path() . '/imagenes/configuracion', $nombre_fichero);
            $configuracion->ImagenPanel1 = $nombre_fichero;
            $configuracion->update();

        } else {
            if (Input::hasFile('imagen2')) {
                $configuracion  = Configuracion::findOrFail('1');
                $file           = Input::file('imagen2');
                $nombre_fichero = '' . time() . '' . $file->getClientOriginalName() . '';
                $file->move(public_path() . '/imagenes/configuracion', $nombre_fichero);
                $configuracion->ImagenPanel2 = $nombre_fichero;
                $configuracion->update();

            } else {
                if (Input::hasFile('imagen3')) {
                    $configuracion  = Configuracion::findOrFail('1');
                    $file           = Input::file('imagen3');
                    $nombre_fichero = '' . time() . '' . $file->getClientOriginalName() . '';
                    $file->move(public_path() . '/imagenes/configuracion', $nombre_fichero);
                    $configuracion->ImagenPanel3 = $nombre_fichero;
                    $configuracion->update();

                }

            }

        }

        return Redirect::to('configuracion');

    }
    public function ProductoOferta(Request $request) {
        $configuracionCatalogo                                    = new ConfigCatalogo;
        $configuracionCatalogo->t_configuracion_idt_configuracion = '1';
        $configuracionCatalogo->t_articulo_idt_articulo           = $request->id;
        $configuracionCatalogo->save();
        return Redirect::to('configuracion');

    }
    public function EliminarProductoOferta(Request $request) {
        $configuracionCatalogo = ConfigCatalogo::findOrFail($request->id);
        $configuracionCatalogo->delete();
        return Redirect::to('configuracion');

    }

}
