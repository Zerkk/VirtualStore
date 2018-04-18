@extends ('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Articulo </h3>
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
		{!!Form::model($articulo,['method'=>'PATCH','route'=>['articulo.update',$articulo->idt_articulo]])!!}
		{{Form::token()}}
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">

					<label for="nombre"> Nombre</label>
					<label>Productos</label>
					<select id="ProductoSelect" name="t_producto_idt_producto" class="form-control" >
						@foreach($productos as $prodkey)
							@if($prodkey->idt_producto == $articulo->t_producto_idt_producto)
								<option value="{{$prodkey->idt_producto}}" selected>{{$prodkey->nombre}}</option>
							@else
							<option value="{{$prodkey->idt_producto}}">{{$prodkey->nombre}}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<input class="form-control" required type="number" value="{{$articulo->Precio}}"  name="Precio" placeholder="Precio">

			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<input class="form-control" required type="number" value="{{$articulo->stock}}" name="stock" placeholder="Stock">
			</div>
		</div>
		<br>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<a class="btn btn-danger" href="{{URL::action('ArticuloController@index')}}" role="button">Cancelar</a>
		</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection
