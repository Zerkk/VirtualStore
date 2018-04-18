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

		<h3>Editar Ingreso</h3>
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
		<div class="form-group">
			<label>Tipo de Comprobante</label>
			<select for="tipo_documento" name="tipo_documento" value="{{$ingreso->tipo_comprobante}}" id="inTipoComprobante" class="form-control" >
					<?php switch ($ingreso->tipo_comprobante) {

case 'Nota de Venta':
    echo ('<option value="Nota de Venta" selected>Nota de Venta</option>');
    echo ('<option value="Factura">Factura</option>');
    break;
case 'Factura':
    echo ('<option value="Nota de Venta" >Nota de Venta</option>');
    echo ('<option value="Factura" selected>Factura</option>');
    break;
default:
    echo ('<option value="Nota de Venta">Nota de Venta</option>');
    echo ('<option value="Factura">Factura</option>');
    break;
}?>



           	</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<label for="codigo"> Numero de Comprobante</label>
		<input class="form-control" required value="{{$ingreso->num_comprobante}}" type="text" id="inNumComprobante" name="NumComprobante" placeholder="Codigo">
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<label for="codigo"> Fecha</label>
		<input class="form-control" required value="{{$ingreso->fecha}}" type="date" id="infecha" name="fecha" placeholder="Fecha">
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<label for="codigo"> Impuesto</label>
		<input class="form-control" required value="12" type="text" id="inimpuesto" name="impuesto" placeholder="Impuesto"  disabled>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="form-group">
		<label>Proveedores</label>
	<?php
