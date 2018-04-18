@extends ('clientePag.index')
@section('contenidoHome')
<div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{URL::action('FrontController@index')}}">Inicio</a>
                        </li>
                        <li>{{$CategoriaBD->nombre}}</li>
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
                    <div class="box">
                        <h1 style="text-transform: uppercase; text-align: center">{{$CategoriaBD->nombre}}</h1>

                    </div>


                    <div class="row products">
                        @foreach($articulos as $art)
                            <div class="col-md-4 col-sm-6">
                                <div class="product">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="detail.html">
                                                    <img src="{{asset('imagenes/productos/'.$art->Imagen)}}" style=" height:250px; width:250px; "  alt="" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="back">
                                                <a href="detail.html">
                                                    <img src="{{asset('imagenes/productos/'.$art->Imagen)}}" style=" height:250px; width:250px; " alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="detail.html" class="invisible">
                                        <img src="{{asset('imagenes/productos/'.$art->Imagen)}}" style=" height:250px; width:250px; "  alt="" class="img-responsive">
                                    </a>
                                    <div class="text">
                                        <h3><a href="detail.html">{{$art->nombreProducto}}</a></h3>
                                        <p class="price">${{$art->Precio}}</p>
                                        <p class="buttons">
                                            <a href="detail.html" class="btn btn-default">Ver Detalle</a>
                                            <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Comprar</a>
                                        </p>
                                    </div>
                                    <!-- /.text -->
                                </div>
                                <!-- /.product -->
                            </div>
                        @endforeach


                        <!-- /.col-md-4 -->
                    </div>
                    <!-- /.products -->




                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
@endsection