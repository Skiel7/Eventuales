	<!--Genera solo la tabla de invitados para devolver en un pedido AJAX-->
	
		<div class="alert alert-warning" align="center">
        @if ($error)
			{{ $error }}
		@endif
		</div>	
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
				<tr>
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
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAsistencia">Asistir </button> 
							<!--COMIENZO MODAL ASISTIR-->
					<div id="myModalAsistencia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true
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
											{{Form::label('Adultos','',array('class'=>'col-lg-1 control-label'))}}
											{{ Form::input('number', 'adultos') }}
										</div>
										<!--menores-->
										<div class="form-group" class="col-lg-4 control-label" >
											{{Form::label('Menores','',array('class'=>'col-lg-1 control-label'))}}
											{{ Form::input('number', 'menores') }}
										</div>
										<!--gasto-->
										<div class="form-group" class="col-lg-4 control-label" >
											{{Form::label('Gasto','',array('class'=>'col-lg-1 control-label'))}}
											{{ Form::input('number', 'gasto') }}
										</div>
										<!---->                
									</div>
									<div class="modal-footer">
										<div class="form-group">
											<div class="col-lg-10">
												{{Form::submit('Asistir', array('class' => 'btn btn-success'))}}
											</div>
										</div>					
										<a href="#" data-dismiss="modal" class="btn">Cancelar</a>
									</div>
								{{Form::close()}}
							</div>
						</div>
					</div><!-----FIN MODAL ASISTIR-->
					@else
						@if ($objEvento->cerrado == 0)
							<a class="btn btn-info" href="/mail/{{$invitado->id}}/{{$objEvento->id}}" title="Envia un email"><i class="icon-envelope"></i>Enviar Mail</a>
						@endif
						@if ($objEvento->cerrado == 1)
							<a class="btn btn-info" href="" title="Envia la cuenta"><i class="icon-envelope"></i>Enviar Cuentas</a>
						@endif
						@if ($objEvento->cerrado == 0)
							<a class="btn btn-danger" href="/eliminarinvitado/{{$invitado->id}}/{{$objEvento->id}}" title="Eliminar invitado"><i class="icon-envelope"></i>Eliminar</a>
						@endif
					@endif
					</td>		
				</tr>
				@endforeach					
        </tbody>
	
	
	