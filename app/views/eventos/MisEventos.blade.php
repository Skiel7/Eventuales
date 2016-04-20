<html>
@extends('layouts.default')

<head>
@include('includes.headMisEventos')
	@if(!Session::has('usuario_id'))
		@stop
		@else
		
</head>
@section('content')

<body>
    <!--le da el cuerpo al body (valga la redundancia)--> <!--modificado en el css box-shadow-->



	<!--@$Nombre=$_REQUEST['Nombre'];
	@$Email=$_REQUEST['Email'];
	@$FechaNacimiento="1990-05-21";
	@$Sexo="Masculino";
	@$Provincia=$_REQUEST['Provincia'];
	@$Ciudad=$_REQUEST['Ciudad'];
	@$Password="12345";-->
	

    <div class="container"> 
    	<div class="well"> 
	        <div><h1 id="type"> Mis Eventos</h1></div>
            <div align="right"><a href="/crearEvento" class="btn btn-primary" >Agregar Evento +</a></div><br>		

            <table class='table table-striped table-hover'>
            	<thead>
            		
            		<th>NOMBRE</th>
            		<th>LUGAR</th>
            		<th>FECHA</th>
            		<th>ORGANIZADOR</th>
            		<th>ACCIONES</th>
            	</thead>
            	<tbody>
            	@foreach ($listaDeEventos as $evento )
					@if ($evento->creador == Session::get('usuario_id'))
						<tr>
            				<td>{{$evento->nombre}}</td>
            				<td>{{$evento->direccion}}</td>
            				<td>{{$evento->fecha}}</td>
            				<td>Usted</td> 
            				<td>
								@if ($evento->creador == Session::get('usuario_id'))
										<a class="btn btn-success" href="/verevento/{{$evento->id}}"  title="Vista del evento"><span class="glyphicon glyphicon-eye-open"></span>
										<i class="icon-envelope"></i>Ver
										</a>
								
										<a class="btn btn-info" href="/modificarevento/{{$evento->id}}" title="Modifica el evento">
										<i class="icon-envelope"></i>Modificar
										</a>
								
										<a class="btn btn-danger" href="eliminarevento/{{$evento->id}}" title="Borra el evento">
										<i class="icon-envelope"></i>Eliminar
										</a>
									
								@endif								
								</span>
							</td>		
						</tr>
					@else
						@foreach($listaDeInvitados as $invitado)
							@if ($invitado->idusuario == Session::get('usuario_id'))
									@if ($invitado->idevento == $evento->id)
									<tr>
										<td>{{$evento->nombre}}</td>
										<td>{{$evento->direccion}}</td>
										<td>{{$evento->fecha}}</td>
										<td>
										@foreach ($listaDeUsuarios as $usuario)
											@if ($usuario->id==$evento->creador)
												
											{{$usuario->username}}
											@endif
										@endforeach
										</td> 
										<td>
								
										<a class="btn btn-success" href="/verevento/{{$evento->id}}"  title="Vista del evento"><span class="glyphicon glyphicon-eye-open"></span>
										
										<i class="icon-envelope"></i>Ver
										</a>
																
										</span>
										</td>		
									</tr>
									@endif
									
							@endif
						@endforeach
											
					@endif
				@endforeach
					
					
            		
            	</tbody>
            </table>

 			




        </div>
  </div>
     
	
</body>

@endif
@stop

    
</html>