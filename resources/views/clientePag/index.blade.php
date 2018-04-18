<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{$configuracion->NombrePagina}}
    </title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="{{asset('assetsFront/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assetsFront/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assetsFront/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assetsFront/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('assetsFront/css/owl.theme.css')}}" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="{{asset('assetsFront/css/style.default.css')}}" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="{{asset('assetsFront/css/custom.css')}}" rel="stylesheet">

    <script src="{{asset('assetsFront/js/respond.min.js')}}"></script>

    <link rel="shortcut icon" href="{{asset('imagenes/configuracion/logo.png')}}">



</head>

<body>

    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">{{$configuracion->NombrePagina}}</a>  <a >Bienvenido</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    @guest
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">Ingresar</a>
                    </li>
                    <li><a href="{{URL::action('FrontController@registrar')}}">Registrar</a>
                    </li>
                    @else
                    <li><a href="#">{{ Auth::user()->name }}</a>
                    </li>
                    <?php if (Auth::user()->admin == '1'): ?>
                    <li><a href="{{URL::action('ProductoController@index')}}">Panel de Administracion</a>
                    </li>
                    <?php endif?>
                     <li>
                    <a href="{{ route('logout') }}"onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Salir</a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                       {{ csrf_field() }}
                     </form>
                    </li>
                    @endguest
                    <li><a href="{{URL::action('FrontController@contactar')}}">Contactanos</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Ingresar</h4>
                    </div>
                    <div class="modal-body">
                        <form  method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                 <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary"  type="submit"><i class="fa fa-sign-in"></i>Entrar</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">No estas registrado?</p>
                        <p class="text-center text-muted"><a href="register.html"><strong>Registrate Ahora!</strong><br></a>!Es muy facil hacerlo y no te tomara mas de un minuto!</p>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">

            <div class="navbar-header">

               <a class="navbar-brand home" href="#" data-animate-hover="bounce">
                    <img src="{{asset('imagenes/configuracion/logo.png')}}" height="55" width="60" alt="Tienda logo" class="hidden-xs" class="img-responsive">
                    <img src="{{asset('imagenes/configuracion/logo.png')}}"  height="55" width="60" alt="Tienda logo" class="visible-xs"><span class="sr-only" class="img-responsive">Inicio</span>
                </a>

            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="{{URL::action('FrontController@index')}}">Inicio</a>
                    </li>
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Categorias <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h5>Categorias</h5>
                                            <ul>
                                                @foreach($catalogoCategoria as $cataCate)
                                                <li><a href="{{URL::action('FrontController@Mostrarcategorias',$cataCate->idt_categoria)}}">{{$cataCate->nombre}}</a>
                                                </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">
                @guest
                @else
                    <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="basket.html" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm"></span></a>
                </div>
                @endguest

                <!--/.nav-collapse -->

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" onclick="location.href='{{URL::action('FrontController@contactar')}}';">
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>

            <!--/.nav-collapse -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->



    <div id="all">
        <div id="content">
            @yield('contenidoHome')
        </div>
        <!-- /#content -->

        <!-- *** FOOTER ***
 _________________________________________________________ -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>Paginas</h4>

                        <ul>

                            <li><a href="{{URL::action('FrontController@contactar')}}">Contactanos</a>
                            </li>
                        </ul>

                        <hr>
                        @guest
                        <h4>Seccion de Usuario</h4>

                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Entrar</a>
                            </li>
                            <li><a href="{{URL::action('FrontController@registrar')}}">Registrar</a>
                            </li>
                        </ul>
                        @else
                        @endguest
                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Categorias</h4>

                        <ul>
                            @foreach($catalogoCategoria as $cataCate)
                                                <li><a href="category.html">{{$cataCate->nombre}}</a>
                                                </li>
                                                @endforeach
                        </ul>


                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->


                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                        <h4>Siguenos</h4>

                        <p class="social">
                            <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>

                        </p>


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2018 Derechos reservados.</p>

                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->



    </div>
    <!-- /#all -->




    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="{{asset('assetsFront/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{asset('assetsFront/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assetsFront/js/jquery.cookie.js')}}"></script>
    <script src="{{asset('assetsFront/js/waypoints.min.js')}}"></script>
    <script src="{{asset('assetsFront/js/modernizr.js')}}"></script>
    <script src="{{asset('assetsFront/js/bootstrap-hover-dropdown.js')}}"></script>
    <script src="{{asset('assetsFront/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assetsFront/js/front.js')}}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>

    <script>
        function initialize() {
            var mapOptions = {
                zoom: 17,
                center: new google.maps.LatLng(0.362772,  -78.127545),
                mapTypeId: google.maps.MapTypeId.ROAD,
                scrollwheel: false
            }
            var map = new google.maps.Map(document.getElementById('map'),
                mapOptions);

            var myLatLng = new google.maps.LatLng(0.362772,  -78.127545);
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

</body>

</html>