<html>
@extends('layouts.1')
<head>
	@include('includes.headvistaevento')
	
	
</head>
@section('content')


	@if(Session::has('estado'))
		<h3>{{Session::get('estado')}}</h3></br>
	@endif
	
<body>	
@if(Session::has('usuario_id'))
		<legend>Evento</legend>
				@if ($objEvento->cerrado == 0)
					<div><h2>EL EVENTO SE ENCUENTRA ABIERTO</h2></div>
				@endif
				@if ($objEvento->cerrado == 1)
					<div><h2>EL EVENTO SE ENCUENTRA CERRADO</h2></div>				
				@endif
			<div class="row">
				<div class="col-md-6">
					<!--Nombre Evento-->
						
							<div class="form-group">
								{{Form::label('Nombre Evento')}}							
								{{Form::text('nombre', $objEvento->nombre, array( 'readonly' => 'readonly', 'class' => 'form-control'))}} <!--asi es para poder hacer lo mismo con el modificar-->
														
							</div>
					  
														   
						<!--Fecha-->
							<div class="form-group">
								{{Form::label('Fecha')}}							
								{{Form::text('fecha', $objEvento->fecha , array('readonly' => 'readonly', 'class' => 'form-control'))}}							
							</div>
	  
						<!--Hora-->
							<div class="form-group">
								{{Form::label('Hora')}}							
								{{Form::text('hora', $objEvento->hora, array('readonly' => 'readonly', 'class' => 'form-control'))}}
								
							</div>
							
						<!--Descripcion-->
							<div class="form-group">
								{{Form::label('Descripcion')}}
								
								{{Form::text('descripcion', $objEvento->descripcion, array('readonly' => 'readonly', 'class' => 'form-control'))}}
								
							</div>
								
							<!--Lugar-->
							<div class="form-group">
								{{Form::label('Lugar')}}							
								{{Form::text('direccion', $objEvento->direccion, array('id' => 'direccion', 'readonly' => 'readonly', 'class' => 'form-control'))}}							
							</div>
	  
	  
				</div>
				<div class="col-md-6">
						<!--Mapa de Gmap-->                  
							<div id="map-canvas"></div>
								</br>
								<!--<div><p><label>Latitud: </label>--><input type="hidden" type="text" readonly name="lat" id="lat" value="{{$objEvento->latitud}}"/><!--</p></div>-->
								<!--<div><p><label> Longitud:</label>--> <input type="hidden" type="text" readonly name="lng" id="long" value="{{$objEvento->longitud}}"/><!--</p></div>-->
				</div>
		</div>

		
		</br>
	@if($usuarioInvitado->rol == 0)	<!--Si es organizador (1)-->
		@if ($objEvento->cerrado == 0) <!--Si esta abierto-->
											<div>
												{{Form::open(array('method' => 'POST', 'class'=>'form-horizontal', 'action' =>'EventoController@cerrarevento' , 'role' => 'form'))}}
													<div>														
														<input name="captura" type="hidden" value="{{$objEvento->id}}">														
														<div>
															{{Form::submit('Cerrar Evento', array('class' => 'btn btn-info'))}}														
														</div>
													</div>
												{{Form::close()}}												
											</div> 
		<h1> CUENTAS</h1>	
		<!-- aca muestro las cuentas si el evento esta cerrado-->
		
		
							<div class="row">
							  <div class="col-xs-12 col-md-8">
								<ul >
									<li class="accordion-container" >
										<div input id="costofijoinvitado1" type="radio" class="accordion-header" name="" checked="" value="0"> Valor fijo por invitado</div>
										<div class="accordion-content"><p>Se establece un valor fijo de costo por invitado</p></div>
									</li>
									
									<li class="accordion-container">
										<div input id="costofijo1" type="radio" class="accordion-header" name="" checked="" value="1">Se establece un costo fijo segun asistente</div>
										<div class="accordion-content"><p>Se distinguen dos valores fijos de costo para cada uno de los tipos de asistentes respectivamente, adultos y menores, tambien independientemente del costo total del evento.</p></div>
									</li>
									
									
									<li class="accordion-container">
										<div input id="division1" type="radio" class="accordion-header" name="" checked="" value="2">Se divide lo gastado en partes iguales</div>
										<div class="accordion-content"><p>Se divide el costo total del evento entre todos los asistentes sin distincion alguna.</p></div>
									</li>
									<li class="accordion-container">
										<div input id="divisionasistentegastado1" type="radio" class="accordion-header" name="" checked="" value="3">Se divide lo gastado segun asistentes</div>
										<div class="accordion-content"><p>Se establece un valor diferente de costo para cada uno de los tipos de asistentes, adultos y menores, estos valores se calculan a partir del costo total del evento, y un porcentaje de este correspondiente a los asistentes menores, segun se lo indique debajo.</p></div>
									</li>
									<li class="accordion-container">
										<div input id="divisiongastado1" type="radio" class="accordion-header" name="" checked="" value="4">Se divide un valor fijo en partes iguales</div>
										<div class="accordion-content"><p>Se divide un valor fijo que representa el costo total, entre todos los asistentes sin distincion alguna.</p></div>
									</li>
									<li class="accordion-container">
										<div input id="divisionasistentefijo1" type="radio" class="accordion-header" name="" checked="" value="5">Se divide un valor fijo segun asistente</div>
										<div class="accordion-content"><p>Se establece un valor diferente de costo para cada uno de los tipos de asistentes, adultos y menores, estos valores se calculan a partir de un valor fijo que represental costo total del evento, y el costo correspondiente a los asistentes menores, se calculará como un porcentaje 
																	 del costo de un asistente adulto, segun se lo indique debajo.</p></div>
									</li>
								</ul>		
								</div>
								
								<div class="col-xs-6 col-md-4">
									<!--dependiendo de la opcion muestro-->
										
											<div id="costofijoinvitado2" class="form-group" class="col-lg-4 control-label" hidden="true">
												{{Form::open(array('method' => 'POST', 'class'=>'form-horizontal', 'action' =>'EventoController@Cuentas' , 'role' => 'form'))}}
													<div class="well">
														<div>
														{{Form::label('Costo por invitado','')}}
														</div>
														<div>
														
															<input  type="number" name="costo" class="" min="0" required="required">
														</div>
														<input name="captura" type="hidden" value="{{$objEvento->id}}">	
														<input name="capturametodo" type="hidden" value="1">
														<div>
															{{Form::submit('calcular', array('class' => 'btn btn-info'))}}
															
														</div>
													</div>
												{{Form::close()}}
												
											</div> 
											
										
											<div id="costofijo2" class="form-group" class="col-lg-4 control-label" hidden="true" >
											{{Form::open(array('method' => 'POST', 'class'=>'form-horizontal', 'action' =>'EventoController@Cuentas' , 'role' => 'form'))}}
												<div class="well">
													<div>
													{{Form::label('Menores','')}}
													</div>
													<div>													
														<input  type="number" name="costomen" class="" min="0" required="required">
													</div>
													</br>
													<div>
													{{Form::label('Adultos','')}}
													</div>
													<div>
													
														<input  type="number" name="costoadul" class="" min="0" required="required">
													</div>
													<input name="captura" type="hidden" value="{{$objEvento->id}}">	
													<input name="capturametodo" type="hidden" value="2">
													<div>
															{{Form::submit('calcular', array('class' => 'btn btn-info'))}}
													</div>
												</div>
											{{Form::close()}}	
											</div>
										
										
											<div id="division2" class="form-group" class="col-lg-4 control-label" hidden="true" >
											{{Form::open(array('method' => 'POST', 'class'=>'form-horizontal', 'action' =>'EventoController@Cuentas' , 'role' => 'form'))}}
												<div class="well">
													<div>
															<input name="captura" type="hidden" value="{{$objEvento->id}}">	
															<input name="capturametodo" type="hidden" value="3">
															{{Form::submit('calcular', array('class' => 'btn btn-info'))}}
													</div>
												</div>
											{{Form::close()}}					
											</div>
										
										
											<div id="divisionasistentegastado2" class="form-group" class="col-lg-4 control-label" hidden="true" >
											{{Form::open(array('method' => 'POST', 'class'=>'form-horizontal', 'action' =>'EventoController@Cuentas' , 'role' => 'form'))}}
												<div class="well">
													 <!--aca si los niños son 80%...los adultos son un 20%-->
													<div>
													{{Form::label('Menores','')}}
													</div>
													<div>													
													<input id="pm4" type="number" name="costomen" class="" min="0" max="100" onchange="porcentajeMenor4(this.value)" required="required" >
													</div>
													<div>
													{{Form::label('Adultos','')}}
													</div>
													<div>													
													<input id="pa4" type="number" name="costoadul" class="" min="0" max="100" onchange="porcentajeAdultos4(this.value)" required="required">
													</div>
													<div>
															<input name="captura" type="hidden" value="{{$objEvento->id}}">	
															<input name="capturametodo" type="hidden" value="4">
															{{Form::submit('calcular', array('class' => 'btn btn-info'))}}
													</div>
												</div>
											{{Form::close()}}	
											</div>
										
										
											<div id="divisiongastado2" class="form-group" class="col-lg-4 control-label" hidden="true">
											{{Form::open(array('method' => 'POST', 'class'=>'form-horizontal', 'action' =>'EventoController@Cuentas' , 'role' => 'form'))}}
													<div class="well">	
														<div>
															{{Form::label('Valor fijo','')}}
														</div>
														<div>
																
															<input  type="number" name="CFijo" class="" min="0" required="required">	
														</div>
														<div>
															<input name="captura" type="hidden" value="{{$objEvento->id}}">	
															<input name="capturametodo" type="hidden" value="5">
															{{Form::submit('calcular', array('class' => 'btn btn-info'))}}
														</div>
													</div>
											{{Form::close()}}	
											</div>
										
										
													<div id="divisionasistentefijo2" class="form-group" class="col-lg-4 control-label" hidden="true" >
													{{Form::open(array('method' => 'POST', 'class'=>'form-horizontal form-f6', 'action' =>'EventoController@Cuentas' , 'role' => 'form'))}}
														<div>
															{{Form::label('Valor a dividir','')}}
														</div>													
														<div>
															
															<input  type="number" name="valortotal" class="" min="1" required="required">	
														</div>
														<div>
															{{Form::label('Adultos','')}}
														</div>
														<div>														
															
															<input id="pa6" type="number" name="porcentajeadulto" class="f6-item-qty1" min="0" max="100" onchange="porcentajeAdultos(this.value)" required="required">
														</div>
														<div>
															{{Form::label('Menores','')}}
														</div>
														<div>
															
															<input id="pm6" type="number" name="porcentajemenor" class="f6-item-qty2" min="0" max="100" onchange="porcentajeMenor(this.value)" required="required">
														</div>														
														<div>
															<input name="captura" type="hidden" value="{{$objEvento->id}}">	
															<input name="capturametodo" type="hidden" value="6">
															{{Form::submit('calcular', array('class' => 'btn btn-info'))}}
														</div>
													{{Form::close()}}
													</div>
												
								</div>
										
										
							</div>
								
								
							
		@else  <!-- si esta cerrado-->
						
											<div>
												{{Form::open(array('method' => 'POST', 'class'=>'form-horizontal', 'action' =>'EventoController@abrirevento' , 'role' => 'form'))}}
													<div>
														
														<input name="captura" type="hidden" value="{{$objEvento->id}}">														
														<div>
															{{Form::submit('Abrir Evento', array('class' => 'btn btn-info'))}}														
														</div>
													</div>
												{{Form::close()}}												
											</div> 		
											@if ($objEvento->notificaEI == 0)
											<div><a class="btn btn-info" href="/listadecompra/{{$objEvento->id}}" title="listaDeItemsCompra"><i class="icon-envelope"></i>Enviar la lista de compras</a></div>
											@endif
		@endif <!--finaliza el if de si esta cerrado o no el evento-->
		<div><h1>El metodo de cuentas es:</h1></div>
		@if ($objEvento->metodocuenta == 0)
			<div> <h4> No se ha seleccionado un metodo </h4> </div>
		@endif
		@if ($objEvento->metodocuenta == 1)
			<div> <h4> Valor fijo por invitado </h4> </div>
		@endif
		@if ($objEvento->metodocuenta == 2)
			<div> <h4> Costo fijo segun asistente </h4> </div>
		@endif
		@if ($objEvento->metodocuenta == 3)
			<div> <h4> Se divide lo gastado en partes iguales </h4> </div>
		@endif
		@if ($objEvento->metodocuenta == 4)
			<div> <h4> Se divide lo gastado segun asistentes </h4> </div>
		@endif
		@if ($objEvento->metodocuenta == 5)
			<div> <h4> Se divide un valor fijo en partes iguales </h4> </div>
		@endif
		@if ($objEvento->metodocuenta == 6)
			<div> <h4> Se divide un valor fijo segun asistente </h4> </div>
		@endif
	@else <!-- si no es organizador ve solo si el evento esta cerrado, las cuentas-->
			
			<div><h1>El metodo de cuentas es:</h1></div>
		@if ($objEvento->metodocuenta == 0)
			<div> <h4> No se ha seleccionado un metodo </h4> </div>
		@endif	
		@if ($objEvento->metodocuenta == 1)
			<div> <h4> Valor fijo por invitado </h4> </div>
		@endif
		@if ($objEvento->metodocuenta == 2)
			<div> <h4> Costo fijo segun asistente </h4> </div>
		@endif
		@if ($objEvento->metodocuenta == 3)
			<div> <h4> Se divide lo gastado en partes iguales </h4> </div>
		@endif
		@if ($objEvento->metodocuenta == 4)
			<div> <h4> Se divide lo gastado segun asistentes </h4> </div>
		@endif
		@if ($objEvento->metodocuenta == 5)
			<div> <h4> Se divide un valor fijo en partes iguales </h4> </div>
		@endif
		@if ($objEvento->metodocuenta == 6)
			<div> <h4> Se divide un valor fijo segun asistente </h4> </div>
		@endif

	@endif <!--Finaliza el end if del si es o no es organizador(1)-->
		
		
		<!--------------------PARTE DE LOS INVITADOS---------------------------------------------->
				
		<h1>INVITADOS</h1>
						
				<!-- Solo el organizador ve estos controles-->
				@if($usuarioInvitado->rol == 0)<!--Invitados SI (2)-->
					<!-- Aca deberia poner un if preguntando SI es el creador...que muestre todo... sino, es invitado y solo ve algunas cosas-->
				<div class="row">
					@if ($objEvento->cerrado == 0)
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar Invitado </button> 
					@endif
				</div>
				
				<!--Aca mi codigo de modal de Invitado-->
					<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content"> 
								<div class="modal-header">
									<button id="modalCloseInvitados" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<bold><h2>AGREGAR INVITADO</h2></bold>
								</div>
							{{Form::open(array('id' => 'agregarInvitadoForm','method' => 'POST', 'class'=>'form-horizontal', 'action' =>'InvitadoController@invitacion' , 'role' => 'form'))}}
								<div class="modal-body">								
									<!--Nombre-->
									<div class="form-group">
										<div class="col-lg-4">
											{{Form::label('Nombre')}}	
										</div>
											{{Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Nombre'))}}					                                       
									</div>								
									<!--Apellido-->				  
									<div class="form-group">
										<div class="col-lg-4">
											{{Form::label('Apellido')}}
										</div>
											{{Form::text('apellido', '', array('class' => 'form-control', 'placeholder' => 'Apellido'))}}					                                       
									</div>											   
									<!--Mail-->
									<div class="form-group">
										<div class="col-lg-4">
											{{Form::label('Email')}}
										</div>
											{{Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'email'))}}					                                       
									</div>
									<!--capturoevento-->															
											<input name="captura" type="hidden" value="{{$objEvento->id}}">						
									<!---->                
									<div class="form-group">
										{{Form::label('rol', 'Invitado')}}
										{{Form::radio('rol', '1', 'selected')}}
					   
										{{Form::label('rol', 'Organizador')}}
										{{Form::radio('rol', '0')}}
									</div>   			
								</div>
								<!-------->
								<div class="modal-footer">
									<div class="form-group">
										<div class="col-lg-10">
											{{Form::submit('Invitar', array('class' => 'btn btn-success'))}}
										</div>
											<a href="#" data-dismiss="modal" class="btn">Cancelar</a>
									</div>														
								</div>
							{{Form::close()}}							
							</div>
						</div>
					</div>				
				
				<div class="row">
					<table id="table-invitados" class="table table-striped">
							<thead>
								<tr>								
									<th><label for="Invitees_email" class="required">Nombre <span class="required">*</span></label></th>
									<th><label class="inline" >Organizador</label></th>
									<th><label class="inline" >Asistirá</label></th>
									<th><label class="inline" >Adultos</label></th>
									<th><label class="inline" >Niños</label></th>
									<th><label class="inline" >Costo</label></th>
									<th><label class="inline" >Gastó</label></th>
									<th><label class="inline" >Balance</label></th>					
									<th><label class="inline" >Saldado</label></th>
									<th><label class="inline" >ACCIONES</label></th>								
								</tr>
							</thead>
						<tbody>
								@foreach ($listaDeInvitados as $invitado )
								<tr id="invitado_{{$invitado->id}}">
									<td>
										<?php $user=Usuario::where('id','=',$invitado->idusuario)->get()[0]; ?>
													{{$user->username}} 
									</td>
									<td>@if ($invitado->rol == 0) Si @else No @endif</td>
									<td>@if ($invitado->confirmado ==1) Confirmado @else No Confirmado @endif</td>
									<td>{{$invitado->adultos}}</td>
									<td>{{$invitado->menores}}</td>
									<td>{{$invitado->costo}}</td>
									<td>{{$invitado->gasto}}</td>								
									<td>{{($invitado->gasto)-($invitado->costo) }}</td>
									<td>{{($invitado->costo)-($invitado->gasto) }}</td>								
									<td>
										@if ( ($invitado->confirmado == 0) && ($invitado->id == $usuarioInvitado->id))
											@if ($objEvento->cerrado == 0) <!--si el evento esta abierto muestro el boton-->
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAsistencia">Asistir </button> 
											<!--endif-->
											
				<!----------------------COMIENZO MODAL ASISTIR------------------------------------------------------>
										<div id="myModalAsistencia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<!--capturoevento e invitado-->
											<div class="modal-dialog">
												<div class="modal-content"> 
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<bold><h2>Asistir</h2></bold>
													</div>
													{{Form::open(array('method' => 'POST', 'class'=>'form-horizontal', 'action' =>'InvitadoController@asistir' , 'role' => 'form'))}}
														<div class="modal-body">
																	<input name="captura" type="hidden" value="{{$objEvento->id}}">				                                       
																	<input name="capturainvitado" type="hidden" value="{{$invitado->id}}">	
															<!--Adultos-->
																	<div class="form-group" class="col-lg-4 control-label" >
																		<label class="col-lg-2 control-label">Adultos:</label>
																		<input class="form-control" type="number" name="adultos"  min="0" max="100" required="required" style="width: 6em">
																		
																	</div>
																	<!--menores-->
																	<div class="form-group" class="col-lg-4 control-label" >
																		<label class="col-lg-2 control-label">Menores:</label>
																		<input class="form-control" type="number" name="menores"  min="0" max="100" required="required" style="width: 6em">
																							
																	</div>
																	<!--gasto-->
																	<div class="form-group" class="col-lg-4 control-label" >
																		<label class="col-lg-2 control-label">Gasto:</label>
																		<input class="form-control" type="number" name="gasto" min="0"  required="required" style="width: 6em">
																		
																	</div>
																	<!---->   														  
														</div>
														<!---------->
														<div class="modal-footer">
															<div class="form-group">
																<div class="col-lg-10">
																	{{Form::submit('Asistir', array('class' => 'btn btn-success'))}}
																	<a href="#" data-dismiss="modal" class="btn">Cancelar</a>
																</div>
															</div>																					
														</div>
													{{Form::close()}}
												</div>
											</div>
										</div><!-----FIN MODAL ASISTIR------------------------------------------------------------------------------------------->
												@endif
										@else
													@if ($objEvento->cerrado == 0)		
																@if ( $objEvento->creador == $invitado->idusuario)
																	@if ( $invitado->idusuario == Session::get('usuario_id'))
																		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAsisto">Actualizar mi asistencia</button> </td>
																	@endif
																<!----------------------COMIENZO MODAL ASISTO------------------------------------------------------>
																		<div id="myModalAsisto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																		<!--capturoevento e invitado-->
																			<div class="modal-dialog">
																				<div class="modal-content"> 
																					<div class="modal-header">
																						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																							<bold><h2>Asisto</h2></bold>
																					</div>
																					{{Form::open(array('id'=>'actualizoasistencia','method' => 'POST', 'class'=>'form-horizontal form-actualizoA', 'action' =>'InvitadoController@asisto' , 'role' => 'form'))}}
																						<div class="modal-body">
																									<input name="captura" type="hidden" value="{{$objEvento->id}}">				                                       
																									<input name="capturainvitado" type="hidden" value="{{$invitado->id}}">	
																							<!--Adultos-->
																							<div class="form-group" class="col-lg-4 control-label" >
																								<label class="col-lg-2 control-label">Adultos:</label>
																								<input class="form-control" type="number" name="adultos"  min="0" max="100" required="required" style="width: 6em">
																								
																							</div>
																							<!--menores-->
																							<div class="form-group" class="col-lg-4 control-label" >																								
																								<label class="col-lg-2 control-label">Menores:</label>
																								<input class="form-control" type="number" name="menores"  min="0" max="100" required="required" style="width: 6em">
																							</div>
																							<div class="form-group" class="col-lg-4 control-label" >
																								<label class="col-lg-2 control-label" >Gasto:</label>
																								<input class="form-control" type="number" name="gasto"  min="0"  required="required" style="width: 6em">
																							</div>														  
																						</div>
																						<!---------->
																						<div class="modal-footer">
																							<div class="form-group">
																								<div class="col-lg-10">
																									{{Form::submit('Asistir', array('class' => 'btn btn-success'))}}
																									<a href="#" data-dismiss="modal" class="btn">Cancelar</a>
																								</div>
																								
																							</div>					
																								
																						</div>
																					{{Form::close()}}
																				</div>
																			</div>
																		</div><!-----FIN MODAL ASISTO------------------------------------------------------------------------------------------->
											
																@else
																	
																	@if ($invitado->notificado == 0) <!--si no esta confirmado muestro el boton-->
																	<a class="btn btn-info" href="/mail/{{$invitado->id}}/{{$objEvento->id}}" title="Envia un email"><i class="icon-envelope"></i>Enviar Mail</a>
																	@endif
																
																@endif
													@endif
													@if ($objEvento->cerrado == 1)
														<!--<a class="btn btn-info" href="" title="Envia la cuenta"><i class="icon-envelope"></i>Enviar Cuentas</a><!--paso el id inv y id evento-->
														@if ($invitado->notificaEM == 0)
														<a class="btn btn-info" href="/cuentaindividual/{{$invitado->id}}/{{$objEvento->id}}" title="Envia un email de cuenta"><i class="icon-envelope"></i>Enviar Cuenta</a>
														@endif
													@endif
													@if ($objEvento->cerrado == 0)
															@if ($invitado->idusuario == $objEvento->creador)
															@else													
															{{Form::open(array('id'=>'eliminarInvitadoForm','method' => 'POST', 'class'=>'form-eliminarinvitado form-horizontal', 'action' =>'InvitadoController@delete_invitado' , 'role' => 'form'))}}
																<input name="capturainvitadoeliminar" type="hidden" value="{{$invitado->id}}">
																<input name="capturandoevento" type="hidden" value="{{$objEvento->id}}">	
															{{Form::submit('eliminar', array('class' => 'btn btn-danger', 'name' => 'eliminarInvitadoBtn'))}}
															{{Form::close()}}
															@endif
															
													
														<!--<a class="btn btn-danger" href="/eliminarinvitado/{{$invitado->id}}/{{$objEvento->id}}" title="Eliminar invitado"><i class="icon-envelope"></i>Eliminar</a>-->
													@endif
										@endif
									</td>		
								</tr>
								@endforeach						
						</tbody>
					</table>
				</div>
				
				@else
				
					<div class="row">
						<table id="table-invitados" class="table table-striped">
								<thead>
									<tr>
										
										<th><label for="Invitees_email" class="required">Nombre <span class="required">*</span></label></th>
										<th><label class="inline" >Organizador</label></th>
										<th><label class="inline" >Asistirá</label></th>
										<th><label class="inline" >Adultos</label></th>
										<th><label class="inline" >Niños</label></th>
										<th><label class="inline" >Costo</label></th>
										<th><label class="inline" >Gastó</label></th>
										<th><label class="inline" >Balance</label></th>					
										<th><label class="inline" >Saldado</label></th>
										<th><label class="inline" >Accion</label></th>
										
									</tr>
								</thead>
							<tbody>
									@foreach ($listaDeInvitados as $invitado )
									<tr id="invitado_{{$invitado->id}}">
										<td>
										<?php $user=Usuario::where('id','=',$invitado->idusuario)->get()[0]; ?>
													{{$user->username}}  
										</td>			
										<td>@if ($invitado->rol == 0) Si @else No @endif</td>
										<td>@if ($invitado->confirmado ==1) Confirmado @else No Confirmado @endif</td>
										<td>{{$invitado->adultos}}</td>
										<td>{{$invitado->menores}}</td>
										<td>{{$invitado->costo}}</td>
										<td>{{$invitado->gasto}}</td>
										<td>{{($invitado->gasto)-($invitado->costo) }}</td>
										<td>{{($invitado->costo)-($invitado->gasto) }}</td>
										<td>
										@if ( ($invitado->confirmado == 0) && ($invitado->id == $usuarioInvitado->id))
											@if ($objEvento->cerrado == 0)
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAsistencia">Asistir </button> </td>
											@endif
											<!--COMIENZO MODAL ASISTIR-->
											<div id="myModalAsistencia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<!--capturoevento e invitado-->
												<div class="modal-dialog">
													<div class="modal-content"> 
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<bold><h2>Asistir</h2></bold>
														</div>
														{{Form::open(array('id'=>'asistencia','method' => 'POST', 'class'=>'form-horizontal', 'action' =>'InvitadoController@asistir' , 'role' => 'form'))}}
															<div class="modal-body">
																			<input name="captura" type="hidden" value="{{$objEvento->id}}">				                                       
																			<input name="capturainvitado" type="hidden" value="{{$invitado->id}}">	
																	<!--Adultos-->
																	<div class="form-group" class="col-lg-4 control-label" >
																		<label class="col-lg-2 control-label">Adultos:</label>
																		<input class="form-control" type="number" name="adultos"  min="0" max="100" required="required" style="width: 6em">
																		
																	</div>
																	<!--menores-->
																	<div class="form-group" class="col-lg-4 control-label" >
																		<label class="col-lg-2 control-label">Menores:</label>
																		<input class="form-control" type="number" name="menores"  min="0" max="100" required="required" style="width: 6em">
																							
																	</div>
																	<!--gasto-->
																	<div class="form-group" class="col-lg-4 control-label" >
																		<label class="col-lg-2 control-label">Gasto:</label>
																		<input class="form-control" type="number" name="gasto" min="0"  required="required" style="width: 6em">
																		
																	</div>
																	<!---->   										
															</div>
															<div class="modal-footer">
																<div class="form-group">
																	<div class="col-lg-10">
																		{{Form::submit('Asistir', array('class' => 'btn btn-success'))}}
																		<a href="#" data-dismiss="modal" class="btn">Cancelar</a>
																	</div>
																	
																</div>					
																			
															</div>
														{{Form::close()}}
													</div>
												</div>
											</div><!-----FIN MODAL ASISTIR-->
										@endif

									</tr>
									@endforeach							
							</tbody>
						</table>
					</div>
				@endif <!--Invitados fin si (2)-->	

		
	<!-------------------------------------------------------------------------------------------------------------------------------------------------->
	<!-------------------------------------------------------------------------------------------------------------------------------------------------->		
	<!------------------------------ LISTA DE ITEMS----------------->
				<h1>ITEMS-LISTA</h1>				
        
			<!-- Solo el organizador ve estos controles-->
			@if($usuarioInvitado->rol == 0) <!--SI de lista (3)-->
					<!-- Aca SI es el creador puede agregar items... SINO si es invitado, que diga si lleva o no-->
				
				<div class="row">
					@if ($objEvento->cerrado == 0) <!--Si esta abierto el evento puedo agregar-->
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalItem">Agregar Item </button> 
					@endif
				</div>		
				<div class="row">		
				<table id="table-items" class="table table-striped">
						<thead>
							<tr>
								<th><label class="inline" >Item</label></th>
								<th><label class="inline" >Cantidad Requerida</label></th>
								<th><label for="Invitees_email" class="required">Lleva:cantidad <span class="required">*</span></label></th>							
								<th><label class="inline" >Falta</label></th>
								<th><label class="inline" >Acciones</label></th>
													
							</tr>
						</thead>
					<tbody >
							@foreach ($listaDeItems as $item )		
							<tr id="item_{{$item->id}}">
								<td>{{$item->nombre}}</td>
								<td>{{$item->cantidad}}</td>		
								
								<td>
									@foreach ($listaDeItemsOk as $itemok)
										@foreach ($listaDeInvitados as $invitado)
											@if ($invitado->idusuario == $itemok->idusuario)
												@if($item->id == $itemok->iditem)
													<?php $user=Usuario::where('id','=',$invitado->idusuario)->get()[0]; ?>
													{{$user->username}} <span>: {{$itemok->cantidad}}</span> 
													<br/>
												@endif	
											@endif
										@endforeach
									@endforeach
								</td>           
								<td>
									Faltan:
									<?php $faltan = $item->cantidad; ?>
									@foreach ($listaDeItemsOk as $itemok)
										@if ($itemok->iditem == $item->id)
											<?php $faltan = $faltan - $itemok->cantidad?>								
										@endif
									@endforeach
									{{$faltan}}
									
								</td>
								<td> 
									<!--PREGUNTAR SI NO HAY LISTA DE INVITADOS, NO SE ASIGNA-->
									@if ($objEvento->cerrado == 0)
										
									
										<div>
											<!--<button type="button" class="elimina" class="btn btn-danger" ">Eliminar </button>-->
											{{Form::open(array('id'=>'eliminarItemForm','method' => 'POST', 'class'=>'form-eliminar form-horizontal', 'action' =>'ItemController@delete_item' , 'role' => 'form'))}}
												<input name="capturaitemeliminar" type="hidden" value="{{$item->id}}">
												<input name="capturandoevento" type="hidden" value="{{$objEvento->id}}">	
											{{Form::submit('eliminar', array('class' => 'btn btn-danger', 'name' => 'eliminarItemBtn'))}}
											{{Form::close()}}
										</div>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAsigna{{$item->id}}">Asignar Item </button> 
									@endif
									
									<!-- MODAL -->
									<div id="myModalAsigna{{$item->id}}" class="modal fade form-asignar-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content"> 
														<div class="modal-header">
														
															<button id="modalCloseAsigna" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<bold><h2>Asignar Item</h2></bold>
														</div>
											{{Form::open(array('id' => 'asignarItemForm','method' => 'POST', 'class'=>'form-asigna form-horizontal', 'action' =>'ItemsokController@asignar' , 'role' => 'form'))}}
											<div class="modal-body">
								
												<!--Nombre-->
												<div class="form-group">									
													{{Form::label('Nombre Item')}}
													{{Form::text('nombre', $item->nombre, array('readonly' => 'readonly','class' => 'form-control', 'placeholder' => 'Nombre'))}}					                                       
												</div>											
											   
												<!--Mail-->
												<div class="form-group">								
													{{Form::label('Email')}}												
													{{Form::select('email', $combo, null, array('class' => 'form-control','class' => 'form-control asignar-item-mail', 'placeholder' => 'email'))}}
												</div>
											
												<div class="form-group">
													{{Form::label('Cantidad')}}									
													<!-- {{Form::input('number','cantidad')}}  -->
													<input type="number" name="cantidad" class="asignar-item-qty" min="0" max="50">
												</div>	
												<input name="capturaevitok" type="hidden" value="{{$objEvento->id}}">	
												<input name="capturaiditem" type="hidden" value="{{$item->id}}">	
											</div>
								
												<div class="modal-footer">
													<div class="form-group">
															<div class="col-lg-10">
																{{Form::submit('asignar', array('class' => 'btn btn-success'))}}
															</div>
														<a href="#" data-dismiss="modal" class="btn">Cancelar</a>
													</div>															
												</div>
											{{Form::close()}}
					
											</div>
										</div>
									</div>	
								<!----------------------- FIN MODAL -->
									
								</td>
								
							</tr>
							@endforeach
						
					</tbody>
				</table>
				</div>
				
			@else

				<div class="row">		
				<table id="table-items" class="table table-striped">
						<thead>
							<tr>
								<th><label class="inline" >Item</label></th>
								<th><label class="inline" >Cantidad Requerida</label></th>
								<th><label for="Invitees_email" class="required">Lleva:cantidad <span class="required">*</span></label></th>							
								<th><label class="inline" >Falta</label></th>
								<th><label class="inline" >Acciones</label></th>
													
							</tr>
						</thead>
					<tbody> 
							@foreach ($listaDeItems as $item )		
							<tr id="item_{{$item->id}}">
								<td id="item_{{$item->id}}">{{$item->nombre}}</td>
								<td>{{$item->cantidad}}</td>		            
								<td>
									@foreach ($listaDeItemsOk as $itemok)
										@foreach ($listaDeInvitados as $invitado)
											@if ($invitado->idusuario == $itemok->idusuario)
												@if($item->id == $itemok->iditem)
													<?php $user=Usuario::where('id','=',$invitado->idusuario)->get()[0]; ?>
													{{$user->username}} <span>: {{$itemok->cantidad}}</span> 
													<br/>
												@endif	
											@endif
										@endforeach
									@endforeach
								</td>           
								<td>
									Faltan:
									<?php $faltan = $item->cantidad; ?>
									@foreach ($listaDeItemsOk as $itemok)
										@if ($itemok->iditem == $item->id)
											<?php $faltan = $faltan - $itemok->cantidad?>								
										@endif
									@endforeach
									{{$faltan}}
								</td>
								<td> 
									@if ($objEvento->cerrado == 0)
									<!-- SI EL USUARIO ACTUAL O SEA..SESIONADO AHORA ESTA CONFIRMADO, SE MUESTRA, SINO NO-aGREGAR AL REFRESCO DE LA TABLA DE ITEMS-->
										@if ($usuarioInvitado->confirmado == 1)
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalLlevo{{$item->id}}">Yo llevo </button>  <!--Se descarta esta opcion-->
										@endif
									
																	<!-- MODAL -->
															<div id="myModalLlevo{{$item->id}}" class="modal fade form-llevo-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content"> 
																				<div class="modal-header">
																				
																					<button id="modalCloseAsigna" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																					<bold><h2>Llevar Item</h2></bold>
																				</div>
																	{{Form::open(array('id' => 'llevarItemForm','method' => 'POST', 'class'=>'form-llevar form-horizontal', 'action' =>'ItemsokController@llevar' , 'role' => 'form'))}}
																	<div class="modal-body">
														
																		<!--Nombre-->
																		<div class="form-group">									
																			{{Form::label('Nombre Item')}}
																			{{Form::text('nombre', $item->nombre, array('readonly' => 'readonly','class' => 'form-control', 'placeholder' => 'Nombre'))}}					                                       
																		</div>											
																	   
																	<!--cantidad-->
																		<div class="form-group">
																			{{Form::label('Cantidad')}}									
																			<!-- {{Form::input('number','cantidad')}}  -->
																			<input type="number" name="cantidad" class="llevar-item-qty" min="0" max="50">
																		</div>	
																		
																		<input name="capturaevitok" type="hidden" value="{{$objEvento->id}}">	
																		<input name="capturaiditem" type="hidden" value="{{$item->id}}">	
																	</div>
														
																		<div class="modal-footer">
																			<div class="form-group">
																					<div class="col-lg-10">
																						{{Form::submit('Llevar', array('class' => 'btn btn-success'))}}
																					</div>
																				<a href="#" data-dismiss="modal" class="btn">Cancelar</a>
																			</div>															
																		</div>
																	{{Form::close()}}
											
																	</div>
																</div>
															</div>	
														<!----------------------- FIN MODAL -->
									
									
									@endif
								</td>
								
							</tr>
							@endforeach
						
					</tbody>
				</table>
				
				<!-- aca deberia hacer un form con ese boton, donde mando el id del evento y luego obtengo los itemsok y los invitados y los usuarios, donde coloco el nombre mail e itemok y la cantidad a llevar-->
				</div>
			@endif	<!--Fin si de lista compras (3)-->
		
		
		
		
	
	<!-------------------------------------------------------------------------------------------------------->
	<div class="row"> 
            <h1 class="subheader">Imagenes</h1>

            @if(Session::has('confirm'))
                <div class="alert-box success round">
                    {{ Session::get('confirm') }}
                </div>                    
            @endif
            <div class="row">
				<div class="col-md-6">	 
					<div class="well" >               
						{{Form::open(array('id'=>'agregarFotoForm', 'method' => 'POST', 'class'=>'form-horizontal', 'action' =>'FotoController@post_foto' ,'files' => true ,'role' => 'form'))}}
						<input name="captura" type="hidden" value="{{$objEvento->id}}">	
						<div>
							{{ Form::label('photo', 'photo') }}                
							<!--así se crea un campo file en laravel-->
							{{ Form::file('photo') }}
							<div class="bg-danger">{{$errors->first('photo')}}</div>
						</div>
						</br>
						<div>
							{{ Form::label('titulo', 'titulo') }} 
							{{ Form::text('titulo', '', array('class' => 'form-control')) }}
							<div class="bg-danger">{{$errors->first('titulo')}}</div>
						</div>            
						
						<br />
						{{ Form::submit('Cargar Foto', array("class" => "button expand round")) }}
		 
						{{ Form::close() }}
		 
					</div>
				</div>
			</div>
        </div>
	
		@else
		
		@endif
			<!-- La galeria se puede ver sin restricciones, porque en el evento siempre se tiene que ver al igual que la info del evento-->
			<div class="gamma-container gamma-loading" id="gamma-container">
			
				<ul class="gamma-gallery">
				@foreach ($listaDeFotos as $foto)
					<li>
						<div data-alt="{{ asset( 'imgs/'."".  $foto->photo)}}" data-description="<h3>{{$foto->titulo}}</h3>" data-max-width="1800" data-max-height="1350">					
								
								<div data-src="{{ asset( 'imgs/'."".  $foto->photo)}}" data-min-width="1300"></div>
								<div data-src="{{ asset( 'imgs/'."".  $foto->photo)}}" data-min-width="1000"></div>
								<div data-src="{{ asset( 'imgs/'."".  $foto->photo)}}" data-min-width="700"></div>
								<div data-src="{{ asset( 'imgs/'."".  $foto->photo)}}" data-min-width="300"></div>
								<div data-src="{{ asset( 'imgs/'."".  $foto->photo)}}" data-min-width="200"></div>
								<div data-src="{{ asset( 'imgs/'."".  $foto->photo)}}" data-min-width="140"></div>
								<div data-src="{{ asset( 'imgs/'."".  $foto->photo)}}"></div>
								<noscript>
									<img src="{{ asset( 'imgs/'."".  $foto->photo)}}" alt="{{ asset( 'imgs/'."".  $foto->photo)}}"/>
								</noscript> 
							
							
							
						</div>
						
					</li>
				@endforeach
				</ul>
				<div class="gamma-overlay"></div>
			</div>
			
