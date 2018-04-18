@extends ('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<h3>Listado de Tallas</h3>
		@include('almacen.talla.search')
	</div>

</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<a class="btn btn-success" href="{{URL::action('TallaController@create')}}" role="button">Crear nuevo</a>
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
			@foreach ($tallas as $tallKey)
			<tr>
				<td>{{$tallKey->nombre}}</td>
				<td>
					<a class="btn btn-primary" href="{{URL::action('TallaController@edit',$tallKey->idt_talla)}}" role="button">Editar</a>
					<a class="btn btn-danger" href="" data-target="#modal-delete-{{$tallKey->idt_talla}}" data-toggle="modal" role="button">Eliminar</a>
				</td>
			</tr>
			@include('almacen.talla.modal')
			@endforeach
		</table>
	</div>
	{{$tallas->render()}}
	</div>
</div>
@endsection
