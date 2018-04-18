@extends ('layouts.admin')
@section('contenido')

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nuevo Color</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
	</div>
		@endif
		@if(Session::has('msg'))
			<div class="alert alert-danger"><strong>Error</strong> {{Session::get('msg')}}</div>
		@endif
		{!!Form::open(array('url'=>'almacen/color','method'=>'POST','autocomplete'=>'off'))!!}
		{{Form::token()}}

			<div class="form-group">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="nombre"> Nombre</label>
						<input class="form-control" required value="{{old('nombre')}}" type="text" id="inNombre" name="nombre" placeholder="Nombre">
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="color"> Color: </label>
						<br>
						<input type="color" class="form-control" value="#FF0000" name="color" style="width:50%;"/>
					</div>
				</div>
				<br>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<a class="btn btn-danger" href="{{URL::action('ColorController@index')}}" role="button">Cancelar</a>
				</div>
			</div>
		{!!Form::close()!!}






@endsection
