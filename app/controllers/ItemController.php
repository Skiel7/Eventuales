<?php

class ItemController extends \BaseController {

	 
	 public function get_item()
	 {
		return View::make('pages.itempop');
	 }
	 
	public function agregar()
	{	
		$ideventocapturado=Input::get('captura');
		
			
					$nombre= Input::get('nombre');
					$cantidad=Input::get('cantidad');			
					
						
							$item = new Item;
							$item->idevento =$ideventocapturado;
							$item->nombre = Input::get('nombre');
							$item->cantidad = Input::get('cantidad');						
							$item->save();
			
							//Armo la tabla html de items y la mando al cliente
						
							$objEvento=Evento::find($ideventocapturado);				
							$listaDeInvitados= Invitado::where('idevento','=',$ideventocapturado)->get(); //idevento es el nombre en la tabla, el atributo en invitados
							$usuarioInvitado = Invitado::where('idevento','=',$ideventocapturado)->where('idusuario','=',Session::get('usuario_id'))->get()[0]; // usuario logueado invitado 
							//$combo = Invitado::where('idevento','=',$ideventocapturado)->lists('idusuario','idusuario');
							foreach ($listaDeInvitados as $invitado)
							{
								$usuario = Usuario::where('id','=', $invitado->idusuario)->get()[0];
								//$combo[$usuario->email] = 'juan';
								//$combo[$usuario->email] =$usuario->email; //$usuario->username + ' ' + $usuario->apellido;
								$combo[$usuario->email] = $usuario->username;
							}
							$listaDeItems= Item::where('idevento','=',$ideventocapturado)->get();
							$listaDeItemsOk=Itemsok::where('idevento','=',$ideventocapturado)->get(); //idevento es el nombre en la tabla de itemsok
							$listaDeFotos= Foto::where('idevento','=',$ideventocapturado)->get();
							
							//Devuelve el HTML del nuevo item agregado
			                $htmlNuevoItem = View::make('eventos.nuevoItem', array('objEvento'=>$objEvento, 'combo'=>$combo , 'listaDeInvitados'=>$listaDeInvitados , 'item'=>$item, 'listaDeItemsOk'=>$listaDeItemsOk, 'usuarioInvitado'=>$usuarioInvitado, 'listaDeFotos'=>$listaDeFotos));
			                return $htmlNuevoItem;
		
	}
	
	public function delete_item()	
	{			
					
				$ideventocapturado=Input::get('capturandoevento');							
				
				$itemeliminarid=Input::get('capturaitemeliminar');
				$itemBorrar=Item::find($itemeliminarid);
				$itemBorrar->delete();
				
				$objEvento=Evento::find($ideventocapturado);
				
				$listaDeInvitados= Invitado::where('idevento','=',$ideventocapturado)->get(); //idevento es el nombre en la tabla, el atributo en invitados
				
				$usuarioInvitado = Invitado::where('idevento','=',$ideventocapturado)->where('idusuario','=',Session::get('usuario_id'))->get()[0]; // usuario logueado invitado 
				
				$listaDeItems= Item::where('idevento','=',$ideventocapturado)->get();
				
				$listaDeItemsOk=Itemsok::where('idevento','=',$ideventocapturado)->get(); //idevento es el nombre en la tabla de itemsok
				
				$listaDeFotos= Foto::where('idevento','=',$ideventocapturado)->get();
			
				//$htmlTablaItems = View::make('eventos.listaItems', array('objEvento'=>$objEvento , 'listaDeInvitados'=>$listaDeInvitados , 'listaDeItems'=>$listaDeItems, 'listaDeItemsOk'=>$listaDeItemsOk, 'usuarioInvitado'=>$usuarioInvitado, 'listaDeFotos'=>$listaDeFotos));
			
				return $itemeliminarid; // Devuelve el id del item eliminado
	}

	

	


}
