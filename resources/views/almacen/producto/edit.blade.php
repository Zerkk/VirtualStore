@extends ('layouts.admin')
@section('contenido')
<style type="text/css">



#pageLoader
{
    background: rgba( 0, 0, 0, 0.7 );
    display: none;
    height: 100%;
    position: fixed;
    width: 100%;
    z-index: 999999;
}

#pageLoader i
{
    left: 50%;
    margin-left: -32px;
    margin-top: -32px;
    position: absolute;
    top: 50%;
    color: #ffffff;
}

.polig{
width:10px;
height:10px;
background:#444444;
font-family:arial;
font-weight:bold;
color:#EEEEEE;


}



</style>

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

		<h3>Editar Producto</h3>
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
<div id="pageLoader">
    <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
</div>
{!! csrf_field() !!}

<div class="row">

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<label for="codigo"> Nombre</label>
		<input class="form-control" required value="{{$producto->nombre}}" type="text" id="inNombre" name="nombre" placeholder="Nombre">
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<label for="codigo"> Codigo</label>
		<input class="form-control" required value="{{$producto->codigo}}" type="text" id="inCodigo" name="codigo" placeholder="Codigo">
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<label for="codigo"> Descripcion</label>
		<input class="form-control" required value="{{$producto->descripcion}}" type="text" id="inDescripcion" name="descripcion" placeholder="Descripcion">
	</div>
</div>
<div class="row">

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<label for="codigo"> Stock</label>
		<input class="form-control" type="number" required name="stock" id="instock" min="0" value="{{$producto->stock}}" step="any">

	</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<label for="codigo"> Aviso</label>
			<br>
			Tenga en cuenta que al modificar el stock puede alterar la contabilidad de su sistema.

		</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="form-group">
		<label>Categorias</label>
		 	<div class="input-group">
				<select id="CategoriasSelect" name="idt_categoria" class="form-control" >
					@foreach($categorias as $cat)
           				<option value="{{$cat->idt_categoria}}">{{$cat->nombre}}</option>
					@endforeach
				</select>
				<span class="input-group-btn">
        			<a class="btn btn-primary " href="#" role="button" onclick="CrearBotonCategorias()">Añadir</a>
      			</span>
			</div>
		<small class="text-muted" >*Clic en la Categoria para eliminarla</small>
		<br>
			<div class="alert alert-info" role="alert">
				<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
					<div class="btn-group mr-2" role="group" aria-label="First group" id="DivCategorias">
    				<!-- Botones de categorias agregados -->
  					</div>
				</div>

			</div>



	</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="form-group">
		<label>Colores</label>
		 	<div class="input-group">
				<select id="ColoresSelect" name="idt_color" class="form-control" >
					@foreach($colores as $coloKey)
           				<option   value="{{$coloKey->idt_color}}" style="background-color:{{$coloKey->color}};">
           					{{$coloKey->nombre}}
           				</option>
					@endforeach
				</select>
				<span class="input-group-btn">
        			<a class="btn btn-primary " href="#" role="button" onclick="CrearBotonColores()">Añadir</a>
      			</span>
			</div>
		<small class="text-muted" >*Clic en el Color para eliminarlo</small>
		<br>
			<div class="alert " role="alert">
				<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  					<div class="btn-group mr-2" role="group" aria-label="First group" id="DivColores">
    				<!-- Botones de categorias agregados -->
  					</div>
				</div>
			</div>


	</div>
	</div>
</div>
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="form-group">
		<label>Tallas</label>
		 	<div class="input-group">
				<select id="TallasSelect" name="idt_categoria" class="form-control" >
					@foreach($tallas as $tallaKey)
           				<option value="{{$tallaKey->idt_talla}}">{{$tallaKey->nombre}}</option>
					@endforeach
				</select>
				<span class="input-group-btn">
        			<a class="btn btn-primary " href="#" role="button" onclick="CrearBotonTallas()">Añadir</a>
      			</span>
			</div>
			<small class="text-muted" >*Clic en la Talla para eliminarla</small>
		<br>
			<div class="alert alert-warning" role="alert">
				<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  					<div class="btn-group mr-2" role="group" aria-label="First group" id="DivTallas">
    				<!-- Botones de tallas agregados -->
  					</div>
				</div>
			</div>


	</div>
	</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="form-group">
		<label>Imagenes</label>
		 	<div class="input-group">
		 		<input type="file"  name="archivoImagen" id="archivoImagen" class="filestyle" name="files[]" accept=".jpg, .jpeg, .png" data-btnClass="btn-primary">

				<output id="list"></output>
			</div>
		<br>
			<div class="alert alert-success" role="alert">
				<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  					<div class="btn-group mr-2" role="group" aria-label="First group" id="DivImagenes">
    				<!-- Botones de categorias agregados -->
  					</div>
				</div>
			</div>

			<div class="btn-group mr-2" role="group" aria-label="First group" id="DivAlertaImagenes">

  			</div>
	</div>
	</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div>
		<div class="form-group">

			<button class="btn btn-primary "  onclick="FuncionGuardar()">Guardar</button>
			<a class="btn btn-danger" href="{{URL::action('ProductoController@index')}}" role="button">Cancelar</a>
		</div>

	</div>
