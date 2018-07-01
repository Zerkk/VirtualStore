@extends ('clientePag.index')
@section('contenidoHome')
    <div id="content">
        <div class="container">

            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="{{URL::action('FrontController@index')}}">Inicio</a>
                    </li>
                    <li></li>
                </ul>
            </div>

            <div class="col-md-3">
                <!-- *** MENUS AND FILTERS ***
_________________________________________________________ -->
                <div class="panel panel-default sidebar-menu">

                    <div class="panel-heading">
                        <h3 class="panel-title">Categorias</h3>
                    </div>

                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked category-menu">
                            @foreach($catalogoCategoria as $cataCate)
                                <li>
                                    <a href="{{URL::action('FrontController@Mostrarcategorias',$cataCate->idt_categoria)}}">{{$cataCate->nombre}} </a>
                                </li>
                            @endforeach


                        </ul>

                    </div>
                </div>


                <!-- *** MENUS AND FILTERS END *** -->

                <div class="banner">
                    <div id="main-slider">
                        <div class="item">
                            <img src="{{asset('imagenes/configuracion/'.$configuracion->ImagenPanel1)}}" alt=""  class="img-responsive">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="{{asset('imagenes/configuracion/'.$configuracion->ImagenPanel2)}}" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="{{asset('imagenes/configuracion/'.$configuracion->ImagenPanel3)}}" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">

                <div class="row" id="productMain">
                    <div class="col-sm-6">
                        <div >
                            <img src="{{asset('imagenes/productos/'.$articulo->Imagen)}}" style=" height:450px; width:350px; "  alt="" class="img-responsive">
                        </div>

                        <!-- /.ribbon -->

                    </div>
                    <div class="col-sm-6">
                        <div class="box">
                            <h1 class="text-center">{{$articulo->nombreProducto}}</h1>
                            <p class="goToDescription"><a href="#details" class="scroll-to">Detalle </a>
                            </p>
                            <p class="price">{{$articulo->Precio}}</p>

                            <p class="text-center buttons">
                                <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Comprar</a>
                            </p>


                        </div>

                        <div class="row" id="thumbs">
                            @foreach($catalogosImagen as $catImaKey)
                                @if($catImaKey->t_producto_idt_producto==$articulo->t_producto_idt_producto)
                                    @foreach($imagenes as $ImaKey)
                                        @if($ImaKey->idt_imagen==$catImaKey->t_imagen_idt_imagen)
                                            <div class="col-xs-4">
                                                <a href="{{asset('imagenes/productos/'.$articulo->Imagen)}}" class="thumb">
                                                    <img src="{{asset('imagenes/productos/'.$ImaKey->nombre)}}" style=" height:150px; width:250px; "  alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach

                                @endif

                            @endforeach

                        </div>
                    </div>

                </div>


                <div class="box" id="details">
                    <p>
                    <h4>Detalle del Producto</h4>
                    <p>{{$articulo->descripcionProducto}}</p>
                    <h4>Colores</h4>
                    <ul>
                        @foreach($catalogosColor as $catColoKey)
                            @if($catColoKey->t_producto_idt_producto==$articulo->t_producto_idt_producto )
                                @foreach($colores as $coloKey)
                                    @if($coloKey->idt_color==$catColoKey->t_color_idt_color)
                                                <input type="button" class="btn btn-danger" style="background-color:{{$coloKey->color}};" value="{{$coloKey->nombre}}">
                                    @endif
                                @endforeach

                            @endif

                        @endforeach
                    </ul>
                    <h4>Talla</h4>
                    <ul>
                        @foreach($catalogosTalla as $catTallKey)
                            @if($catTallKey->t_producto_idt_producto==$articulo->t_producto_idt_producto)
                                @foreach($tallas as $TallKey)
                                    @if($TallKey->idt_talla==$catTallKey->t_talla_idt_talla)
                                        <p >{{$TallKey->nombre}}</p>
                                    @endif
                                @endforeach

                            @endif

                        @endforeach
                    </ul>

                    <blockquote>
                        <p><em>Defina el estilo de esta temporada con la nueva gama de vestimenta moderna, elaborada con detalles geniales. Crea un estilo chic con la combinación de este número de encaje con jeans</em></p>
                    </blockquote>

                    <hr>
                    <div class="social">
                        <h4>Comparte con tus amigos</h4>
                        <p>
                            <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                        </p>
                    </div>
                </div>



            </div>
            <!-- /.col-md-9 -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /#content -->
@endsection