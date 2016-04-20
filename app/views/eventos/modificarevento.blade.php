<html>
@extends('layouts.1')
<head>
	@include('includes.headME')
	
	@if(!Session::has('usuario_id'))
		@stop
		@else
	
	{{ HTML::script('js/datepicker.js') }}
	
	{{ HTML::style('css/datepicker.css') }}
	<script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script> 
	<!-- COSAS DEL MAPA-->
	
	<script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script> 
	<link href="../css/mapautilizado.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jsmapaModificar.js"></script>
	
		
	
</head>
@section('content')
<div class="page-header">
    <div class="container" id="page">
		<h1>Modificar Evento</h1>
    </div>    
</div>
<div class="jumbotron">

	{{Form::open(array('method' => 'POST', 'class'=>'form-horizontal', 'action' =>'EventoController@modificarelevento' , 'role' => 'form'))}}
	<fieldset>
	
		<body>
			<div class="row">
				<div class="col-md-6">
					<input name="capturaevent" type="hidden" value="{{$eventomodid->id}}">				                                       
					<!--Nombre Evento-->
						
							<div class="form-group">
								<div class="col-md-4">{{Form::label('Nombre Evento')}}</div>					
								<div class="col-md-4">{{Form::text('nombre',$eventomodid->nombre , array( 'class' => 'form-control'))}} </div><!--asi es para poder hacer lo mismo con el modificar-->
															
							</div>				  
													  
						<!--Fecha-->
							<div class="form-group">
								<div class="col-md-4">{{Form::label('Fecha')}}	</div>						
								<div class="col-md-4">{{ Form::input('date','fecha',$eventomodid->fecha ,array( 'date_format' => 'yyyy-mm-dd')) }}</div>					
							</div>  
						<!--Hora-->
							<div class="form-group">
								<div class="col-md-4">{{Form::label('Hora')}}</div>					
								<div class="col-md-4">{{ Form::input('time','hora',$eventomodid->hora,array( 'time_format' => 'HH:mm:ss')) }}</div>				
							</div>						
						<!--Descripcion-->
							<div class="form-group">
								<div class="col-md-4">{{Form::label('Descripcion')}}</div>								
								<div class="col-md-8">{{Form::textarea('descripcion',$eventomodid->descripcion,array('class'=>'form-control'))}}</div>								
							</div>
							
							<div class="form-group"  >								
								<div class="col-md-4">{{Form::label('Adultos')}}</div>								
								<div class="col-md-4">{{ Form::input('number','adultosmax',$eventomodid->adultosmax,array('class'=>'form-control')) }}</div>
							</div>		
					
							<div class="form-group"  >
								<div class="col-md-4">{{Form::label('Menores')}}</div>								
								<div class="col-md-4">{{ Form::input('number','menoresmax', $eventomodid->menoresmax,array('class'=>'form-control')) }}</div>
							</div>
	  
  
  
				</div>
			
  					<!--Mapa de Gmap-->                  
					<div class="col-md-6">
						<div class="form-group">
						<div><label align="center"> Si modifica direccion por "aceptar direccion", recuerde escribir de la siguiente manera: Ciudad + Calle + N°</label></div>
						<div class="col-md-4"><input id="direccion" name="direccion" type="textbox" value="{{$eventomodid->direccion}}" title="Ingresar direccion. Ejemplo: bariloche moreno 40"></div>				
						<div class="col-md-4"><input type="button" value="Aceptar Direccion" onclick="codeAddress()" title="Localiza la direccion en el mapa"></div>						
						</div>
						
						<div  id="map-canvas" ></div>	
							<!--campos donde guardamos los datos-->
						<div>
							<p></p>
						<p><!--hidden<label>Latitud: --></label><input hidden type="text" readonly name="lat" id="lat" value="{{$eventomodid->latitud}}"/></p>
						<p><!--<label> Longitud:--></label> <input hidden type="text" readonly name="lng" id="long" value="{{$eventomodid->longitud}}"/></p>
						</div>
					</div>					
			</div>
			<div class="row" align="right">{{Form::submit('Modificar', array('class' => 'btn btn-success'))}}	</div>
	</fieldset>
	{{Form::close()}}	
	</body>
</div>
	

				
@endif
@stop
</html>	