?>
				<select id="ProveedoresSelect" name="t_provedores_idt_provedores"  value="{{$ingreso->t_provedores_idt_provedores}}" class="form-control" >
					@foreach($proveedores as $prokey)
					<?php if ($ingreso->t_provedores_idt_provedores != $prokey->idt_provedores): ?>
						<option value="{{$prokey->idt_provedores}}">{{$prokey->nombre}}</option>
					<?php else: ?>
						<option value="{{$prokey->idt_provedores}}" selected="true">{{$prokey->nombre}}</option>
					<?php endif?>

					@endforeach
				</select>
	</div>
	</div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="alert " style="background-color:#ecf0f5;" role="alert" id="DivIngresosDetalle">
  		<div class="alert " style="background-color:#fff;" role="alert">
  			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
					<label>Productos</label>
					<select id="ProductosSelect" class="form-control" >
						@foreach($productos as $prodkey)
           					<option value="{{$prodkey->idt_producto}}">{{$prodkey->nombre}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<label>Cantidad</label>
					<input class="form-control" required type="number" value="0" id="inCantidad" name="cantidad" placeholder="Cantidad">
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<label>Precio de Compra C/u</label>
					<input class="form-control" required type="number" value="0" id="inPrecioCompra" name="PrecioCompra" placeholder="Precio de Compra">
					<label>Total Precio Compra</label>
					<input class="form-control" required type="number" value="0" id="inPrecioCompraTotal" name="ToTalPrecioCompra" placeholder="Total Precio de Compra" disabled>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<br>
					<button class="btn btn-success" onclick="CrearDetalle()">Añadir</button>
				</div>
			</div>
  		</div>
	<!-- Botones de categorias agregados -->
  	</div>

</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div>
		<div class="form-group">
			<button class="btn btn-primary "  onclick="FuncionGuardar()">Guardar</button>
			<a class="btn btn-danger" href="{{URL::action('IngresoController@index')}}" role="button">Cancelar</a>
		</div>

	</div>
</div>
<script type="text/javascript">
	var contadorErrores=0;
	function Desaparecer(erroID) {
		    setTimeout(function() {
        $("#"+erroID).fadeOut(1500);
    },5000);
	}
	window.onload=function() {

		IngresarDetalle();

		var var1 = document.getElementById('inCantidad');
    $(var1).on('keyup', function(){
    	var cantidad = document.getElementById('inCantidad').value;
    	var PrecioCompra = document.getElementById('inPrecioCompra').value;
    	TotalCompra=cantidad*PrecioCompra;
    	document.getElementById('inPrecioCompraTotal').value=TotalCompra;
    }).keyup();
    var var2 = document.getElementById('inPrecioCompra');
    $(var2).on('keyup', function(){
    	var cantidad = document.getElementById('inCantidad').value;
    	var PrecioCompra = document.getElementById('inPrecioCompra').value;
    	TotalCompra=cantidad*PrecioCompra;
    	document.getElementById('inPrecioCompraTotal').value=TotalCompra;
    }).keyup();

	}
	var contDetalle=0;
	var arrayDetalle = new Array();
	function IngresarDetalle(){
		<?php foreach ($ingresoDetalle as $keyIngresoDet): ?>

		var selected = "{{$keyIngresoDet->productoNombre}}";
		var selectedID = {{$keyIngresoDet->t_producto_idt_producto}}
		var cantidad = {{$keyIngresoDet->cantidad}}
		var PrecioCompra =  {{$keyIngresoDet->precioCompra}}
		var ToTalPrecioCompra={{$keyIngresoDet->PrecioTotalCompra}}
		var id="'Div"+contDetalle+"'";
		var interacion="'"+contDetalle+"'";
		arrayDetalle[contDetalle]=selectedID+'%'+cantidad+'%'+PrecioCompra+'%'+ToTalPrecioCompra;
		var span = document.createElement('span');
        	span.innerHTML = ['<div class="alert " id='+id+' style="background-color:#fff;" role="alert"><div class="row"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label>Producto:</label> <br>'+selected+'</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><label>Cantidad</label><br>'+cantidad+'</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><label>Precio de Compra</label><br>'+PrecioCompra+'<br><label>Total Precio Compra</label><br>'+ToTalPrecioCompra+'</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><br><button class="btn btn-danger" onclick="EliminarDetalle('+id+','+interacion+')">Eliminar</button></div></div></div>'].join('');
        document.getElementById('DivIngresosDetalle').insertBefore(span, null);
        contDetalle=contDetalle+1;
		<?php endforeach?>
	}



	function CrearDetalle(){
		var comboProducto = document.getElementById("ProductosSelect");
		var selected = comboProducto.options[comboProducto.selectedIndex].text;
		var selectedID = comboProducto.options[comboProducto.selectedIndex].value;
		var cantidad = document.getElementById("inCantidad").value;
		var PrecioCompra = document.getElementById("inPrecioCompra").value;
		var ToTalPrecioCompra=document.getElementById("inPrecioCompraTotal").value;
		var id="'Div"+contDetalle+"'";
		var interacion="'"+contDetalle+"'";
		arrayDetalle[contDetalle]=selectedID+'%'+cantidad+'%'+PrecioCompra+'%'+ToTalPrecioCompra;
		var span = document.createElement('span');
        	span.innerHTML = ['<div class="alert " id='+id+' style="background-color:#fff;" role="alert"><div class="row"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><label>Producto:</label> <br>'+selected+'</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><label>Cantidad</label><br>'+cantidad+'</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><label>Precio de Compra</label><br>'+PrecioCompra+'<br><label>Total Precio Compra</label><br>'+ToTalPrecioCompra+'</div><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><br><button class="btn btn-danger" onclick="EliminarDetalle('+id+','+interacion+')">Eliminar</button></div></div></div>'].join('');
        document.getElementById('DivIngresosDetalle').insertBefore(span, null);
        document.getElementById("inCantidad").value = "0";
        document.getElementById("inPrecioCompra").value = "0";
        document.getElementById("inPrecioCompraTotal").value = "0";
        contDetalle=contDetalle+1;
	}
	function EliminarDetalle(id,iteracion) {
      	$("#"+id).remove();
      	delete arrayDetalle[iteracion];
	}

	function FuncionGuardar() { //Envia Datos Al controlador
		//guardar variables de la tabla producto
		var comboComprobante = document.getElementById("inTipoComprobante");
		var VtipoComprobante = comboComprobante.options[comboComprobante.selectedIndex].text;

    	var VnumComprobante = document.getElementById("inNumComprobante").value;
    	var Vfecha = document.getElementById("infecha").value;
    	var Vimpuesto = document.getElementById("inimpuesto").value;
    	var comboProveedor = document.getElementById("ProveedoresSelect");
		var Vproveedor = comboProveedor.options[comboProveedor.selectedIndex].value;

    	//guardar variables de la categoria
    	var arrayDetalleAux = new Array();
    	var ContadorAuxDeta=0;
    	for (var i = 0; i < arrayDetalle.length; i++) {
    		if (arrayDetalle[i]!=null) {
			arrayDetalleAux[ContadorAuxDeta]=arrayDetalle[i];
			ContadorAuxDeta=ContadorAuxDeta+1;
    		}

    	}


		var form_data = new FormData(); //para poder pasar archivos necesitas declarar un multipart/form-data
		form_data.append('id', "{{$ingreso->idt_ingreso}}");
		form_data.append('tipo_comprobante', VtipoComprobante);
		form_data.append('num_comprobante', VnumComprobante);
		form_data.append('fecha', Vfecha);
		form_data.append('impuesto', Vimpuesto);
		form_data.append('idProveedor', Vproveedor);
		form_data.append('arrayDetalle', JSON.stringify(arrayDetalleAux));
		var route = "/actuIngreso";
		var objApiRest = new AJAXRestFilePOST(route, form_data);
		objApiRest.extractDataAjaxFile(function (_resultContent, status) {
			if (status != 200) {
    			alert(_resultContent.message);
			} else {
			//aqui haces el proceso si todo se ejecuto correctamente
				window.location.replace("/compras/ingreso");

			}
		});
	}



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
