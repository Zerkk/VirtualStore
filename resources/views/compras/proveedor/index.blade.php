@extends ('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<h3>Listado de Proveedores</h3>
		@include('compras.proveedor.search')
	</div>

</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<a class="btn btn-success" href="/compras/proveedor/create" role="button">Crear nuevo</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">
		<table class="table tablle-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Id</th>
				<th>Nombre</th>
				<th>Tipo de Documento</th>
				<th>Numero de documento</th>
				<th>Direccion</th>
				<th>Telefono</th>
				<th>Correo</th>
				<th>Opciones</th>
			</thead>
			@foreach ($Proveedores as $ProvKey)
			<tr>
				<td>{{$ProvKey->idt_provedores}}</td>
				<td>{{$ProvKey->nombre}}</td>
				<td>{{$ProvKey->tipo_documento}}</td>
				<td>{{$ProvKey->num_documento}}</td>
				<td>{{$ProvKey->direccion}}</td>
				<td>{{$ProvKey->telefono}}</td>
				<td>{{$ProvKey->correo}}</td>
				<td>
					<a class="btn btn-primary" href="{{URL::action('ProveedorController@edit',$ProvKey->idt_provedores)}}" role="button">Editar</a>
					<a class="btn btn-danger" href="" data-target="#modal-delete-{{$ProvKey->idt_provedores}}" data-toggle="modal" role="button">Eliminar</a>
				</td>
			</tr>
			@include('compras.proveedor.modal')
			@endforeach
		</table>
	</div>
	{{$Proveedores->render()}}
	</div>
</div>
@endsection
