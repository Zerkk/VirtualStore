<?php

namespace sistema\Http\Controllers;
use DB;
use sistema\categoria;

class FrontController extends Controller {
    public function index() {
        $configuracion = DB::table('t_configuracion as b')->first();
        $cat           = DB::table('t_catalogoconfig')->get();
        $numero        = (count($cat));
        $articulos           = DB::table('t_articulo')->get();

        $catalogoConfig = DB::table('t_catalogoconfig as a')
            ->join('t_articulo as b', 'a.t_articulo_idt_articulo', '=', 'idt_articulo')
            ->join('t_producto as c', 'b.t_producto_idt_producto', '=', 'idt_producto')
            ->join('t_catalogoimagen as d', 'd.t_producto_idt_producto', '=', 'c.idt_producto')
            ->join('t_imagen as e', 'd.t_imagen_idt_imagen', '=', 'e.idt_imagen')
            ->where('c.estado', '=', '1')
            ->where('d.estado', '=', '1')
            ->select('a.*', 'b.stock as stockArticulo', 'b.Precio as PrecioArticulo', 'c.nombre as nombreProducto', 'e.nombre as Imagen')->take($numero)->get();
        $catalogoCategoria = DB::table('t_categoria as cate')
            ->where('cate.estado', '=', '1')
            ->get();
        return view("ClientePag.home", ["configuracion" => $configuracion, "catalogo" => $catalogoConfig, "catalogoCategoria" => $catalogoCategoria]);

    }
    public function registrar() {
        $configuracion = DB::table('t_configuracion as b')->first();

        $catalogoCategoria = DB::table('t_categoria as cate')
            ->where('cate.estado', '=', '1')
            ->get();
        return view("ClientePag.registrar", ["configuracion" => $configuracion, "catalogoCategoria" => $catalogoCategoria]);

    }

    public function contactar() {
        $configuracion = DB::table('t_configuracion as b')->first();

        $catalogoCategoria = DB::table('t_categoria as cate')
            ->where('cate.estado', '=', '1')
            ->get();
        return view("ClientePag.contactar", ["configuracion" => $configuracion, "catalogoCategoria" => $catalogoCategoria]);
    }

    public function Mostrarcategorias($id) {
        $configuracion = DB::table('t_configuracion as b')->first();
        $CategoriaBD   = Categoria::findOrFail($id);

        $articuloAux           = DB::table('t_articulo')->get();
        $numero        = (count($articuloAux));
        $articulos=DB::table('t_articulo as art')
            ->join('t_producto as pro', 'art.t_producto_idt_producto', '=', 'idt_producto')
            ->join('t_catalogocategoria as catcate','pro.idt_producto', '=', 'catcate.t_producto_idt_producto')
            ->join('t_categoria as cate', 'catcate.t_categoria_idt_categoria', '=', 'cate.idt_categoria')
            ->join('t_catalogoimagen as catimg','pro.idt_producto' , '=', 'catimg.t_producto_idt_producto')
            ->join('t_imagen as img', 'catimg.t_imagen_idt_imagen', '=', 'img.idt_imagen')
            ->where('cate.idt_categoria', '=', $CategoriaBD->idt_categoria)
            ->where('pro.estado', '=', '1')
            ->where('catcate.estado', '=', '1')
            ->where('catimg.estado', '=', '1')
            ->where('img.estado', '=', '1')
            ->select('art.*','pro.nombre as nombreProducto','img.nombre as Imagen')
            ->take($numero)
            ->get();
        $catalogoCategoria = DB::table('t_categoria as cate')
            ->where('cate.estado', '=', '1')
            ->get();
        return view("ClientePag.categorias", ["configuracion" => $configuracion, "articulos" => $articulos, "catalogoCategoria" => $catalogoCategoria,"CategoriaBD" => $CategoriaBD]);

    }

    public function MostrarDetalle($id){
        $configuracion = DB::table('t_configuracion as b')->first();
        $articulo=DB::table('t_articulo as art')
            ->join('t_producto as pro', 'art.t_producto_idt_producto', '=', 'idt_producto')
            ->join('t_catalogocategoria as catcate','pro.idt_producto', '=', 'catcate.t_producto_idt_producto')
            ->join('t_categoria as cate', 'catcate.t_categoria_idt_categoria', '=', 'cate.idt_categoria')
            ->join('t_catalogoimagen as catimg','pro.idt_producto' , '=', 'catimg.t_producto_idt_producto')
            ->join('t_imagen as img', 'catimg.t_imagen_idt_imagen', '=', 'img.idt_imagen')
            ->where('art.idt_articulo','=',$id)
            ->where('pro.estado', '=', '1')
            ->where('catcate.estado', '=', '1')
            ->where('catimg.estado', '=', '1')
            ->where('img.estado', '=', '1')
            ->select('art.*','pro.nombre as nombreProducto','img.nombre as Imagen','pro.descripcion as descripcionProducto')
            ->first();
        $catalogoCategoria = DB::table('t_categoria as cate')
            ->where('cate.estado', '=', '1')
            ->get();
        $catalogosColor     = DB::table('t_catalogocolor as d')->where('d.estado', '=', '1')->get();
        $colores            = DB::table('t_color as e')->where('e.estado', '=', '1')->get();
        $catalogosTalla     = DB::table('t_catalogotalla as f')->where('f.estado', '=', '1')->get();
        $tallas             = DB::table('t_talla as g')->where('g.estado', '=', '1')->get();
        $catalogosImagen    = DB::table('t_catalogoimagen as h')->where('h.estado', '=', '1')->get();
        $imagenes           = DB::table('t_imagen as i')->where('i.estado', '=', '1')->get();
        return view("ClientePag.detalleProducto", ["configuracion" => $configuracion, "articulo" => $articulo, "catalogoCategoria" => $catalogoCategoria, "catalogosColor" => $catalogosColor, "colores" => $colores, "catalogosTalla" => $catalogosTalla, "tallas" => $tallas, "catalogosImagen" => $catalogosImagen, "imagenes" => $imagenes]);
    }
}
//$CatalogoImagenes = DB::table('t_catalogoimagen as a')->join('t_imagen', 't_imagen_idt_imagen', '=', 'idt_imagen')->select('a.*', 't_imagen.nombre as imagenNombre')->where('a.estado', '=', '1')->get();
