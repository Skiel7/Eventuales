<?php

class EventoController extends \BaseController {

	
	 
	 public function get_crearEvento()
	{
		return View::make('pages.crearEvento');
	}
	public function get_EventoX()
	{
		
		$datos=array(
					$nombreevento=Input::get("nombreevento"),           
					$fecha=Input::get("fecha"),
					$hora=Input::get("hora"),
					$descripcion=Input::get("descripcion"),
					//$direccion=Input::get("direccion"),
					$adultosmax=Input::get("adultosmax"),
					$menoresmax=Input::get("menoresmax")				
					);
		
		$reglas=array(
						'nombreevento'  => 'required|min:2|max:30',
						'fecha'    => 'required',
						'hora'    => 'required',
						'descripcion'    => 'required|min:2|max:300',
						'adultosmax'    => 'required|integer|between:0,500',
						'menoresmax'    => 'required|integer|between:0,500'						
						);
						
		$messages = array(
        'required'  => 'El campo :attribute es obligatorio.',
        'min'       => 'El campo :attribute no puede tener menos de :min carácteres.',
        'max'       => 'El campo :attribute no puede tener más de :min carácteres.',
		'integer'       => 'El campo :attribute debe ser un numero entre 0 y 500.'
        				);
		
		$validation = Validator::make(Input::all(), $reglas, $messages);
		
		if ($validation->fails())
			{
				return Redirect::to("crearEvento")->withErrors($validation)->withInput()-> with('crea', 'Revise los datos ingresados');
			}else
			
			{	$NEvento= new Evento;
			
				$NEvento -> nombre=Input::get('nombreevento');
				$NEvento -> fecha=Input::get('fecha');
				$NEvento -> hora=Input::get('hora');
				$NEvento -> descripcion=Input::get('descripcion');
				$NEvento -> direccion=Input::get('direccion');
				$NEvento -> latitud=Input::get('lat');
				$NEvento -> longitud=Input::get('lng');
						
				$NEvento -> adultosmax=Input::get('adultosmax');
				$NEvento -> menoresmax=Input::get('menoresmax');
				
				$NEvento -> creador=Session::get('usuario_id');
				$NEvento-> save();
				//puedo hacer un find usuario con el id creador... y despues capturo el mail para colocar en ninvitado.
				$idu=Session::get('usuario_id');
				$Us=Usuario::find($idu);
				$Usmail=$Us->email;
				// El creador esta invitado por default
				$Ninvitado= new Invitado;
				$Ninvitado -> idevento = $NEvento->id;
				$Ninvitado -> idusuario = $NEvento -> creador;
				$Ninvitado -> rol = 0 ;// organizador
				$Ninvitado -> email=$Usmail;
				$Ninvitado -> menores=0;
				$Ninvitado -> adultos=1;
				$Ninvitado -> notificado=1;
				$Ninvitado -> confirmado=1;
				$Ninvitado -> save();
				
				return Redirect::action('MisEventosController@index');	
		}
		
		
	}
	
	
	public function post_crearEvento()
	{
		$input= Input::all();
		//En rules ponemos que cosas vamos a validar... con lo que trae laravel quedaria:
		$rules=array(
			'nombre' => 'required',
			'direccion' => 'required',
			'fecha'=> 'date_format:d/m/y',
			'hora' => 'required'|'time',
			'descripcion'=>'required',
			'adultosmax'=>'required'|'numeric',
			'menoresmax'=>'required'|'numeric',		
			);
			
			$validator = Validator::make ($input, $rules); 
			
			if ($validator->fails())
			{
				return Redirect::back()->withErrors($validator)-> with('registro', 'Revise los datos ingresados') ;
				
			}			
			{ 			
				$Evento = new eventos;
				$Evento->nombre = Input::get('username');
				$Evento->direccion =Input::get('apellido');
				$Evento->descripcion = Input::get('ciudad');
				$Evento->fecha = Input::get('email');;
				$Evento->hora = Input::get('nacimiento');
				$Evento->adultosmax = Input::get('password');
				$Evento->menoresmax = Input::get('provincia');
				
				$Evento->save();
				return Redirect::to('/crearEvento')->with('crearEvento', 'Su evento ha sido creado');
			
			}
			
	}
	  
	
	
	
	 public function get_verevento($id=null) 
	{
		$objEvento=Evento::find($id);
		$listaDeInvitados= Invitado::where('idevento','=',$id)->get(); //idevento es el nombre en la tabla, el atributo en invitados
		$usuarioInvitado = Invitado::where('idevento','=',$id)->where('idusuario','=',Session::get('usuario_id'))->get()[0]; // usuario logueado invitado 
		$listaDeItems= Item::where('idevento','=',$id)->get();
		$listaDeItemsOk=Itemsok::where('idevento','=',$id)->get(); //idevento es el nombre en la tabla de itemsok
		$listaDeFotos= Foto::where('idevento','=',$id)->get();
		// Join para obtner nombre y email
		foreach ($listaDeInvitados as $invitado)
		{
			$usuario = Usuario::where('id','=', $invitado->idusuario)->get()[0];
			//$usuario = Usuario::where('id','=', '2')->get();
			//$usuario = Usuario::all()[0];
			//$usuario = Usuario::where('email','=',$invitado->email)->get();
			//Log::info('Invitado email = '+$invitado->email );
			//$combo[$usuario->email] = 'juan';
			$combo[$usuario->email] = $usuario->username;
			
		}
		//$union  =  DB :: table ( 'invitados' ) 
            //-> join ( 'usuarios' ,  'invitados.idusuario' ,  '=' ,  'usuarios.id' )  
			//-> select ('usuarios.username', 'usuarios.apellido', 'usuarios.email')
			//-> where('invitados.idevento','=',$id)*/
			//-> select('invitados.email')
            //-> get ( ) ;
		/*$Union  =  DB :: table ( 'itemsoks' ) 
            -> join ( 'items' ,  'itemsoks.iditem' ,  '=' ,  'items.id' ) 
            -> join ( 'invitados' ,  'itemsoks.idusuario' ,  '=' ,  'invitados.idusuario' )  
			-> select ('itemsoks.*', 'items.nombre', 'invitados.email')
			-> where('itemsoks.idevento','=',$id)
            -> get ( ) ;*/
		/*
		$msg='';
		foreach ($Union as $info)
		{
		    $msg = $msg.'Item: '.$info->nombre.', cant: '.$info->cantidad.', lleva -> email:'.$info->email.'<br/>';	
		}*/
		
		//$combo = Invitado::where('idevento','=',$id)->lists('email','email');
		// Arma una lista tipo email => nombre
		//$combo = $Union->lists('nombre','email');
		
		/*
		for ($listaDeInvitados as $invitado)
			$combo[$invitado->mail] = 'Ezequiel torres eze@' */
		return View::make('eventos.verevento', array('objEvento'=>$objEvento , 'combo'=>$combo  , 'listaDeInvitados'=>$listaDeInvitados , 'listaDeItems'=>$listaDeItems, 'listaDeItemsOk'=>$listaDeItemsOk, 'usuarioInvitado'=>$usuarioInvitado, 'listaDeFotos'=>$listaDeFotos));
	}
	
	
	
