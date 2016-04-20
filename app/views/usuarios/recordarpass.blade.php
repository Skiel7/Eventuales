@extends('layouts.default')
<head>
	@include('includes.headRC')
</head>
@section('content')

	{{Form::open(array('method' => 'POST', 'url' => '/recordarpass', 'role' => 'form'))}}

	@if(Session::has('estado'))
		<h3>{{Session::get('estado')}}</h3></br>
	@endif
<body>	
<div class="container" > 	
	<div class="col-lg-4">
	<legend>Recordar Contraseña</legend>
		<div class="form-group">
			
				{{Form::label('Nombre')}}
				{{Form::text('nombre', '', array('class' => 'form-control'))}}
				
				<span class="help-block">{{ $errors->first('nombre') }}</span>
		</div>
		<div class="form-group">
			
				{{Form::label('Email')}}
				{{Form::text('email', '', array('class' => 'form-control'))}}				
				<span class="help-block">{{ $errors->first('email') }}</span>
		</div>
		
	
		<div class="form-group">
			<p>{{Form::submit('Enviar', array('class' => 'btn btn-default'))}}</p>
		</div>
	</div>

	{{Form::close()}}
</div>
</body>
@stop
	

