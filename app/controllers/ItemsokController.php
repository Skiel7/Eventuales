<?php

class ItemsokController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function asignar()
	{
		$ideventocapturado=Input::get('capturaevitok');
		$iditemcap=Input::get('capturaiditem');
		$emailusuario=Input::get('email');
		$listaDeUsuarios=Usuario::all();
		$listaDeInvitados= Invitado::where('idevento','=',$ideventocapturado)->get(); //Obtengo la lista de invitados del evento
		foreach ($listaDeInvitados as $invitado){
			if ($invitado->email == $emailusuario){
				if ($invitado->confirmado == 1)
				{
					$usuarioide=$invitado->idusuario;					
					$itemsok = new Itemsok;
					$itemsok->iditem=$iditemcap;
					$itemsok->cantidad = Input::get('cantidad');
					$itemsok->idevento =$ideventocapturado;
					$itemsok->idusuario = $usuarioide ;
					$itemsok->save();
					
					return Redirect::to("verevento/$ideventocapturado");	//Si ES, retorna por aca				
				}	
			return 'no-confirmado'; // si no confirmo que asiste al evento lo retorno aca
			}			
		}
		return 'no-invitado '; //Si NO esta invitado retorno por aca.
		
	}

	public function checkearAsignacionItem()
	{
		$ideventocapturado=Input::get('capturaevitok');
		$iditemcap=Input::get('capturaiditem');
		$emailusuario=Input::get('email');
		$listaDeUsuarios=Usuario::all();
		$listaDeInvitados= Invitado::where('idevento','=',$ideventocapturado)->get(); //Obtengo la lista de invitados del evento
		foreach ($listaDeInvitados as $invitado){
			if ($invitado->email == $emailusuario){
				if ($invitado->confirmado == 1)
				{
					return 'confirmado';		
				}		
				return 'no-confirmado'; // si no confirmo que asiste al evento lo retorno aca
			}			
		}
		return 'no-invitado'; //Si NO esta invitado retorno por aca.
		
	}
	
	
	
	public function llevar()
	{
		$ideventocapturado=Input::get('capturaevitok');
		$iditemcap=Input::get('capturaiditem');		
		$iduser=Session::get('usuario_id');
		$objUser=Usuario::find($iduser);
		
		$itemsok = new Itemsok;
		$itemsok->iditem=$iditemcap;
		$itemsok->cantidad = Input::get('cantidad');
		$itemsok->idevento =$ideventocapturado;
		$itemsok->idusuario = $iduser ;
		$itemsok->save();
		
		return Redirect::to("verevento/$ideventocapturado");			
			
	}
	
	 
	public function create()
	{
		//
	}


	public function store()
	{
		//
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}


}
