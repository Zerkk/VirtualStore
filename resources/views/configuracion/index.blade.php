@extends ('layouts.admin')
@section('contenido')
<style type="text/css">



#pageLoader
{
    background: rgba( 0, 0, 0, 0.7 );
    display: none;
    height: 100%;
    position: fixed;
    width: 100%;
    z-index: 999999;
}

#pageLoader i
{
    left: 50%;
    margin-left: -32px;
    margin-top: -32px;
    position: absolute;
    top: 50%;
    color: #ffffff;
}

.polig{
width:10px;
height:10px;
background:#444444;
font-family:arial;
font-weight:bold;
color:#EEEEEE;


}



</style>

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

		<h3>Editar Pagina</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
<div id="pageLoader">
    <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
</div>
{!! csrf_field() !!}
{!!Form::open(array('action'=>array('ConfiguracionController@GuardarNombre'),'method'=>'GET','files'=>'true'))!!}
{{Form::token()}}
<div class="row">


	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<label for="codigo"> Nombre de la Pagina</label>
			<input class="form-control" required value="{{$configuracion->NombrePagina}}" type="text" id="NombrePagina" name="NombrePagina" placeholder="Nombre de la Pagina">
			<br>
			<button class="btn btn-primary" type="submit">Guardar</button>
	</div>


</div>
{!!Form::close()!!}
{!!Form::open(array('action'=>array('ConfiguracionController@GuardarImagen'),'method'=>'POST','files'=>'true'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<label for="codigo"> Imagen 1</label>
		<img height="100" width="100" src="{{asset('imagenes/configuracion/'.$configuracion->ImagenPanel1)}}"/>
		 	<div class="input-group">
		 		<input type="file"  name="imagen1" id="imagen1" class="filestyle" accept=".jpg, .jpeg, .png" data-btnClass="btn-primary">
			</div>
			<br>
			<button class="btn btn-primary" type="submit">Guardar</button>
	</div>
</div>
{!!Form::close()!!}
{!!Form::open(array('action'=>array('ConfiguracionController@GuardarImagen'),'method'=>'POST','files'=>'true'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<label for="codigo"> Imagen 2</label>
		<img height="100" width="100" src="{{asset('imagenes/configuracion/'.$configuracion->ImagenPanel2)}}"/>
		 	<div class="input-group">
		 		<input type="file"  name="imagen2" id="imagen2" class="filestyle" accept=".jpg, .jpeg, .png" data-btnClass="btn-primary">
			</div>
			<br>
			<button class="btn btn-primary" type="submit">Guardar</button>
	</div>
</div>
{!!Form::close()!!}
{!!Form::open(array('action'=>array('ConfiguracionController@GuardarImagen'),'method'=>'POST','files'=>'true'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<label for="codigo"> Imagen 3</label>
		<img height="100" width="100" src="{{asset('imagenes/configuracion/'.$configuracion->ImagenPanel3)}}"/>
		 	<div class="input-group">
		 		<input type="file"  name="imagen3" id="imagen3" class="filestyle" accept=".jpg, .jpeg, .png" data-btnClass="btn-primary">

			</div>
			<br>
			<button class="btn btn-primary" type="submit">Guardar</button>
	</div>
</div>
{!!Form::close()!!}
{!!Form::open(array('action'=>array('ConfiguracionController@ProductoOferta'),'method'=>'GET','files'=>'true'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="form-group">
		<label>Productos en Oferta</label>
				<select id="id" name="id" class="form-control" >
					@foreach($articulos as $art)
           				<option value="{{$art->idt_articulo}}">{{$art->nombreProducto}} Stock:{{$art->stock}} Precio:{{$art->Precio}}</option>
					@endforeach
				</select>
	</div>

		<button class="btn btn-primary" type="submit">Añadir</button>
	</div>
</div>
{!!Form::close()!!}
<br>
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	<div class="table-responsive">
		<table class="table tablle-striped table-bordered table-condensed table-hover">
			<thead>

				<th>Nombre</th>
				<th>Opciones</th>
			</thead>
			@foreach ($catalogo as $cat)
			<tr>
				<td>
					{{$cat->nombreProducto}}
				</td>
				<td>
					<a class="btn btn-danger" href="{{URL::action('ConfiguracionController@EliminarProductoOferta',$cat->idt_CatalogoConfig)}}" data-toggle="modal" role="button">Eliminar</a>
				</td>
			</tr>

			@endforeach
		</table>
	</div>

	</div>
</div>

</form>
@endsection
