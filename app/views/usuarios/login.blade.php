@extends('layouts.1')

@section('content')

	{{Form::open(array('method' => 'POST', 'url' => '/login', 'role' => 'form'))}}

	@if(Session::has('registro'))
		<h3>{{Session::get('registro')}}</h3></br>
	@endif

    
	<div class="row">		
			<div class="col-xs-6 col-md-4"></div>
			<div class="col-xs-6 col-md-4">
				<legend> INICIO DE SESION </legend>
					<div class="jumbotron" >
						
						<div class="form-group">
							{{Form::label('Usuario')}}
							{{Form::text('username', '', array('class' => 'form-control'))}}
							<span class="help-block">{{ $errors->first('username') }}</span>
						</div>
						<div class="form-group">
							{{Form::label('Contraseña')}}
							{{Form::password('password', array('class' => 'form-control'))}}
							<span class="help-block">{{ $errors->first('password') }}</span>
						</div>
						<div class="form-group">
							<p>{{Form::submit('Ingresar', array('class' => 'btn btn-default'));}}<a href="/registro" class="btn btn-default">Registrarme</a></p>
						</div>
						<div><a href="/recordarpass" class="btn btn-default">Olvide mi contraseña</a></div>
					</div>
			</div>
  
	</div>
	
    

	{{Form::close()}}

@stop


<!--

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        {{ HTML::style('css/bootstrap.css'); }}
    </head>
    <body>
		<div class="well" >
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    {{-- Preguntamos si hay algún mensaje de error y si hay lo mostramos  --}}
                    @if(Session::has('mensaje_error'))
                        <div class="alert alert-danger">{{ Session::get('mensaje_error') }}</div>
                    @endif
                    {{ Form::open(array('url' => '/login')) }}
                        <legend>Iniciar sesión</legend>
                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::text('email', Input::old('email'), array('class' => 'form-control')); }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}
                            {{ Form::password('password', array('class' => 'form-control')); }}
                        </div>
                        
                        {{ Form::submit('Enviar', array('class' => 'btn btn-primary')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
		</div>
        <script src="https://code.jquery.com/jquery.js"></script>
        {{ HTML::script('js/bootstrap.js'); }}
    </body>
</html>-->