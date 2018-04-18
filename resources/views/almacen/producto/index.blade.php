@extends ('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<h3>Listado de Productos</h3>
		@include('almacen.producto.search')
	</div>

</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<a class="btn btn-success" href="{{URL::action('ProductoController@create')}}" role="button">Crear nuevo</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">
		<table class="table tablle-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Id</th>
				<th>Imagen</th>
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Tallas</th>
				<th>Categorias</th>
				<th>Colores</th>
				<th>Stock</th>
				<th>Opciones</th>
			</thead>
			@foreach ($productos as $pro)
			<tr>
				<td>{{$pro->idt_producto}}</td>
				<td>

				@foreach($catalogosImagen as $catImaKey)
					@if($catImaKey->t_producto_idt_producto==$pro->idt_producto)
						@foreach($imagenes as $ImaKey)
							@if($ImaKey->idt_imagen==$catImaKey->t_imagen_idt_imagen)
 						 	<img src="{{asset('imagenes/productos/'.$ImaKey->nombre)}}" id="gallery a" width="30px" height="30px">
 						 	<br>
							@endif
						@endforeach

					@endif

				@endforeach
				</td>
				<td>{{$pro->codigo}}</td>
				<td>{{$pro->nombre}}</td>
				<td>{{$pro->descripcion}}</td>
				<td>
				@foreach($catalogosTalla as $catTallKey)
					@if($catTallKey->t_producto_idt_producto==$pro->idt_producto)
						@foreach($tallas as $TallKey)
							@if($TallKey->idt_talla==$catTallKey->t_talla_idt_talla)
 						 	<p >{{$TallKey->nombre}}</p>
							@endif
						@endforeach

					@endif

				@endforeach
				</td>
				<td>
				@foreach($catalogosCategoria as $catCateKey)
					@if($catCateKey->t_producto_idt_producto==$pro->idt_producto)
						@foreach($categorias as $cateKey)
							@if($cateKey->idt_categoria==$catCateKey->t_categoria_idt_categoria)
 						 	<p>{{$cateKey->nombre}}</p>
							@endif
						@endforeach

					@endif

				@endforeach
				</td>
				<td>
				@foreach($catalogosColor as $catColoKey)
					@if($catColoKey->t_producto_idt_producto==$pro->idt_producto)
						@foreach($colores as $coloKey)
							@if($coloKey->idt_color==$catColoKey->t_color_idt_color)
							<p style="color:{{$coloKey->color}}">{{$coloKey->nombre}}</p>
							@endif
						@endforeach

					@endif

				@endforeach
				</td>
				<td>{{$pro->stock}}</td>
				<td>
					<a class="btn btn-primary" href="{{URL::action('ProductoController@edit',$pro->idt_producto)}}" role="button">Editar</a>
					<a class="btn btn-danger" href="" data-target="#modal-delete-{{$pro->idt_producto}}" data-toggle="modal" role="button">Eliminar</a>
				</td>
			</tr>
			@include('almacen.producto.modal')
			@endforeach
		</table>
		{{$productos->render()}}
	</div>
{{$searchText}}
	</div>


</div>

@endsection
