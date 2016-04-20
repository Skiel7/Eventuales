<thead>
				<tr>
					<th><label class="inline" >Item</label></th>
					<th><label class="inline" >Cantidad Requerida</label></th>
					<th><label for="Invitees_email" class="required">Lleva:Cantidad <span class="required">*</span></label></th>							
					<th><label class="inline" >Falta</label></th>
					<th><label class="inline" >Acciones</label></th>
										
				</tr>
			</thead>
		<tbody>
				@foreach ($listaDeItems as $item )		
				<tr>
		            <td>{{$item->nombre}}</td>
					<td>{{$item->cantidad}}</td>		
					
					<td>
						@foreach ($listaDeItemsOk as $itemok)
							@foreach ($listaDeInvitados as $invitado)
								@if ($invitado->idusuario == $itemok->idusuario)
									@if($item->id == $itemok->iditem)
										{{$invitado->email}}
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
															<div>
										{{Form::open(array('id'=>'EliminaItemForm','method' => 'POST', 'class'=>'form-horizontal', 'action' =>'ItemController@delete_item' , 'role' => 'form'))}}
											<input name="capturaitemeliminar" type="hidden" value="{{$item->id}}">
											<input name="capturandoevento" type="hidden" value="{{$objEvento->id}}">	
										{{Form::submit('eliminar', array('class' => 'btn btn-danger'))}}
										{{Form::close()}}
									</div>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAsigna{{$item->id}}">Asignar Item </button> 
						
						
						
						<!-- MODAL -->
						<div id="myModalAsigna{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content"> 
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<bold><h2>Asignar Item</h2></bold>
											</div>
													{{Form::open(array('id' => 'asignarItemForm','method' => 'POST', 'class'=>'form-horizontal', 'action' =>'ItemsokController@asignar' , 'role' => 'form'))}}
														<div class="modal-body">
											
															<!--Nombre-->
															<div class="form-group">									
																{{Form::label('Nombre Item')}}
																{{Form::text('nombre', $item->nombre, array('readonly' => 'readonly', 'class' => 'form-control', 'placeholder' => 'Nombre'))}}					                                       
															</div>						   
															<!--Mail-->
															<div class="form-group">								
																{{Form::label('Email')}}												
																{{Form::select('email', $combo, null, array('class' => 'form-control','class' => 'form-control asignar-item-mail', 'placeholder' => 'email'))}}																	                                       
															</div>
															<!--cantidad-->
															<div class="form-group">
																{{Form::label('Cantidad')}}									
																{{Form::input('number','cantidad')}}   
															</div>	
																<input name="capturaevitok" type="hidden" value="{{$objEvento->id}}">	
																<input name="capturaiditem" type="hidden" value="{{$item->id}}">	
														</div>			
														<div class="modal-footer">
															<div class="form-group">
																<div class="col-lg-10">
																	{{Form::submit('asignar', array('class' => 'btn btn-success'))}}
																</div>
															</div>					
																<a href="#" data-dismiss="modal" class="btn">Cancelar</a>
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