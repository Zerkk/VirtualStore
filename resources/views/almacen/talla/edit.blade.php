@extends ('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Talla: {{$talla->nombre}}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif
		@if(Session::has('msg'))
			<div class="alert alert-danger"><strong>Error</strong> {{Session::get('msg')}}</div>
		@endif
		{!!Form::model($talla,['method'=>'PATCH','route'=>['talla.update',$talla->idt_talla]])!!}
		{{Form::token()}}
		<div class="form-group">
			<label for="nombre"> Nombre</label>
			<input class="form-control" type="text" name="nombre" value="{{$talla->nombre}}" placeholder="Nombre">

		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<a class="btn btn-danger" href="{{URL::action('TallaController@index')}}" role="button">Cancelar</a>
		</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection
