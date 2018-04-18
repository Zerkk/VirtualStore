@extends ('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
	<h3>Ingreso #{{$ingreso->idt_ingreso}}</h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<label> Tipo de Comprobante:</label> {{$ingreso->tipo_comprobante}}
	</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<label> Numero de Comprobante:</label> {{$ingreso->num_comprobante}}
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<label> Fecha:</label> {{$ingreso->fecha}}
	</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<label> Impuesto:</label> {{$ingreso->impuesto}}
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<label> Provedor:</label> {{$ingreso->proveedorNombre}}

</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">
		<table class="table tablle-striped table-bordered table-condensed table-hover">
			<thead>
				<th class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Codigo</th>
				<th class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Producto</th>
				<th>Cantidad</th>
				<th>Compra C/U</th>
				<th>Compra Total</th>


			</thead>

				@foreach ($ingresoDetalle as $IngreDetalleKey)
				<tr>
					<td>{{$IngreDetalleKey->productoCodigo}}</td>
					<td>{{$IngreDetalleKey->productoNombre}}</td>
					<td>{{$IngreDetalleKey->cantidad}}</td>
					<td>{{$IngreDetalleKey->precioCompra}}</td>
					<td>{{$IngreDetalleKey->PrecioTotalCompra}}</td>

				</tr>
				@endforeach
				<tr>
					<td></td>
					<td><label>Total</label></td>
					<td></td>
					<td></td>
					<td>{{$ingreso->Suma_precioCompra}}</td>

				</tr>
		</table>
	</div>

	</div>
</div>
<script type="text/javascript">
	window.onload=function() {

		if (window.print()==window.close()) {
			javascript:window.history.back();
		}
	}


</script>
@endsection