	public function get_modificarevento($id)
	{
	 $eventomodid=Evento::find($id);
	 if($eventomodid)
	 {
		return View::make('eventos.modificarevento', array('eventomodid'=>$eventomodid));
		}
	return Redirect::to("MisEventos");
	}
	
	
	public function modificarelevento()
	{
			$ideventoamod=Input::get('capturaevent');
			$NEvento=Evento::find($ideventoamod);
			
			$NEvento -> nombre=Input::get('nombre');
			$NEvento -> fecha=Input::get('fecha');
			$NEvento -> hora=Input::get('hora');
			$NEvento -> descripcion=Input::get('descripcion');
			$NEvento -> direccion=Input::get('direccion');
			$NEvento -> latitud=Input::get('lat');
			$NEvento -> longitud=Input::get('lng');			
			$NEvento -> adultosmax=Input::get('adultosmax');
			$NEvento -> menoresmax=Input::get('menoresmax');
			
			$NEvento -> creador=Session::get('usuario_id');
			
			$NEvento-> save();
			return Redirect::to("verevento/$ideventoamod"); //deberia mostrar el ver evento con los nuevos valores
	}


	public function delete_evento($id)
	{
        $borrarevento = Evento::find($id);
        $borrarevento->delete();

        return Redirect::to('MisEventos');
	}
	
	public function abrirevento()
	{
		$ideventoabrir=Input::get('captura');
        $AbreEvento = Evento::find($ideventoabrir);
        $AbreEvento -> cerrado=0;
		$AbreEvento-> save();
        return Redirect::to("verevento/$ideventoabrir");
	}
	
	public function cerrarevento()
	{
		$ideventocerrar=Input::get('captura');
        $CierraEvento = Evento::find($ideventocerrar);
        $CierraEvento -> cerrado=1;
		$CierraEvento-> save();
        return Redirect::to("verevento/$ideventocerrar");
	}
	
