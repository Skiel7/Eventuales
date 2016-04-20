<?php

class InvitadoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 
	
	public function invitacion()
	{

		$ideventocapturado=Input::get('captura');
		$emailobtenido=Input::get('email');
		$rolCaptura=Input::get('rol');
		$nombremodal=Input::get('username');
		$apellidomodal=Input::get('apellido');
		$idinvitado=-1; //para inicializarla
		$listaUsuarios=Usuario::all();

		foreach($listaUsuarios as $usuario){
		
			if ($usuario->email == $emailobtenido){
				$idinvitado=$usuario->id;
			}
		}
		
		if ($idinvitado==-1){
		// mandar mail
				$usuario = new Usuario;
				$usuario->username = '';
				$usuario->apellido ='';
				$usuario->password = '';
				$usuario->nacimiento = '';
				$usuario->sexo = '';
				$usuario->email = $emailobtenido;
				$usuario->provincia = '';
				$usuario->ciudad = '';
				
				$usuario->save();
				$idinvitado=$usuario->id;
				$datos = array('emailobtenido'=>$emailobtenido, 'nombremodal'=>$nombremodal, 'apellidomodal'=>$apellidomodal, 'idInvitado'=>$usuario->id);									
				Mail::send('emails.invitareg', $datos, function($message) use ($datos) //se envia el mail
				{
				   $message->from('eventualesweb@gmail.com', 'Eventuales');
					$message->to($datos['emailobtenido'])->subject('Eventuales-Invitacion a Registrarte');
				});
			
			//return "nuevo-usuario";
		}/*else{*/				
			$invitado = new Invitado;
			$invitado->idevento = $ideventocapturado;
			$invitado->idusuario =$idinvitado;
			$invitado->email = $emailobtenido;
			$invitado->rol = $rolCaptura;
			$invitado->menores = '';
			$invitado->adultos = '';
			$invitado->confirmado = '';
			$invitado->notificado= '';
			$invitado->costo= '';
			$invitado->gasto= '';				
			$invitado->save();
			
					
			// Armo la tabla HTML de invitados y la mando al cliente			
			$objEvento=Evento::find($ideventocapturado);
			
			$listaDeInvitados= Invitado::where('idevento','=',$ideventocapturado)->get(); //idevento es el nombre en la tabla, el atributo en invitados
			$usuarioInvitado = Invitado::where('idevento','=',$ideventocapturado)->where('idusuario','=',Session::get('usuario_id'))->get()[0]; // usuario logueado invitado 
			$listaDeItems= Item::where('idevento','=',$ideventocapturado)->get();
			$listaDeItemsOk=Itemsok::where('idevento','=',$ideventocapturado)->get(); //idevento es el nombre en la tabla de itemsok
			$listaDeFotos= Foto::where('idevento','=',$ideventocapturado)->get();
								
			//Devuelve el HTML del nuevo invitado agregado
			$htmlNuevoInvitado =View::make('eventos.nuevoInvitado', array('objEvento'=>$objEvento , 'listaDeInvitados'=>$listaDeInvitados , 'invitado'=>$invitado, 'listaDeItems'=>$listaDeItems, 'listaDeItemsOk'=>$listaDeItemsOk, 'usuarioInvitado'=>$usuarioInvitado, 'listaDeFotos'=>$listaDeFotos));
					
			return $htmlNuevoInvitado;
			
		//}
	}

	public function checkearInvitado()
	{
		$ideventocapturado=Input::get('captura');
		$emailobtenido=Input::get('email');
		$invitados = Invitado::where('idevento','=',$ideventocapturado)->where('email','=',$emailobtenido)->get();
		if(count($invitados) > 0){ // Encontro un invitado con ese mail
			return "existe";
		}else{ // No hay ningun invitado con ese mail aun
			return "no-existe";
		}
	}
	 
	 
	 
	public function get_invitado()
	{
		return View::make('eventos.Invitados');
	}


	public function asistir()
	{
		$ideventocapturado=Input::get('captura');
		$invitadoid=Input::get('capturainvitado');	
				$invitado = Invitado::find($invitadoid);						
				$invitado->menores = Input::get('menores');
				$invitado->adultos = Input::get('adultos');		
				$invitado->confirmado =1;	
				$invitado->notificado =1;				
				$invitado->gasto=Input::get('gasto');
				
				$invitado->save();
				
				return Redirect::to("verevento/$ideventocapturado");
		}
		
	public function asisto()
	{
		$ideventocapturado=Input::get('captura');
		$invitadoid=Input::get('capturainvitado');	
				$invitado = Invitado::find($invitadoid);						
				$invitado->menores = Input::get('menores');
				$invitado->adultos = Input::get('adultos');								
				$invitado->gasto=Input::get('gasto');				
				$invitado->save();				
				return Redirect::to("verevento/$ideventocapturado");
		}
	
	
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete_invitado()
	{
		$ideventocapturado=Input::get('capturandoevento');						
		$invitadoeliminarid=Input::get('capturainvitadoeliminar');
		$invitadoBorrar=Invitado::find($invitadoeliminarid);
		$idusu=$invitadoBorrar->idusuario;		
		$invitadoBorrar->delete();
		
		/*$listaiok=Itemsok::where('idusuario','=',$idisu)->where('idevento','=',ideventocapturado)->get()[0];
			foreach ($listaiok as $iok)
			{
				$iok->cantidad=0;
			}*/
			
				$objEvento=Evento::find($ideventocapturado);
				
				$listaDeInvitados= Invitado::where('idevento','=',$ideventocapturado)->get(); //idevento es el nombre en la tabla, el atributo en invitados
				
				$usuarioInvitado = Invitado::where('idevento','=',$ideventocapturado)->where('idusuario','=',Session::get('usuario_id'))->get()[0]; // usuario logueado invitado 
				
				$listaDeItems= Item::where('idevento','=',$ideventocapturado)->get();
				
				$listaDeItemsOk=Itemsok::where('idevento','=',$ideventocapturado)->get(); //idevento es el nombre en la tabla de itemsok
				
				$listaDeFotos= Foto::where('idevento','=',$ideventocapturado)->get();
				
		return $invitadoeliminarid;
		//return Redirect::to("MisEventos");
		//return Redirect::to("verevento/$ide");
	}


}
