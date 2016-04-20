@extends('layouts.1')
	
<head>
	@include('includes.headAgregarEvento')
	@if(!Session::has('usuario_id'))
		@stop
		@else
	
	{{ HTML::script('js/datepicker.js') }}
	
	{{ HTML::style('css/datepicker.css') }}
	
	
	<script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script> 
	<!-- PARTE DEL MAPA-->
	<link href="../css/mapautilizado.css" rel="stylesheet">
	<script type="text/javascript" src="js/jsmapautilizadocrear.js"></script>
	

</head>

@section('content')
<div class="page-header">
    <div class="container" id="page">
    <h1>CREAR EVENTO</h1>
    </div>    
</div>

				@if(Session::has('crea'))
					<h3>{{Session::get('crea')}}</h3></br>
				@endif

<div class="jumbotron">
{{Form::open(['name' => 'formulario'], array('method'=>'POST','Action'=> '/MisEventoscrea' ,'role'=>'form','class'=>'form-horizontal'))}}

<fieldset>
			
			
			
			<body >
			<!--Nombre del evento-->
			<div class="row">
				<div class="form-group" >
						<div>{{Form::label('Nombre','',array('class'=>'col-lg-1 control-label'))}}</div>
						<div class="col-lg-6">
						{{Form::text('nombreevento','',array('class'=>'form-control'))}} 
						</div>						      
				</div>				
			</div>
			<div class="bg-danger">{{$errors->first('nombreevento')}}</div>       
	
			<!--FECHA Y HORA-->
			
          
				<div class="row">
				<div class="form-group"  >
					<div>{{Form::label('Fecha','',array('class'=>'col-lg-1 control-label'))}}</div>
					<div class="col-lg-10">
					{{ Form::input('date','fecha',' ',array( 'date_format' => 'yyyy-mm-dd')) }}					
					</div>										      
				</div>
				</div>
				<div class="bg-danger">{{$errors->first('fecha')}}</div>       
			
			
			<div class="row">
				<div class="form-group"  >
						<div>{{Form::label('Hora','',array('class'=>'col-lg-1 control-label'))}}</div>
						<div class="col-lg-10">
						{{ Form::input('time','hora','',array( 'time_format' => 'HH:mm:ss')) }}					
						</div>						        
				</div>
			</div>
			<div class="bg-danger">{{$errors->first('hora')}}</div>     
	
			<div class="row">
				<div class="form-group" >
						<div>{{Form::label('Descripcion','',array('class'=>'col-lg-1 control-label'))}}</div>
						<div class="col-lg-6">
						{{Form::textarea('descripcion','',array('class'=>'form-control'))}}
						</div> 						  
				</div>
			</div>
			<div class="bg-danger">{{$errors->first('descripcion')}}</div>           
	
		
			</br>
			<!--ACA INSERTO LO DEL MAPA-->
			<label> Direccion - Ubicacion Geografica </label>
			</br>
			<label> Si ingresa direccion por "aceptar direccion", recuerde escribir de la siguiente manera: Ciudad + Calle + N°</label>
			</br>
				
					<div>
					<input class="form-group" id="direccion" name="direccion" type="textbox" value="" placeholder="Ciudad+Calle+N°" title="Ingresar direccion. Ejemplo: bariloche moreno 40" style="width: 30em">
					<input type="button" value="Aceptar Direccion" onclick="codeAddress()" title="Localiza la direccion en el mapa">
					</div>				
					<div class="form-group" class="col-lg-2 form-control" id="map-canvas"></div>
					
					<!--campos donde guardamos los datos-->
					<input hidden type="text" readonly name="lat" id="lat" />
					<input hidden type="text" readonly name="lng" id="long"/>
			
			
			</br> 
			
			<div class="row" class="form-group">
				<div class="form-group" class="col-lg-4 control-label" >
						<div>{{Form::label('Adultos','',array('class'=>'col-lg-1 control-label'))}}</div>
						<div class="col-lg-6">
						{{ Form::input('number', 'adultosmax') }}
						</div>						      
				</div>
			</div>
			<div class="bg-danger">{{$errors->first('adultosmax')}}</div>       

			<div class="row" class="form-group">
				<div class="form-group" class="col-lg-4 control-label" >
						<div>{{Form::label('Menores','',array('class'=>'col-lg-1 control-label'))}}</div>
						<div class="col-lg-6">
						{{ Form::input('number', 'menoresmax') }}
						</div>						    
				</div>
			</div>
			<div class="form-group" class="bg-danger">{{$errors->first('menoresmax')}}</div>         
			
	
			
	
			
			
			<div class="form-group" class="col-lg-4 col-lg-offset-2">
				<p>{{Form::submit('Crear Evento', array('class' => 'btn btn-primary'))}}</p>
			</div>
		</fieldset>	
{{Form::close()}}
</div>
</body>	
			
@endif
@stop
