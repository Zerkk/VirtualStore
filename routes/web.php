<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/contactar', 'FrontController@contactar');
Route::get('/registrar', 'FrontController@registrar');
Route::get('/categorias/{id}', 'FrontController@Mostrarcategorias');
Route::resource('/', 'FrontController');
Route::get('configuracion/DeletProduct/{id}', 'ConfiguracionController@EliminarProductoOferta');
Route::get('configuracion/EditProduct', 'ConfiguracionController@ProductoOferta');
Route::post('configuracion/EditImage', 'ConfiguracionController@GuardarImagen');
Route::get('configuracion/EditName', 'ConfiguracionController@GuardarNombre');
Route::resource('configuracion', 'ConfiguracionController');
Route::resource('almacen/categoria', 'CategoriaController');
Route::resource('almacen/color', 'ColorController');
Route::resource('almacen/talla', 'TallaController');

Route::resource('almacen/producto', 'ProductoController');
Route::patch('almacen/producto/{id}', [
    'as'   => 'almacen.producto.update',
    'uses' => 'ProductoController@update',
]);
Route::post('/crear', 'ProductoController@store');
Route::post('/subirImagen', 'ProductoController@subirImagen');
Route::post('/actualizar', 'ProductoController@update');
Route::resource('compras/articulo', 'ArticuloController');
Route::resource('compras/proveedor', 'ProveedorController');
Route::patch('compras/proveedor/{id}', [
    'as'   => 'compras.proveedor.update',
    'uses' => 'ProveedorController@update',
]);
Route::resource('compras/ingreso', 'IngresoController');
Route::patch('compras/ingreso/{id}', [
    'as'   => 'compras.ingreso.update',
    'uses' => 'IngresoController@update',
]);
Route::post('/crearIngreso', 'IngresoController@store');
Route::post('/actuIngreso', 'IngresoController@update');
Route::get('/detalle/{id}', 'IngresoController@detalle');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
