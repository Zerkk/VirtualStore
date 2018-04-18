@extends ('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<h3>Listado de Articulos</h3>
		@include('compras.articulo.search')
	</div>

</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<a class="btn btn-success" href="{{URL::action('ArticuloController@create')}}" role="button">Crear nuevo</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">
		<table class="table tablle-striped table-bordered table-condensed table-hover">
			<thead>

				<th>Producto</th>
				<th>Precio</th>
				<th>Stock</th>
				<th>Opciones</th>
			</thead>
			@foreach ($articulos as $art)
			<tr>

				<td>{{$art->productoNombre}}</td>
				<td>{{$art->Precio}}</td>
				<td>{{$art->stock}}</td>
				<td>
					<a class="btn btn-primary" href="{{URL::action('ArticuloController@edit',$art->idt_articulo)}}" role="button">Editar</a>
					<a class="btn btn-danger" href="" data-target="#modal-delete-{{$art->idt_articulo}}" data-toggle="modal" role="button">Eliminar</a>
				</td>
			</tr>
			@include('compras.articulo.modal')
			@endforeach
		</table>
	</div>
	{{$articulos->render()}}
	</div>
</div>
@endsection