	public function enviarmail($id,$idec)
	{ //Me pasa el id del invitado y el id del evento
		//Envia mail cuando se aprieta desde la tabla y por eso recibo el id del invitado y el de el evento
		//Corregir el TO..reemplazar mail actual por el del invitado
		$usuarioInvitado = Invitado::find($id);
		$usuarioid=$usuarioInvitado->idusuario;
		$User=Usuario::find($usuarioid);
		$nombre = $User->username;
		$ElInvitado= Invitado::where('id','=',$id)->get()[0];
		$elmail=$ElInvitado->email;
		$evento=Evento::find($idec);
		$nombreevento=$evento->nombre;
		 
		$datos = array('nombre' => $nombre,'elmail'=>$elmail ,'nombreevento'=>$nombreevento);
				
						
			Mail::send('emails.enviamailuno', $datos, function($message) use ($datos) //se envia el mail
			{
			   $message->from('eventualesweb@gmail.com', 'Eventuales');
				$message->to($datos['elmail'])->subject('Eventuales-Invitacion');
			});
		$usuarioInvitado->notificado=1;
		$usuarioInvitado->save();
			return Redirect::to("verevento/$idec")->with('estado', 'Se ha enviado Mail correctamente');
        
	}
	
	public function Cuentas()
	{
		// SI el evento esta cerrado
		$eventoid=Input::get('captura');
		$metodo=Input::get('capturametodo');
		$Evento=Evento::find($eventoid);
		$listaDeInvitados= Invitado::where('idevento','=',$eventoid)->get();
				if ($metodo == '1')
				{				
					$costofijoinvitado=Input::get('costo');
					$Evento->metodocuenta=$metodo;
					$Evento->save();
					foreach ($listaDeInvitados as $invitado)
					{
						$idinv=$invitado->id;
						$Invitado= Invitado::find($idinv);
						if ($Invitado->confirmado==1)
						{
							$Invitado->costo=$costofijoinvitado;
							$Invitado->save();							
						}	
					}					
					return Redirect::to("verevento/$eventoid");				
				}
				
				if ($metodo =='2')
				{
						$costopormenor=Input::get('costomen');
						$costoporadul=Input::get('costoadul');
						$Evento->metodocuenta=$metodo;
						$Evento->save();
						foreach ($listaDeInvitados as $invitado)
						{
							$idinv=$invitado->id;
							$Invitado= Invitado::find($idinv);
							if ($Invitado->confirmado=='1')
							{
								$totalasistente=(($Invitado->menores)*$costopormenor)+(($Invitado->adultos)*$costoporadul);
								$Invitado->costo=$totalasistente;
								/*$Invitado->DetCosto='el costo por menor es de= '$costopormenor'+' y el costo por adulto es'+$costoporadul;*/
								$Invitado->save();
							}
						}
						return Redirect::to("verevento/$eventoid");					
				}
				
				if ($metodo=='3')
				{
						$gastototalevento=0;
						$contadordeasistente=0;
						$costototalporasistente=0;
						$Evento->metodocuenta=$metodo;
						$Evento->save();
						foreach ($listaDeInvitados as $invitado)
						{
							$idinv=$invitado->id;
							$Invitado= Invitado::find($idinv);
							if ($Invitado->confirmado=='1')
							{
								$gastototalevento=($gastototalevento + $Invitado->gasto);
								$contadordeasistente=($contadordeasistente + 1);
							}
						}
						
						$costototalporasistente= ($gastototalevento / $contadordeasistente);
						foreach ($listaDeInvitados as $invitado)
						{
							$idinv=$invitado->id;
							$Invitado= Invitado::find($idinv);
							if ($Invitado->confirmado=='1')
							{
								$Invitado->costo=$costototalporasistente;
								$Invitado->save();
							}
						}
						return Redirect::to("verevento/$eventoid");
				}
				/////
				if ($metodo=='4')
				{
						$porccostomen=Input::get('costomen');
						$porccostoAdul=Input::get('costoadul');
						$gastototalevento=0;
						$contadordeasistente=0;
						
						$CM=0;
						$CA=0;
						$Evento->metodocuenta=$metodo;
						$Evento->save();
						foreach ($listaDeInvitados as $invitado)
						{
							$idinv=$invitado->id;
							$Invitado= Invitado::find($idinv);
							if ($Invitado->confirmado=='1')
							{
								$gastototalevento=($gastototalevento + $Invitado->gasto);
								$contadordeasistente=($contadordeasistente + 1);
								$CM=(($Invitado->menores)+$CM);
								$CA=(($Invitado->adultos)+$CA);	
							}
						}
					
						if ($CM == 0)
						{
							$porccostoAdul=100; //si no asisten menores, pagan todo los adultos.
							$porccostomen=0;
							$CM=1;
						}
							
						$costoAdulto= ($porccostoAdul * $gastototalevento)/100; //valor total adulto
						$costoMenor= ($porccostomen * $gastototalevento)/100;  //valor total menor
						$CostoMenorUnidad= ($costoMenor / $CM); // valor por unidad de menor
						$CostoAdultoUnidad= ($costoAdulto / $CA); //valor por unidad de adulto
						
						foreach ($listaDeInvitados as $invitado)
						{
							$idinv=$invitado->id;
							$Invitado= Invitado::find($idinv);
							if ($Invitado->confirmado=='1')
							{
							$PagarMenor= (($Invitado->menores) * $CostoMenorUnidad);
							$PagarMayor= (($Invitado->adultos) * $CostoAdultoUnidad);
							$Pagototal= ($PagarMenor + $PagarMayor);
							
							$Invitado->costo=$Pagototal;
							/*$Invitado->DetCosto='Detalle:\n Los adultos pagan el ' + $porccostoAdul * 100 + '% del total del evento\n Costo por cada adulto' + $CostoAdultoUnidad +\
												'\n' + 'Los menores pagan el ' + $porccostomen * 100 + '% del total del evento\n Costo por cada menor' + $CostoMenorUnidad '\n';
							*/
							$Invitado->save();					
							}
						}
						
						return Redirect::to("verevento/$eventoid");
				
				}
				
				/////					
				if ($metodo=='5')
				{
				
				
						$valorfijo=Input::get('CFijo');
						$contadorDasistente=0;
						$Evento->metodocuenta=$metodo;
						$Evento->save();
						//se divide ese total entre todos los asistentes(invitado lider)
						foreach ($listaDeInvitados as $invitado)
						{
							$idinv=$invitado->id;
							$Invitado= Invitado::find($idinv);
							if ($Invitado->confirmado=='1')
							{								
								$contadorDasistente=($contadorDasistente + 1);
							}
						}
						
						$Costototalasis=($valorfijo / $contadorDasistente);
						
						foreach ($listaDeInvitados as $invitado)
						{
							$idinv=$invitado->id;
							$Invitado= Invitado::find($idinv);
							if ($Invitado->confirmado=='1')
							{
								$Invitado->costo=$Costototalasis;
								$Invitado->save();
							}
						}
						return Redirect::to("verevento/$eventoid");
				}
				if ($metodo=='6')
				{
					$Evento->metodocuenta=$metodo;
					$Evento->save();
					$contadorDasistente=0;
					$valorfijo=Input::get('valortotal');  //costo total del evento
					$poradul=Input::get('porcentajeadulto');
					$pormen=Input::get('porcentajemenor');					
					$costoAdulto= ($poradul * $valorfijo)/100; //valor total adulto
					$costoMenor= ($pormen * $valorfijo)/100;  //valor total menor
					//necesito saber cuantos menores y cuantos adultos tiene cada asistente
					
					//se divide ese total entre todos los asistentes(invitado lider)
					$CM=0;
					$CA=0;
					foreach ($listaDeInvitados as $invitado)
						{
							$idinv=$invitado->id;
							$Invitado= Invitado::find($idinv);
							if ($Invitado->confirmado=='1')
							{
								$CM=(($Invitado->menores)+$CM);
								$CA=(($Invitado->adultos)+$CA);								
							}
						}
					
					//
					if ($CM == 0)
						{
							$CostoMenorUnidad= 0;
							$costoAdulto= $valorfijo; // si no hay menores...se divide todo entre adultos
							$CostoAdultoUnidad= ($costoAdulto / $CA);
							
						}
					else {
					
					 $CostoMenorUnidad= ($costoMenor / $CM);    
					 $CostoAdultoUnidad= ($costoAdulto / $CA);
					 }
					 //
					foreach ($listaDeInvitados as $invitado)
						{
							$idinv=$invitado->id;
							$Invitado= Invitado::find($idinv);
							if ($Invitado->confirmado=='1')
							{
							$PagarMenor= (($Invitado->menores) * $CostoMenorUnidad);
							$PagarMayor= (($Invitado->adultos) * $CostoAdultoUnidad);
							$Pagototal= ($PagarMenor + $PagarMayor);
							
							$Invitado->costo=$Pagototal;
							/*$Invitado->DetCosto='El valor total del evento es='+$valorfijo+' y se distribuye en un porcentaje: menores %'+$poradul+' - adultos %'+$poradul+\ 
												'\n''Su cantidad de menores es de='+$Invitado->menores+' y el costo por cada uno es de $'+$CostoMenorUnidad+\
												'\n'+ 'Su cantidad de adultos es de='+$Invitado->adultos+' y el costo por cada uno es de $'+$CostoAdultoUnidad;*/
							$Invitado->save();					
							}
						}
					
					return Redirect::to("verevento/$eventoid");
				}
				
					
	return Redirect::to("verevento/$eventoid");		
	}


