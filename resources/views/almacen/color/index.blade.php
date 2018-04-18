@extends ('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<h3>Listado de Colores</h3>
		@include('almacen.color.search')
	</div>

</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<a class="btn btn-success" href="{{URL::action('ColorController@create')}}" role="button">Crear nuevo</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">
		<table class="table tablle-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Nombre</th>
				<th>Color</th>
				<th>Opciones</th>
			</thead>
			@foreach ($colores as $colKey)
			<tr>
				<td>{{$colKey->nombre}}</td>
				<td >
					<div class="alert" style="background-color:{{$colKey->color}}" role="alert"></div>
				</td>
				<td>
					<a class="btn btn-primary" href="{{URL::action('ColorController@edit',$colKey->idt_color)}}" role="button">Editar</a>
					<a class="btn btn-danger" href="" data-target="#modal-delete-{{$colKey->idt_color}}" data-toggle="modal" role="button">Eliminar</a>
				</td>
			</tr>
			@include('almacen.color.modal')
			@endforeach
		</table>
	</div>
	{{$colores->render()}}
	</div>
</div>
@endsection
