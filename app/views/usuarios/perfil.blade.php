<html>
@extends('layouts.1')
<head>
	@include('includes.headMP')
</head>
@section('content')


	@if(Session::has('estado'))
		<h3>{{Session::get('estado')}}</h3></br>
	@endif
	
<body>	
	@if(Session::has('usuario_id'))
	<legend>Mi perfil</legend>
		<div class="row">
			<div class="col-md-6">
				<!--Nombre-->
					
						<div class="form-group">
							{{Form::label('Nombre Usuario')}}
							
							{{Form::text('nombre', Usuario::find(Session::get('usuario_id'))->username, array('readonly' => 'readonly', 'class' => 'form-control'))}}
							
							
						</div>
				  
					<!--Apellido-->
						<div class="form-group">
							{{Form::label('Apellido')}}
							
							{{Form::text('apellido', Usuario::find(Session::get('usuario_id'))->apellido, array('readonly' => 'readonly', 'class' => 'form-control'))}}
							
							
						</div>
                                   
					<!--Mail-->
                        <div class="form-group">
							{{Form::label('E-mail')}}
							
							{{Form::text('email', Usuario::find(Session::get('usuario_id'))->email, array('readonly' => 'readonly', 'class' => 'form-control'))}}
							
						</div>
  
  
  
  
			</div>
			<div class="col-md-6">
  					<!--Fecha de Nacimiento-->                  
						<div class="form-group">		
							{{Form::label('Fecha de Nacimiento')}}
							
							{{Form::text('nacimiento', Usuario::find(Session::get('usuario_id'))->nacimiento, array('readonly' => 'readonly', 'class' => 'form-control'))}}
														
						</div>						
               
					<!--Sexo-->
						<div class="form-group">
							{{Form::label('Sexo')}}		
							@if (Usuario::find(Session::get('usuario_id'))->sexo == 0 )
							{{Form::text('sexo', 'Masculino', array('readonly' => 'readonly', 'class' => 'form-control'))}}
							@else
							{{Form::text('sexo', 'Femenino', array('readonly' => 'readonly', 'class' => 'form-control'))}}
							@endif
						</div>
                
				
					<!--Provincias-->
						<div class="form-group">
							{{Form::label('Provincia')}}	
							{{Form::text('provincia', Usuario::find(Session::get('usuario_id'))->provincia, array('readonly' => 'readonly', 'class' => 'form-control'))}}
						</div>				
				
					<!--Ciudad--> 
                
						<div class="form-group">
							{{Form::label('Ciudad')}}
							{{Form::text('ciudad', Usuario::find(Session::get('usuario_id'))->ciudad, array('readonly' => 'readonly', 'class' => 'form-control'))}}
						</div>
  
			<a class="btn btn-info" href="/modificar_perfil"> Modificar Perfil</a>
			</div>
	</div>
	@else
	@endif
				
</body>
@stop
</html>	