<!----------------------------------------------------------------------------MODALES---------------------------------->


<!--Aca mi codigo de modal de AGREGAR ITEMS-->
	<div id="myModalItem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content"> 
				<div class="modal-header">
					<button id="modalCloseItem" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<bold><h2>AGREGAR ITEM</h2></bold>
				</div>
				
				{{Form::open(array('id' => 'agregarItemForm','method' => 'POST', 'class'=>'form-horizontal', 'action' =>'ItemController@agregar' , 'role' => 'form'))}}
					<div class="modal-body">
						<div class="form-group">								
							<div class="row">
								<div class="col-xs-6">
									{{Form::label('Nombre Item')}}						
									{{Form::text('nombre','',array('class'=>'form-control'))}} 	
									<div>{{$errors->first('nombre')}}</div>																
								</div>
								<div class="col-xs-6">
									{{Form::label('Cantidad')}}		
										</br>
									{{Form::input('number','cantidad','cantidad',array('class'=>'form-control'))}} 			
									<div>{{$errors->first('cantidad')}}</div>						
								</div>
							</div>
								<input name="captura" type="hidden" value="{{$objEvento->id}}">				                                       
						</div>						
					</div>					
					<div class="modal-footer">
						<div class="form-group" class="col-lg-4 col-lg-offset-2">
							{{Form::submit('Agegar Item', array('class' => 'btn btn-success'))}}		
								<a href="#" data-dismiss="modal" class="btn">Cancelar</a>
						</div>   														
					</div>
				{{Form::close()}}
			</div>
		</div>
	</div>

<!---------------------------------------------------------------------->


@stop
</body>
</html>	

