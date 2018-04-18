@extends ('clientePag.index')
@section('contenidoHome')
<div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{URL::action('FrontController@index')}}">Inicio</a>
                        </li>
                        <li>Contactar</li>
                    </ul>

                </div>


                <div class="col-md-9">


                    <div class="box" id="contact">
                        <h1>Contactanos</h1>

                        <p class="lead">Tienes curiosidad sobre algo en especial? Tienes algun tipo de problema con alguno de nuestros productos?</p>
                        <p>Por favor, sientete libre de contactarnos nuestra asistencia al cliente es  24/7.</p>

                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <h3><i class="fa fa-map-marker"></i> Direccion</h3>
                                <p>Guaranda 4-81
                                    <br>Isla Santa Curz

                                    <br>Ibarra-Imbabura
                                    <br>
                                    <strong>Ecuador</strong>
                                </p>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-4">
                                <h3><i class="fa fa-phone"></i> Telefono</h3>
                                <p class="text-muted">Puedes realizar una llamada telefonica para solucionar tus problemas de forma inmediata</p>
                                <p><strong>0991209226</strong>
                                </p>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-4">
                                <h3><i class="fa fa-envelope"></i> Correo Electronico</h3>
                                <p class="text-muted">Escribenos a nuestro email si tienes algun problema.</p>
                                <ul>
                                    <li><strong><a href="mailto:">natty101214@hotmail.es</a></strong>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.col-sm-4 -->
                        </div>
                        <!-- /.row -->

                        <hr>

                        <div id="map">

                        </div>


                    </div>


                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
@endsection