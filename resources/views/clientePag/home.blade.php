@extends ('clientePag.index')
@section('contenidoHome')

            <div class="container">
                <div class="col-md-12">
                    <div id="main-slider">
                        <div class="item">
                            <img src="{{asset('imagenes/configuracion/'.$configuracion->ImagenPanel1)}}" alt="" class="img-responsive">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="{{asset('imagenes/configuracion/'.$configuracion->ImagenPanel2)}}" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="{{asset('imagenes/configuracion/'.$configuracion->ImagenPanel3)}}" alt="">
                        </div>
                    </div>
                    <!-- /#main-slider -->
                </div>
            </div>

            <!-- *** ADVANTAGES HOMEPAGE ***
 _________________________________________________________ -->
            <div id="advantages">

                <div class="container">
                    <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-heart"></i>
                                </div>

                                <h3><a href="#">Nosotros Amamos a nuestros clientes</a></h3>
                                <p>Nosotros siempre brindaremos el mejor servicio a nuestos clientes</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-tags"></i>
                                </div>

                                <h3><a href="#">Mejores Precios</a></h3>
                                <p>Nuestra selecion de ropa se ajusta al nivel de tu bolsillo</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-thumbs-up"></i>
                                </div>

                                <h3><a href="#">100% satisfacion garantizada</a></h3>
                                <p>Si no te gusto nuestro producto puedes devolverlo sin ningun costo.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /#advantages -->

            <!-- *** ADVANTAGES END *** -->

            <!-- *** HOT PRODUCT SLIDESHOW ***
 _________________________________________________________ -->
            <div id="hot">

                <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2>Ofertas</h2>
                        </div>
                    </div>
                </div>

                <div class="container">

                    <!-- /.product-slider -->
                    <div class="product-slider">
                        @foreach ($catalogo as $cat)


                        <div class="item">

                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.html">


                                                <img src="{{asset('imagenes/productos/'.$cat->Imagen)}}"  style=" height:176px; width:176px; " alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.html">
                                                <img src="{{asset('imagenes/productos/'.$cat->Imagen)}}"   style=" height:176px; width:176px; " alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.html" class="invisible">
                                    <img src="{{asset('imagenes/productos/'.$cat->Imagen)}}"    style=" height:176px; width:176px; " alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.html">{{$cat->nombreProducto}}</a></h3>
                                    <p class="price">$ {{$cat->PrecioArticulo}}</p>
                                </div>
                                <!-- /.text -->
                            </div>

                            <!-- /.product -->
                        </div>

                        @endforeach


                    </div>
                </div>
                <!-- /.container -->

            </div>
            <!-- /#hot -->

            <!-- *** HOT END *** -->

            <!-- *** GET INSPIRED ***
 _________________________________________________________
            <div class="container" data-animate="fadeInUpBig">
                <div class="col-md-12">
                    <div class="box slideshow">
                        <h3>Get Inspired</h3>
                        <p class="lead">Get the inspiration from our world class designers</p>
                        <div id="get-inspired" class="owl-carousel owl-theme">
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired1.jpg" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired2.jpg" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired3.jpg" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             *** GET INSPIRED END ***

            *** BLOG HOMEPAGE ***
 _________________________________________________________ -->

            <div class="box text-center" data-animate="fadeInUp">
                <div class="container">
                    <div class="col-md-12">
                        <h3 class="text-uppercase">Quieres Ofrecer tu producto?</h3>

                        <p class="lead">Si produces camisas, camisetas etc..  <a href="{{URL::action('FrontController@contactar')}}">Contactanos!</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="container">

                <div class="col-md-12" data-animate="fadeInUp">

                    <div id="blog-homepage" class="row">
                        <div class="col-sm-6">
                            <div class="post">
                                <h4><a href="post.html">G&L tienda virtual</a></h4>
                                <p class="author-category">By <a href="#">Natalia Guerrero</a> in <a href="">Presidente de la Empresa</a>
                                </p>
                                <hr>
                                <p class="intro">PALABRASsadhjkladsjkasdjlasdjadljadd</p>
                                <p class="read-more"><a href="post.html" class="btn btn-primary">Continue reading</a>
                                </p>
                            </div>
                        </div>

                    </div>
                    <!-- /#blog-homepage -->
                </div>
            </div>
            <!-- /.container -->

            <!-- *** BLOG HOMEPAGE END *** -->

@endsection
