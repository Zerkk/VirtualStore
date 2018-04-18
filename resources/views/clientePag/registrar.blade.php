@extends ('clientePag.index')
@section('contenidoHome')
 <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="{{URL::action('FrontController@index')}}">Inicio</a>
                        </li>
                        <li>Nueva Cuenta/Ingresar</li>
                    </ul>

                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>Nueva Cuenta</h1>

                        <p class="lead">Aun no tienes una cuenta?</p>
                        <p>Registrate con nosotros y entraras al mundo Fashion, Encontraras fantasticos descuentos para ti! Este proceso no durara mas de un minuto!</p>
                        <p class="text-muted">Si tienes preguntas por favor <a href="contact.html">contactanos</a>, nuestros servicios al cliente estan disponibles 24/7.</p>

                        <hr>

                        <form method="POST" action="{{ route('register') }}">
						{{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Nombre</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Correo</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Contraseña</label>
 										<input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                        	<div class="form-group">
                            	<label for="password-confirm" >Confirmar Contraseña</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        	</div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>Ingresar</h1>

                        <p class="lead">Ya tienes una cuenta?</p>
                        <p class="text-muted">Ingresa con tu cuenta para obtener beneficios de clientes.</p>

                        <hr>

                        <form  method="POST" action="{{ route('login') }}">
                        	{{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Correo</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Contraseña</label>
								<input id="password" type="password" class="form-control" name="password" required ">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
@endsection