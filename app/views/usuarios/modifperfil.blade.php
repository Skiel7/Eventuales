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
	{{Form::open(array('method'=>'POST','url'=>'/modificar_perfil','role'=>'form'))}} 
	
	<legend>Actualizacion de Perfil</legend>
		<input name="capturauser" type="hidden" value="{{Session::get('usuario_id')}}">		
		
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
							
							{{Form::text('apellido', Usuario::find(Session::get('usuario_id'))->apellido, array('readonly' => 'readonly','class' => 'form-control'))}}
							
							
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
							
							{{Form::text('nacimiento', Usuario::find(Session::get('usuario_id'))->nacimiento, array('readonly' => 'readonly','class' => 'form-control'))}}
														
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
							
							{{Form::select('provincia', array('Buenos Aires' => 'Buenos Aires', 'Catamarca' => 'Catamarca', 'Chaco'=>'Chaco', 'Chubut'=>'Chubut', 'Cordoba'=>'Cordoba', 'Corrientes'=>'Corrientes', 'Entre Rios'=>'Entre Rios', 'Formosa'=>'Formosa', 'Jujuy'=>'Jujuy', 'La Pampa'=>'La Pampa', 'La Rioja'=>'La Rioja', 'Mendoza'=>'Mendoza', 'Misiones'=>'Misiones', 'Neuquen'=>'Neuquen', 'Rio Negro'=>'Rio Negro', 'Salta'=>'Salta', 'San Juan'=>'San Juan', 'San Luis'=>'San Luis', 'Santa Cruz'=>'Santa Cruz', 'Santa Fe'=>'Santa Fe', 'Santiago del Estero'=>'Santiago del Estero', 'Tierra del Fuego'=>'Tierra del Fuego', 'Tucuman'=>'Tucuman' ),Usuario::find(Session::get('usuario_id'))->provincia,array('class' => 'form-control'));}}
						</div>				
				
					<!--Ciudad--> 
                
						<div class="form-group">
							{{Form::label('Ciudad')}}
							{{Form::text('ciudad', Usuario::find(Session::get('usuario_id'))->ciudad, array('required' => 'required', 'class' => 'form-control'))}}
						</div>
  
  
			</div>
	</div>
	<div class="row" align="right">{{Form::submit('Modificar Perfil', array('class' => 'btn btn-success'))}}	</div>
	{{Form::close()}}	
	@else
	@endif
				
</body>

@stop
</html>	
