@extends ('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<h3>Listado de Ingresos</h3>
		@include('compras.ingreso.search')
	</div>

</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<a class="btn btn-success" href="{{URL::action('IngresoController@create')}}" role="button">Crear nuevo</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">
		<table class="table tablle-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Id</th>
				<th>Tipo de Comprobante</th>
				<th>Numero de Comprobante</th>
				<th>Fecha</th>
				<th>Impuesto</th>
				<th>Opciones</th>
			</thead>
			@foreach ($Ingresos as $IngreKey)

					<tr>


				<td>{{$IngreKey->idt_ingreso}}</td>
				<td>{{$IngreKey->tipo_comprobante}}</td>
				<td>{{$IngreKey->num_comprobante}}</td>
				<td>{{$IngreKey->fecha}}</td>
				<td>{{$IngreKey->impuesto}}</td>
				<td>
					<a class="btn btn-primary" href="{{URL::action('IngresoController@edit',$IngreKey->idt_ingreso)}}" role="button">Editar</a>
					<a class="btn btn-danger" href="" data-target="#modal-delete-{{$IngreKey->idt_ingreso}}" data-toggle="modal" role="button">Eliminar</a>
					<a class="btn btn-success" href="{{URL::action('IngresoController@detalle',$IngreKey->idt_ingreso)}}"  role="button">Ver detalle</a>
				</td>
			</tr>
			@include('compras.ingreso.modal')
			@endforeach
		</table>
	</div>
	{{$Ingresos->render()}}
	</div>
</div>
@endsection