</div>
</form>
<script type="text/javascript">
var contadorErrores=0;
	function Desaparecer(erroID) {
		    setTimeout(function() {
        $("#"+erroID).fadeOut(1500);
    },5000);
	}
//crear boton para Cada categoria elegido
var contCategorias=0;
var arrayCategorias = new Array();
	function CrearBotonCategorias() {
		var combo = document.getElementById("CategoriasSelect");
		var selected = combo.options[combo.selectedIndex].text;
		var selectedID = combo.options[combo.selectedIndex].value;
		var Bool=VerRepetidos(arrayCategorias,selectedID);
		if (Bool!=true) {
			arrayCategorias[contCategorias] = selectedID;
			//agrega boton
			var boton =document.createElement('input');
   				boton.type = 'button';
   				boton.id = 'Categoria'+contCategorias;
   				boton.value = selected;
   				boton.setAttribute('class', 'btn btn-success');
   				boton.setAttribute('onclick', 'BorrarBotonCategorias(this.id,'+contCategorias+')');
   			document.getElementById('DivCategorias').appendChild(boton);
			contCategorias=contCategorias+1;
		}

	}
	function BorrarBotonCategorias(id,iteracion) {
		var boton = document.getElementById(id);
		var btpadre = boton.parentNode;
			btpadre.removeChild(boton);
		//borrar del array
		delete arrayCategorias[iteracion];
	}

	//crear boton para Cada color elegido
var contColores=0;
var arrayColores = new Array();
	function CrearBotonColores() {
		var combo = document.getElementById("ColoresSelect");

		var selected = combo.options[combo.selectedIndex].text;
		var selectedID = combo.options[combo.selectedIndex].value;
		var Bool=VerRepetidos(arrayColores,selectedID);
		if (Bool!=true) {
			arrayColores[contColores] = selectedID;
			//saca el color del select
			var property = "backgroundColor";
			var objeto=combo.options[combo.selectedIndex];
			var ColorRbg=objeto.style[property];
			//agrega boton
			var boton =document.createElement('input');
   				boton.type = 'button';
   				boton.id = 'Color'+contColores;
   				boton.value = selected;
   				boton.setAttribute('class', 'btn btn-danger');
   				boton.setAttribute('style', 'background-color:'+ColorRbg+';');
   				boton.setAttribute('onclick', 'BorrarBotonColores(this.id,'+contColores+')');
   			document.getElementById('DivColores').appendChild(boton);
			contColores=contColores+1;
		}

	}
	function BorrarBotonColores(id,iteracion) {
		var boton = document.getElementById(id);
		var btpadre = boton.parentNode;
			btpadre.removeChild(boton);
		//borrar del array
		delete arrayColores[iteracion];
	}
	//crear boton para Cada talla elegida
var contTallas=0;
var arrayTallas = new Array();
	function CrearBotonTallas() {
		var combo = document.getElementById("TallasSelect");
		var selected = combo.options[combo.selectedIndex].text;
		var selectedID = combo.options[combo.selectedIndex].value;
		var Bool=VerRepetidos(arrayTallas,selectedID);
		if (Bool!=true) {
			arrayTallas[contTallas] = selectedID;
			//agrega boton
			var boton =document.createElement('input');
   				boton.type = 'button';
   				boton.id = 'Talla'+contTallas;
   				boton.value = selected;
   				boton.setAttribute('class', 'btn btn-danger');
   				boton.setAttribute('onclick', 'BorrarBotonTallas(this.id,'+contTallas+')');
   			document.getElementById('DivTallas').appendChild(boton);
			contTallas=contTallas+1;
		}
	}
	function BorrarBotonTallas(id,iteracion) {
		var boton = document.getElementById(id);
		var btpadre = boton.parentNode;
			btpadre.removeChild(boton);
		//borrar del array
		delete arrayTallas[iteracion];
	}
