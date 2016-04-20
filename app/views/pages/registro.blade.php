<html>
@extends('layouts.1')
<head>
	@include('includes.headR')
</head>
@section('content')

		{{Form::open(array('method'=>'POST','url'=>'/registro','role'=>'form'))}} 

				@if(Session::has('registro'))
					<div class="alert alert-danger">
					<h3>{{Session::get('registro')}}</h3></br>
					</div>
				@endif
	
<body>	
	<div class="container" > 
    	<div class="col-lg-6">
			<!--{{Form::open()}}-->
			
			
				
					<legend>Registro</legend>
					
					<!--Nombre-->
						<div class="form-group">
							{{Form::label('Nombre Usuario')}}
							{{Form::text('username', '', array('class' => 'form-control'))}}
					        <div class="bg-danger">{{$errors->first('username')}}</div>                               
						</div>
				  
					<!--Apellido-->
						<div class="form-group">
							{{Form::label('Apellido')}}
							{{Form::text('apellido', '', array('class' => 'form-control'))}}
							<div class="bg-danger">{{$errors->first('apellido')}}</div>                               
						</div>
                                   
					<!--Mail-->
                        <div class="form-group">
							{{Form::label('E-mail')}}
							{{Form::text('email', '', array('class' => 'form-control'))}}   
							<div class="bg-danger">{{$errors->first('email')}}</div>                               
						</div>
				
					<!-- Contraseña -->
						<div class="form-group">
							{{Form::label('Contraseña')}}
							{{Form::password('password', array('class' => 'form-control'))}}	
							<div class="bg-danger">{{$errors->first('password')}}</div>                               							
						</div>
				
					<!--confirmacion password-->
						<div class="form-group">
							{{Form::label('verificacion', 'Repita la Contraseña')}}
							{{Form::password('verificacion', array('class' => 'form-control'))}}	
							<div class="bg-danger">{{$errors->first('verificacion')}}</div>                               
						</div>
				
				
					<!--Fecha de Nacimiento-->                  
						<div class="form-group">					
							<label for="inputFecha" class="control-label" >Fecha de Nacimiento</label>						
								<input class="form-control" id="dateFecha" type="date" name="nacimiento" >					
						</div>
						<div class="bg-danger">{{$errors->first('nacimiento')}}</div>                               
               
					<!--Sexo-->
						<div class="form-group">
							{{Form::label('sexo', 'Femenino')}}
							{{Form::radio('sexo', '1', 'selected')}}
           
							{{Form::label('sexo', 'Masculino')}}
							{{Form::radio('sexo', '0')}}
						</div>
                
				
					<!--Provincias-->
						<div class="form-group">
							{{Form::label('provincia','Provincia')}}
							{{Form::select('provincia', array('Buenos Aires' => 'Buenos Aires', 'Catamarca' => 'Catamarca', 'Chaco'=>'Chaco', 'Chubut'=>'Chubut', 'Cordoba'=>'Cordoba', 'Corrientes'=>'Corrientes', 'Entre Rios'=>'Entre Rios', 'Formosa'=>'Formosa', 'Jujuy'=>'Jujuy', 'La Pampa'=>'La Pampa', 'La Rioja'=>'La Rioja', 'Mendoza'=>'Mendoza', 'Misiones'=>'Misiones', 'Neuquen'=>'Neuquen', 'Rio Negro'=>'Rio Negro', 'Salta'=>'Salta', 'San Juan'=>'San Juan', 'San Luis'=>'San Luis', 'Santa Cruz'=>'Santa Cruz', 'Santa Fe'=>'Santa Fe', 'Santiago del Estero'=>'Santiago del Estero', 'Tierra del Fuego'=>'Tierra del Fuego', 'Tucuman'=>'Tucuman' ));}}
							<div class="bg-danger">{{$errors->first('provincia')}}</div>                               
						</div>
				
				
					<!--Ciudad--> 
                
						<div class="form-group">
							{{Form::label('Ciudad')}}
							{{Form::text('ciudad', '', array('class' => 'form-control'))}}	
							<div class="bg-danger">{{$errors->first('ciudad')}}</div>                               
						</div>
								
					<!--Textarea-->
						<div class="form-group">					
							<label for="textArea" class="control-label">Terminos y Condiciones </br></label>
							<textarea class="form-control " rows="5" id="textArea" disabled="disabled">TERMINOS Y CONDICIONES
La utilización de nuestro sitio implica su aceptación plena y sinreservas a todas y cada una de las disposiciones incluidas en este Aviso Legal, por lo que si usted no está de acuerdo con cualquiera de las condiciones aquí establecidas, no deberá usar u/o acceder a este sitio.
Reservamos el derecho a modificar esta Declaración de Privacidad en cualquier momento. Su uso continuo de cualquier porción de este sitio tras la notificación o anuncio de tales modificaciones constituirá su aceptación de tales cambios
							</textarea>             				
						</div>
			   
					<!--CheckBox-->
						<div class="form-group">
							<div class="col-lg-10">
								{{Form::checkbox('terms', 'true')}}
								{{Form::label('Acepto terminos y condiciones')}}
							</div>            
								<div class="bg-danger">{{$errors->first('terms')}}</div>                               
						</div>
			   
					<!--Boton-->
						<div class="form-group">
							<div class="col-lg-10">
								{{Form::submit('Aceptar')}}
							</div>
						</div>
				
			</div>
          {{Form::close()}}
			
        
	</div>
      <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
    <script src="js/jquery2-0-0.min.js"></script>
    <script src="js/jquery.validate.js"></script>
	<script src="js/validaciones.js"></script>-->
    
	
</body>
@stop
</html>	

