@extends ('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<h3>Listado de Categorias</h3>
		@include('almacen.categoria.search')
	</div>

</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<a class="btn btn-success" href="{{URL::action('CategoriaController@create')}}" role="button">Crear nuevo</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">
		<table class="table tablle-striped table-bordered table-condensed table-hover">
			<thead>

				<th>Nombre</th>
				<th>Opciones</th>
			</thead>
			@foreach ($categorias as $cat)
			<tr>

				<td>{{$cat->nombre}}</td>
				<td>
					<a class="btn btn-primary" href="{{URL::action('CategoriaController@edit',$cat->idt_categoria)}}" role="button">Editar</a>
					<a class="btn btn-danger" href="" data-target="#modal-delete-{{$cat->idt_categoria}}" data-toggle="modal" role="button">Eliminar</a>
				</td>
			</tr>
			@include('almacen.categoria.modal')
			@endforeach
		</table>
	</div>
	{{$categorias->render()}}
	</div>
</div>
@endsection