//crear boton para Cada Imagen elegida
var contImagenes=0;
var arrayImagenes = new Array();
	function CrearBotonImagenes(evt) {
      	var form_data = new FormData();
      	form_data.append('Imagen', $("#archivoImagen").prop("files")[0]);

      	var route = "/subirImagen";
		var objApiRest = new AJAXRestFilePOST(route, form_data);
		objApiRest.extractDataAjaxFile(function (_resultContent, status) {
			if (status != 200) {
    			alert(_resultContent.message);
			} else {
			//aqui haces el proceso si todo se ejecuto correctamente

    				if(_resultContent.error!=null){
    					if (_resultContent.error=="repetida") {
    						var span = document.createElement('span');
        						span.innerHTML = ['<div class="alert alert-danger" id="error'+contadorErrores+'" role="alert">La imagen o el nombre de la imagen ya existe. Por favor cambielo</div>'].join('');
        						document.getElementById('DivAlertaImagenes').insertBefore(span, null);

    					}else{
    						if (_resultContent.error=="BadUpload") {
    							var span = document.createElement('span');
    								span.innerHTML = ['<div class="alert alert-danger" id="error'+contadorErrores+'" role="alert">El archivo no se ha cargado correctamente. Por favor intente de nuevo</div>'].join('');
        						document.getElementById('DivAlertaImagenes').insertBefore(span, null);
    						}else{
    							if (_resultContent.error=="NoImage") {
    								var span = document.createElement('span');
    									span.innerHTML = ['<div class="alert alert-danger" id="error'+contadorErrores+'" role="alert">El archivo no es de formato imagen (JPG o PNG)</div>'].join('');
        						document.getElementById('DivAlertaImagenes').insertBefore(span, null);
    							}
    						}
    					}
    					Desaparecer("error"+contadorErrores);
    					contadorErrores=contadorErrores+1;
    				}else{
    					if (_resultContent.nombre!=null) {
    						var Nombre_Fichero=_resultContent.nombre;

    					var files = evt.target.files;
    					var f=files[0];

        				arrayImagenes[contImagenes]=Nombre_Fichero;
        				var reader = new FileReader();
        				reader.onload = (function(theFile, contImagenesS) {
        					return function(e) {
        						var id='Imagen'+contImagenesS;
        						var span = document.createElement('span');
        							span.innerHTML = ['<img class="thumb" id ="'+id+'" onClick="BorrarBotonImagenes(this.id,'+contImagenesS+')" height="42" width="42" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
        						document.getElementById('DivImagenes').insertBefore(span, null);
        					};

        				})(f,contImagenes);
        				reader.readAsDataURL(f);
        				contImagenes=contImagenes+1;
        				}
    				}


			}
		});

	}
		function BorrarBotonImagenes(id,iteracion) {
		var boton = document.getElementById(id);
		var btpadre = boton.parentNode;
			btpadre.removeChild(boton);
		//borrar del array

		delete arrayImagenes[iteracion];
		//alert(JSON.stringify(arrayCategorias));
	}
	//este metodo verifica que no se ingresen datos repetidos en los catalogos
	function VerRepetidos(ArrayV, valor){

    	for (var i = 0; i < ArrayV.length; i++) {
    		if (valor==ArrayV[i]) {
				return true;
    		}

    	}
    	return false;
	}

window.onload=function() {

			IngresarCategorias();
			IngresarColores();
			IngresarTallas();
			IngresarImagenes();
		}
	function IngresarCategorias(){
		<?php foreach ($catalogosCategoria as $catCateKey): ?>
			<?php if ($catCateKey->t_producto_idt_producto == $producto->idt_producto): ?>
				<?php foreach ($categorias as $cateKey): ?>
					<?php if ($cateKey->idt_categoria == $catCateKey->t_categoria_idt_categoria): ?>
						//agrega boton
						arrayCategorias[contCategorias] = "{{$cateKey->idt_categoria}}";
						var boton =document.createElement('input');
   							boton.type = 'button';
   							boton.id = 'Categoria'+contCategorias;
   							boton.value = "{{$cateKey->nombre}}";
   							boton.setAttribute('class', 'btn btn-success');
   							boton.setAttribute('onclick', 'BorrarBotonCategorias(this.id,'+contCategorias+')');
   						document.getElementById('DivCategorias').appendChild(boton);
						contCategorias=contCategorias+1;
					<?php endif?>
				<?php endforeach?>
			<?php endif?>
		<?php endforeach?>
		//alert("{{$producto->nombre}}");

	}
	function IngresarColores(){
		<?php foreach ($catalogosColor as $catColoKey): ?>
			<?php if ($catColoKey->t_producto_idt_producto == $producto->idt_producto): ?>
				<?php foreach ($colores as $coloKey): ?>
					<?php if ($coloKey->idt_color == $catColoKey->t_color_idt_color): ?>
						var selected = "{{$coloKey->nombre}}";
						arrayColores[contColores] = "{{$coloKey->idt_color}}";
						var ColorRbg="{{$coloKey->color}}";
						//agrega boton
						var boton =document.createElement('input');
   							boton.type = 'button';
   							boton.id = 'Color'+contColores;
   							boton.value = selected;
   							boton.setAttribute('class', 'btn btn-danger');
   							boton.setAttribute('style', 'background-color:'+ColorRbg+';');
   							boton.setAttribute('onclick', 'BorrarBotonColores(this.id,'+contColores+')');
   						document.getElementById('DivColores').appendChild(boton);
						contColores=contColores+1;
					<?php endif?>
				<?php endforeach?>
			<?php endif?>
		<?php endforeach?>
		//alert("{{$producto->nombre}}");

	}
	function IngresarTallas(){
		<?php foreach ($catalogosTalla as $catTallKey): ?>
			<?php if ($catTallKey->t_producto_idt_producto == $producto->idt_producto): ?>
				<?php foreach ($tallas as $TallKey): ?>
					<?php if ($TallKey->idt_talla == $catTallKey->t_talla_idt_talla): ?>
						var selected = "{{$TallKey->nombre}}";
						arrayTallas[contTallas] = "{{$TallKey->idt_talla}}";
						//agrega boton
						var boton =document.createElement('input');
   							boton.type = 'button';
   							boton.id = 'Talla'+contTallas;
   							boton.value = selected;
   							boton.setAttribute('class', 'btn btn-danger');
   							boton.setAttribute('onclick', 'BorrarBotonTallas(this.id,'+contTallas+')');
   						document.getElementById('DivTallas').appendChild(boton);
						contTallas=contTallas+1;
					<?php endif?>
				<?php endforeach?>
			<?php endif?>
		<?php endforeach?>
		//alert("{{$producto->nombre}}");

	}
	function IngresarImagenes(){
		<?php foreach ($catalogosImagen as $catImaKey): ?>
			<?php if ($catImaKey->t_producto_idt_producto == $producto->idt_producto): ?>
				<?php foreach ($imagenes as $ImaKey): ?>
					<?php if ($ImaKey->idt_imagen == $catImaKey->t_imagen_idt_imagen): ?>
        			arrayImagenes[contImagenes]="{{$ImaKey->nombre}}";
        			var id='Imagen'+contImagenes;
        			var span = document.createElement('span');
        				span.innerHTML = ['<img class="thumb" id ="'+id+'" onClick="BorrarBotonImagenes(this.id,'+contImagenes+')" height="42" width="42" src="{{asset('imagenes/productos/'.$ImaKey->nombre)}}"/>'].join('');
        			document.getElementById('DivImagenes').insertBefore(span, null);
        			contImagenes=contImagenes+1;
					<?php endif?>
				<?php endforeach?>
			<?php endif?>
		<?php endforeach?>

	}

	function FuncionGuardar() { //Envia Datos Al controlador
		//guardar variables de la tabla producto
    	var Vnombre = document.getElementById("inNombre").value;
    	var Vcodigo = document.getElementById("inCodigo").value;
    	var Vdescripcion = document.getElementById("inDescripcion").value;
    	var Vstock = document.getElementById("instock").value;
    	//guardar variables de la categoria
    	var arrayCategoriasAux = new Array();
    	var ContadorAuxCate=0;
    	for (var i = 0; i < arrayCategorias.length; i++) {
    		if (arrayCategorias[i]!=null) {
			arrayCategoriasAux[ContadorAuxCate]=arrayCategorias[i];
			ContadorAuxCate=ContadorAuxCate+1;
    		}

    	}
    	//guarda variables de los colores
    	var arrayColoresAux = new Array();
    	var ContadorAuxColo=0;
    	for (var i = 0; i < arrayColores.length; i++) {
    		if (arrayColores[i]!=null) {
			arrayColoresAux[ContadorAuxColo]=arrayColores[i];
			ContadorAuxColo=ContadorAuxColo+1;
    		}

    	}

    	//guardar variables de la talla
    	var arrayTallasAux = new Array();
    	var ContadorAuxTalla=0;
    	for (var i = 0; i < arrayTallas.length; i++) {
    		if (arrayTallas[i]!=null) {
			arrayTallasAux[ContadorAuxTalla]=arrayTallas[i];
			ContadorAuxTalla=ContadorAuxTalla+1;
    		}

    	}

    	 //guardar variables de la Imagen
    	var arrayImagenAux = new Array();
    	var ContadorAuxImagen=0;
    	for (var i = 0; i < arrayImagenes.length; i++) {
    		if (arrayImagenes[i]!=null) {
			arrayImagenAux[ContadorAuxImagen]=arrayImagenes[i];
			ContadorAuxImagen=ContadorAuxImagen+1;
    		}

    	}
    	//var a=arrayImagenAux.fieldSerialize();
    	//var st="";
    	//for (var i = 0; i < arrayImagenAux.length; i++) {
    	//st=(arrayImagenAux[i])+" "+st;

    	//}
    	//alert(st);


		var form_data = new FormData(); //para poder pasar archivos necesitas declarar un multipart/form-data
		//form_data.append('certificado', $("#archivoCertificado").prop("files")[0]); //certificado es como el controlador lo leera, archivoCertificado es como se llama tu input file en la vista
		//form_data.append('idioma', $("#idioma").val()); //idioma es como el controlador lo leera,  $("#idioma").val() es como se llama el input text en la vista
		form_data.append('id', "{{$producto->idt_producto}}");
		form_data.append('nombre', Vnombre);
		form_data.append('codigo', Vcodigo);
		form_data.append('descripcion', Vdescripcion);
		form_data.append('stock', Vstock);
		form_data.append('arrayCategorias', JSON.stringify(arrayCategoriasAux));
		form_data.append('arrayColores', JSON.stringify(arrayColoresAux));
		form_data.append('arrayTallas', JSON.stringify(arrayTallasAux));
		form_data.append('arrayImagenes',JSON.stringify(arrayImagenAux));
		var route = "/actualizar";
		var objApiRest = new AJAXRestFilePOST(route, form_data);
		objApiRest.extractDataAjaxFile(function (_resultContent, status) {
			if (status != 200) {
    			alert(_resultContent.message);
			} else {
			//aqui haces el proceso si todo se ejecuto correctamente
				window.location.replace("/almacen/producto");

			}
		});
	}


 document.getElementById('archivoImagen').addEventListener('change', CrearBotonImagenes, false);
 //ajax
 var AJAXRestFilePOST=function(path,parameters){
    this._path=path;
    this._parameters=parameters;
    this._resultContent={};
    this.extractDataAjaxFile=function(callback){
        $.ajax({
            url: this._path,
            type: "POST",
            dataType: "json",
            data: this._parameters,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            headers:{'X-CSRF-TOKEN':$("input[name='_token']").val()},

            success: function(msg){
                this._resultContent=msg;
                callback(this._resultContent,200);
                hideLoading();
            },
            error: function(xhr, status) {
                hideLoading();
                this._resultContent={};
                if( xhr.status == 422 ) {
                    var errores='';
                    errors = xhr.responseJSON;
                    $.each( errors.errors, function( key, value ) {
                        errores += value[0]+"\n";
                    });
                    if(errores.trim()!=""){
                        this._resultContent={message:errores,code:422};
                    }
                }else{console.log(xhr);
                    if( xhr.status == '404' ) {
                        this._resultContent={message:"C\u00F3digo o Pagina no encontrado",code:404};
                    }else{
                        this._resultContent={message:"Error de procesamiento (cod: "+xhr.status+ ")\n"+xhr.responseText,code:500};
                    }

                }

                callback(this._resultContent,xhr.status );
            },
            beforeSend: function(){
                showLoading();
            }
        });
    }
    function ajaxrequest(rtndata) {
    }
}



function showLoading() {
    $("#pageLoader").fadeIn();
}

function hideLoading() {
    $("#pageLoader").fadeOut();
}

//invocar




</script>

@endsection
