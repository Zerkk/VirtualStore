<?php

namespace sistema\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sistema\CategoriaCatalogo;
use sistema\ColorCatalogo;
use sistema\Http\Requests\ProductoFormRequest;
use sistema\Imagen;
use sistema\ImagenCatalogo;
use sistema\Producto;
use sistema\TallaCatalogo;

class ProductoController extends Controller {
    public function __construct() {

    }
    public function index(Request $request) {
        if ($request) {
            $query     = trim($request->get('searchText'));
            $productos = DB::table('t_producto as a')
                ->select('a.*')
                ->where('a.nombre', 'LIKE', '%' . $query . '%')
                ->where('a.estado', '=', '1')
                ->orderBy('idt_producto', 'desc')
                ->paginate(10);
            //mandamos los catalogos con sus otras tablas
            $catalogosCategoria = DB::table('t_catalogocategoria as b')->where('b.estado', '=', '1')->get();
            $categorias         = DB::table('t_categoria as c')->where('c.estado', '=', '1')->get();
            $catalogosColor     = DB::table('t_catalogocolor as d')->where('d.estado', '=', '1')->get();
            $colores            = DB::table('t_color as e')->where('e.estado', '=', '1')->get();
            $catalogosTalla     = DB::table('t_catalogotalla as f')->where('f.estado', '=', '1')->get();
            $tallas             = DB::table('t_talla as g')->where('g.estado', '=', '1')->get();
            $catalogosImagen    = DB::table('t_catalogoimagen as h')->where('h.estado', '=', '1')->get();
            $imagenes           = DB::table('t_imagen as i')->where('i.estado', '=', '1')->get();

            return view('almacen.producto.index', ["productos" => $productos, "searchText" => $query, "catalogosCategoria" => $catalogosCategoria, "categorias" => $categorias, "catalogosColor" => $catalogosColor, "colores" => $colores, "catalogosTalla" => $catalogosTalla, "tallas" => $tallas, "catalogosImagen" => $catalogosImagen, "imagenes" => $imagenes]);
        }

    }
    public function create() {
        $categorias = DB::table('t_categoria')->where('estado', '=', '1')->get();
        $colores    = DB::table('t_color')->where('estado', '=', '1')->get();
        $tallas     = DB::table('t_talla')->where('estado', '=', '1')->get();

        return view("almacen.producto.create", ["categorias" => $categorias, "colores" => $colores, "tallas" => $tallas]);
    }
    public function store(ProductoFormRequest $request) {

        $producto              = new Producto;
        $producto->codigo      = $request->codigo;
        $producto->nombre      = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->stock       = '0';
        $BuscarProducto        = DB::table('t_producto')->where('codigo', '=', $request->get('codigo'))->where('estado', '=', '1')->first();
        if ($BuscarProducto != null) {
            Session::flash('msg', 'Este Producto ya esta Creado');
            return Redirect::back();
        }

        $producto->estado = '1';
        $producto->save();
        $BuscarProductos = DB::table('t_producto as a')->where('a.codigo', '=', $producto->codigo)->where('a.estado', '=', '1')->first();
        if ($BuscarProductos != null) {
            //Codigo para traer los Id de las CATEGORIAS los cuales entran en un bucle y se van creando en un Catalogo de Categorias con el producto ingresado
            $ArrayCategoriasDatos = json_decode($request->arrayCategorias);
            foreach ($ArrayCategoriasDatos as $arrayCatKey) {
                $categoriaCatalogo                            = new CategoriaCatalogo; //crea una fila en la tabla CatalogoCategoria
                $categoriaCatalogo->estado                    = '1';
                $categoriaCatalogo->t_categoria_idt_categoria = $arrayCatKey;
                $categoriaCatalogo->t_producto_idt_producto   = $BuscarProductos->idt_producto;
                $categoriaCatalogo->save();
            }
            //Codigo para traer los Id de los COLORES los cuales entran en un bucle y se van creando en un Catalogo de Colores con el producto ingresado
            $ArrayColoresDatos = json_decode($request->arrayColores);
            foreach ($ArrayColoresDatos as $arrayColKey) {
                $colorCatalogo                          = new ColorCatalogo; //crea una fila en la tabla CatalogoCategoria
                $colorCatalogo->estado                  = '1';
                $colorCatalogo->t_color_idt_color       = $arrayColKey;
                $colorCatalogo->t_producto_idt_producto = $BuscarProductos->idt_producto;
                $colorCatalogo->save();
            }
            //Codigo para traer los Id de las TALLAS los cuales entran en un bucle y se van creando en un Catalogo de Tallas con el producto ingresado
            $ArrayTallasDatos = json_decode($request->arrayTallas);
            foreach ($ArrayTallasDatos as $arrayTallKey) {
                $tallaCatalogo                          = new TallaCatalogo; //crea una fila en la tabla CatalogoCategoria
                $tallaCatalogo->estado                  = '1';
                $tallaCatalogo->t_talla_idt_talla       = $arrayTallKey;
                $tallaCatalogo->t_producto_idt_producto = $BuscarProductos->idt_producto;
                $tallaCatalogo->save();
            }
            $ArrayImagenesDatos = json_decode($request->arrayImagenes);
            foreach ($ArrayImagenesDatos as $arrayImaKey) {
                $BuscarImagenes = DB::table('t_imagen as b')->where('b.nombre', '=', $arrayImaKey)->where('b.estado', '=', '1')->first();
                if ($BuscarImagenes == null) {
                    //creamos Imagen
                    $Imagen         = new Imagen; //crea una fila en la tabla CatalogoCategoria
                    $Imagen->nombre = $arrayImaKey;
                    $Imagen->estado = '1';
                    $Imagen->save();
                    $BuscarImagen = DB::table('t_imagen as c')->where('c.nombre', '=', $arrayImaKey)->where('c.estado', '=', '1')->first();
                    //creamos Catalogo
                    $ImagenCatalogo                          = new ImagenCatalogo; //crea una fila en la tabla CatalogoCategoria
                    $ImagenCatalogo->t_imagen_idt_imagen     = $BuscarImagen->idt_imagen;
                    $ImagenCatalogo->t_producto_idt_producto = $BuscarProductos->idt_producto;
                    $ImagenCatalogo->estado                  = '1';
                    $ImagenCatalogo->save();

                }

            }

        }

    }
    public function show($id) {
        return view("almacen.producto.show", ["producto" => Producto::findOrFail($id)]);
    }
    public function edit($id) {
        $catalogosCategoria = DB::table('t_catalogocategoria as b')->where('b.estado', '=', '1')->get();
        $categorias         = DB::table('t_categoria as c')->where('c.estado', '=', '1')->get();
        $catalogosColor     = DB::table('t_catalogocolor as d')->where('d.estado', '=', '1')->get();
        $colores            = DB::table('t_color as e')->where('e.estado', '=', '1')->get();
        $catalogosTalla     = DB::table('t_catalogotalla as f')->where('f.estado', '=', '1')->get();
        $tallas             = DB::table('t_talla as g')->where('g.estado', '=', '1')->get();
        $catalogosImagen    = DB::table('t_catalogoimagen as h')->where('h.estado', '=', '1')->get();
        $imagenes           = DB::table('t_imagen as i')->where('i.estado', '=', '1')->get();
        $producto           = Producto::findOrFail($id);
        return view("almacen.producto.edit", ["producto" => $producto, "catalogosCategoria" => $catalogosCategoria, "categorias" => $categorias, "catalogosColor" => $catalogosColor, "colores" => $colores, "catalogosTalla" => $catalogosTalla, "tallas" => $tallas, "catalogosImagen" => $catalogosImagen, "imagenes" => $imagenes]);

    }
    public function update(ProductoFormRequest $request) {

        $producto              = Producto::findOrFail($request->id);
        $producto->codigo      = $request->codigo;
        $producto->nombre      = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->stock       = $request->stock;
        $BusquedaProducto      = DB::table('t_producto')->where('codigo', '=', $request->get('codigo'))->where('estado', '=', '1')->first();
        if ($BusquedaProducto != null && $BusquedaProducto->idt_producto != $request->id) {
            Session::flash('msg', 'Este Producto ya esta Creado');
            return Redirect::back();
        }
        $producto->update();

        //Annula todos los catalogos  que tiene el producto
        $catalogosCategoria = DB::table('t_catalogocategoria as a')->where('a.t_producto_idt_producto', '=', $request->id)->get();
        foreach ($catalogosCategoria as $catCatekey) {
            if ($catCatekey->estado = '1') {
                $CatalogoEncont         = CategoriaCatalogo::findOrFail($catCatekey->idt_catalogoCategoria);
                $CatalogoEncont->estado = '0';
                $CatalogoEncont->update();

            }
        }
        //Recorre todo el array y los activa si ya existe ese catalogo de lo contrario los crea
        $ArrayCategoriasDatos = json_decode($request->arrayCategorias);
        foreach ($ArrayCategoriasDatos as $arrayCatKey) {
            //recorre todo el array
            $catalogosCategoria = DB::table('t_catalogocategoria as b')->where('b.t_producto_idt_producto', '=', $request->id)->where('b.t_categoria_idt_categoria', '=', $arrayCatKey)->first();
            //recorre los datos de la consulta
            if ($catalogosCategoria == null) {
                $categoriaCatalogo                            = new CategoriaCatalogo; //crea una fila en la tabla CatalogoCategoria
                $categoriaCatalogo->estado                    = '1';
                $categoriaCatalogo->t_categoria_idt_categoria = $arrayCatKey;
                $categoriaCatalogo->t_producto_idt_producto   = $request->id;
                $categoriaCatalogo->save();
            } else {

                $CatalogoEncont         = CategoriaCatalogo::findOrFail($catalogosCategoria->idt_catalogoCategoria);
                $CatalogoEncont->estado = '1';
                $CatalogoEncont->update();

            }

        }
        //Annula todos los catalogos  que tiene el producto
        $catalogosColor = DB::table('t_catalogocolor as c')->where('c.t_producto_idt_producto', '=', $request->id)->get();
        foreach ($catalogosColor as $catColkey) {
            if ($catColkey->estado = '1') {
                $CatalogoEncont         = ColorCatalogo::findOrFail($catColkey->idt_catalogoColor);
                $CatalogoEncont->estado = '0';
                $CatalogoEncont->update();

            }
        }

        //Recorre todo el array y los activa si ya existe ese catalogo de lo contrario los crea
        $ArrayColoresDatos = json_decode($request->arrayColores);
        foreach ($ArrayColoresDatos as $arrayColKey) {
            //recorre todo el array
            $catalogosColor = DB::table('t_catalogocolor as d')->where('d.t_producto_idt_producto', '=', $request->id)->where('d.t_color_idt_color', '=', $arrayColKey)->first();
            //recorre los datos de la consulta
            if ($catalogosColor == null) {
                $colorCatalogo                          = new ColorCatalogo; //crea una fila en la tabla CatalogoCategoria
                $colorCatalogo->estado                  = '1';
                $colorCatalogo->t_color_idt_color       = $arrayColKey;
                $colorCatalogo->t_producto_idt_producto = $request->id;
                $colorCatalogo->save();
            } else {

                $CatalogoEncont         = ColorCatalogo::findOrFail($catalogosColor->idt_catalogoColor);
                $CatalogoEncont->estado = '1';
                $CatalogoEncont->update();

            }

        }
        //Annula todos los catalogos  que tiene el producto
        $catalogosTalla = DB::table('t_catalogotalla as e')->where('e.t_producto_idt_producto', '=', $request->id)->get();
        foreach ($catalogosTalla as $catTallkey) {
            if ($catTallkey->estado = '1') {
                $CatalogoEncont         = TallaCatalogo::findOrFail($catTallkey->idt_catalogoTalla);
                $CatalogoEncont->estado = '0';
                $CatalogoEncont->update();

            }
        }

        //Recorre todo el array y los activa si ya existe ese catalogo de lo contrario los crea
        $ArrayTallasDatos = json_decode($request->arrayTallas);
        foreach ($ArrayTallasDatos as $catTallkey) {
            //recorre todo el array
            $catalogosTalla = DB::table('t_catalogotalla as f')->where('f.t_producto_idt_producto', '=', $request->id)->where('f.t_talla_idt_talla', '=', $catTallkey)->first();
            //recorre los datos de la consulta
            if ($catalogosTalla == null) {
                $colorCatalogo                          = new TallaCatalogo; //crea una fila en la tabla CatalogoCategoria
                $colorCatalogo->estado                  = '1';
                $colorCatalogo->t_talla_idt_talla       = $catTallkey;
                $colorCatalogo->t_producto_idt_producto = $request->id;
                $colorCatalogo->save();
            } else {

                $CatalogoEncont         = TallaCatalogo::findOrFail($catalogosTalla->idt_catalogoTalla);
                $CatalogoEncont->estado = '1';
                $CatalogoEncont->update();

            }

        }
        //Annula todos los catalogos  que tiene el producto
        $catalogosImagen = DB::table('t_catalogoimagen as g')->where('g.t_producto_idt_producto', '=', $request->id)->get();
        foreach ($catalogosImagen as $catImakey) {
            if ($catImakey->estado = '1') {
                $CatalogoEncont         = ImagenCatalogo::findOrFail($catImakey->idt_catalogoImagen);
                $CatalogoEncont->estado = '0';
                $CatalogoEncont->update();

            }
        }
        //Recorre todo el array y los activa si ya existe ese catalogo de lo contrario los crea
        $ArrayImagenDatos = json_decode($request->arrayImagenes);
        foreach ($ArrayImagenDatos as $Imakey) {
            //recorre todo el array
            $ImagenBus = DB::table('t_imagen as h')->where('h.nombre', '=', $Imakey)->where('h.estado', '=', '1')->first();
            if ($ImagenBus == null) {
                $Imagen         = new Imagen; //crea una fila en la tabla CatalogoCategoria
                $Imagen->nombre = $Imakey;
                $Imagen->estado = '1';
                $Imagen->save();
                $Imagen = DB::table('t_imagen as i')->where('i.nombre', '=', $Imakey)->where('i.estado', '=', '1')->first();
                //creamos Catalogo
                $ImagenCatalogo                          = new ImagenCatalogo; //crea una fila en la tabla CatalogoCategoria
                $ImagenCatalogo->t_imagen_idt_imagen     = $Imagen->idt_imagen;
                $ImagenCatalogo->t_producto_idt_producto = $request->id;
                $ImagenCatalogo->estado                  = '1';
                $ImagenCatalogo->save();

            } else {
                $catalogosImagen = DB::table('t_catalogoimagen as j')->where('j.t_producto_idt_producto', '=', $request->id)->where('j.t_imagen_idt_imagen', '=', $ImagenBus->idt_imagen)->first();
                if ($catalogosImagen != null) {
                    $CatalogoEncont         = ImagenCatalogo::findOrFail($catalogosImagen->idt_catalogoImagen);
                    $CatalogoEncont->estado = '1';
                    $CatalogoEncont->update();
                }

            }
        }

        return Redirect::to('almacen/producto');
    }
    public function destroy($id) {
        $producto         = Producto::findOrFail($id);
        $producto->estado = '0';
        $producto->update();
        return Redirect::to('almacen/producto');
    }
    public function subirImagen(Request $request) {
        //$this->validate($request, ['idioma' => 'required|alpha_spaces']);
        $objFile = $request->file('Imagen');

        if ($objFile != null) {
            $tipoDeArchivo = strtolower($objFile->getClientOriginalExtension());
            if (($tipoDeArchivo != 'jpg') and ($tipoDeArchivo != 'png')) {
                return response()->json(["error" => "NoImage"]);
            } else {
                if (strtolower($objFile->getError()) != '0') {
                    return response()->json(["error" => "BadUpload"]);
                }
            }
            $nombre_fichero    = '' . time() . '' . $objFile->getClientOriginalName() . '';
            $ubicacion_fichero = public_path() . '/imagenes/productos/' . $nombre_fichero;
            if (file_exists($ubicacion_fichero)) {
                return response()->json(["error" => "repetida"]);
            } else {

                $objFile->move(public_path() . '/imagenes/productos', $nombre_fichero);
                return response()->json(["nombre" => $nombre_fichero]);
            }

        }

    }
}
