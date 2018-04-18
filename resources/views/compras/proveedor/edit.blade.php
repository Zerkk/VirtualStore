@extends ('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Proveedor: {{$proveedor->nombre}}</h3>
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
		{!!Form::model($proveedor,['method'=>'PATCH','route'=>['compras.proveedor.update',$proveedor->idt_provedores]])!!}
		{{Form::token()}}
	<div class="form-group">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<div class="form-group">
						<label>Tipo de Documento</label>
						<select for="tipo_documento" name="tipo_documento" value="{{$proveedor->tipo_documento}}" class="form-control" >
							<option value="Ruc">Ruc</option>
           					<option value="Cedula">Cedula</option>
           				</select>
					</div>
				</div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<label for="num_documento"> Numero de Documento</label>
					<input class="form-control" required value="{{$proveedor->num_documento}}" type="text" name="num_documento" placeholder="Numero de Documento">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<label for="nombre"> Nombre</label>
					<input class="form-control" required value="{{$proveedor->nombre}}" type="text"  name="nombre" placeholder="Nombre">
				</div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<label for="direccion"> Direccion</label>
					<input class="form-control" required value="{{$proveedor->direccion}}" type="text" name="direccion" placeholder="Direccion">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<label for="correo"> Correo</label>
					<input class="form-control" required value="{{$proveedor->correo}}" type="email" name="correo" placeholder="Correo">
				</div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<label for="telefono"> Telefono</label>
					<input class="form-control" required value="{{$proveedor->telefono}}" type="text" name="telefono" placeholder="Telefono">
				</div>
			</div>
			<br>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Actualizar</button>
			<a class="btn btn-danger" href="javascript:window.history.back();" role="button">Cancelar</a>
		</div>
	</div>
		{!!Form::close()!!}

@endsection