	public function EnviaMailCuentaIndividual($id,$idec)
	{ //Me pasa el id del invitado y el id del evento
		//Envia mail de cuentas cuando se aprieta desde la tabla y por eso recibo el id del invitado y el de el evento
		//Corregir el TO..reemplazar mail actual por el del invitado
		$usuarioInvitado = Invitado::find($id);
		$usuarioid=$usuarioInvitado->idusuario;
		$usuarioInvitado->notificaEM = 1;
		$usuarioInvitado->save();
		$User=Usuario::find($usuarioid);
		$nombre = $User->username;
		$email = $usuarioInvitado->email;
		
		$evento=Evento::find($idec);
		$nombreevento=$evento->nombre;
		$idmetodo=$evento->metodocuenta;
		
			if ($idmetodo == '1')
				{ $nombremetodo= 'valor fijo por invitado';}			
			if ($idmetodo == '2')
			{ $nombremetodo= 'Costo fijo por asistente';}		
			if ($idmetodo == '3')
			{ $nombremetodo= 'Se divide los gastado en partes iguales';}		
			if ($idmetodo == '4')
			{ $nombremetodo= 'Se divide los gastado segun asistente';}			
			if ($idmetodo == '5')
			 $nombremetodo= 'Se divide un valor fijo en partes iguales';			
			if ($idmetodo == '6')
			{ $nombremetodo= 'Se divide un valor fijo segun asistente';}		
					
					$sale= $usuarioInvitado->costo ;
					$gastaste= $usuarioInvitado->gasto ;
					$balance=$gastaste-$sale;
					//$Detalle=$usuarioInvitado->detCosto;
					$datos = array('balance' =>$balance, 'nombre' =>$nombre,'email' =>$email, 'nombreevento'=>$nombreevento, 'nombremetodo'=>$nombremetodo, 'sale' => $sale , 'gastaste' => $gastaste );
													
						Mail::send('emails.mailcuentam1', $datos, function($message) use ($datos)//se envia el mail
						{
						   $message->from('eventualesweb@gmail.com', 'Eventuales');
							$message->to($datos['email'])->subject('Eventuales- Su Cuenta');
						});
					
					
						return Redirect::to("verevento/$idec")->with('estado', 'Se ha enviado Mail con cuenta correctamente');		
			
	}
	
	
	public function ListaDeCompra($idec)
	{ //Me pasa el id del evento		
		
		$evento=Evento::find($idec);
		$nombreevento=$evento->nombre;
		$listaDeItemsOk=Itemsok::where('idevento','=',$idec)->get();
		$listaDeItems=Item::where('idevento','=',$idec)->get();
		$listaDeInvitados= Invitado::where('idevento','=',$idec)->get(); 
		
		
		$Union  =  DB :: table ( 'itemsoks' ) 
            -> join ( 'items' ,  'itemsoks.iditem' ,  '=' ,  'items.id' ) 
            -> join ( 'invitados' ,  'itemsoks.idusuario' ,  '=' ,  'invitados.idusuario' )  
			-> select ('itemsoks.*', 'items.nombre', 'invitados.email')
			-> where('itemsoks.idevento','=',$idec)
            -> get ( ) ;
					
		$msg='';
		foreach ($Union as $info)
		{
		    $msg = $msg.'Item: '.$info->nombre.', cant: '.$info->cantidad.', lleva -> email:'.$info->email.'<br/>';	
		}
		
		foreach ($listaDeInvitados as $invitado)
		{
			if ($invitado->confirmado == 1)
			{
			$email=$invitado->email;
			$datos = array('msg' => $msg, 'email' =>$email, 'nombreevento'=>$nombreevento);
					
							
				Mail::send('emails.Lista', $datos, function($message) use ($datos) //se envia el mail
				{
				   $message->from('eventualesweb@gmail.com', 'Eventuales');
					$message->to($datos['email'])->subject('Eventuales-Lista de Items');
				});
			}
		}
		$evento->notificaEI=1;
		$evento->save();
			return Redirect::to("verevento/$idec")->with('estado', 'Se ha enviado la lista de compras correctamente');
        
	}
	
	
	
}
