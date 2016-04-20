<?php

class UsuarioController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() // cada vez que se rutea, laravel me lo envia aca
	{
		$usuarios=Usuario::all();
		return View::make('index')->with('usuarios',$usuarios); 
		 //return 'Esta es la lista de usuarios';

	}

//---------------------------------------------------PARTE DE LOS REGISTROS---------------------------------------------
	//ACA MUESTRO LA PAGINA DEL REGISTRO
	public function get_registro()
	{
		{
		if(Usuario::isLogged())
			{
			return Redirect::to('/MisEventos');
			}
			else
			{
				return View::make('pages.registro');
			}
		}
	}
	
	/////
	
	public function get_registro_invitado()
	{
		Session::flush();
		$iduser=Input::get('id');
		
		return View::make('pages.registro_invitado')->with('idInvitado',$iduser);
	}
	////////////////////
	public function registro_invitado_exito()
	{				
		return View::make('pages.registro_invitado_exito') ;
	}
	/////////////////
	
	public function post_registro_invitado()
	{
		$input= Input::all();
		$reglas=array(
			'username' => 'required|min:3|max:10|unique:usuarios',
			'apellido'=>'required|min:3|max:10',
			'email' => 'required|email',
			'password' => 'required|min:4|max:10',
			'verificacion'=>'same:password',
			'ciudad'=>'required',
			'provincia'=>'required',
			'nacimiento'=>'required',
			'terms' => 'required'
			
			);
			
			 $mensajes = array(
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El campo :attribute debe ser un email válido.',
            'unique' => 'El campo ingresado ya existe en la base de datos',
			
			);
			
			$validator = Validator::make ($input, $reglas,$mensajes); 
			
			if ($validator->fails())
			{
				return Redirect::back()->withErrors($validator)->withInput()-> with('registro', 'Revise los datos ingresados');
				
				
			}
			else
			{ 
				$idus=Input::get('idus');
				$usuario=Usuario::find($idus);
				
				$usuario->username = Input::get('username');
				$usuario->apellido =Input::get('apellido');
				$usuario->password = Input::get('password');
				$usuario->nacimiento = Input::get('nacimiento');
				$usuario->sexo = Input::get('sexo');
				
				$usuario->provincia = Input::get('provincia');
				$usuario->ciudad = Input::get('ciudad');
				
				$usuario->save();
				
				$datos = array(
				'nombre' => Input::get('username'),
				'email' => Input::get('email'),				
				'password' => Input::get('password')				
				);
					
				Mail::send('emails.reg', $datos, function($message) //se envia el mail
				{
					$message->from('eventualesweb@gmail.com', 'Eventuales');
					$message->to(Input::get('email'))->subject('Bienvenido a Eventuales');//('eventualesweb@gmail.com', 'EventualesWeb')->subject('Welcome!');//
				});
				
				
				
			return Redirect::to('/registro_invitado_exito')->with('registro', 'Registro completado. Se envió un mail con sus datos. Ahora puede acceder a su cuenta');
			
				
					
			}
	}
	
	
	
	
	
	
	
	
	
	
	// ACA INTRODUZCO LOS DATOS DEL REGISTRO A LA BASE DE DATOS, ES DECIR, QUE CREO EL USUARIO
	public function post_registro()
	{
		$input= Input::all();
		$emailR= Input::get('email');
		$reglas=array(
			'username' => 'required|min:3|max:10|unique:usuarios', // el nickname sera unico
			'apellido'=>'required|min:3|max:20',
			'email' => 'required|email|unique:usuarios', //el mail sera unico
			'password' => 'required|min:4|max:10',
			'verificacion'=>'same:password',
			'ciudad'=>'required',
			'provincia'=>'required',
			'nacimiento'=>'required',
			'terms' => 'required'
			
			);
			
			 $mensajes = array(
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El campo :attribute debe ser un email válido.',
            'unique' => 'El campo ingresado ya existe en la base de datos',
			
        );
			
			$validator = Validator::make ($input, $reglas,$mensajes); 
			
			if ($validator->fails())
			{
				$CU=0;
				$listaDeUsuarioo= Usuario::where('email','=',$emailR)->get();
				foreach ($listaDeUsuarioo as $usrr) //este foreach me sirve para saber si existe o no un usuario en la tabla. Si existe da 1, sino da 0
				{
					$CU=$CU+1; //si existe el mail me da solo 1
				}
				//$usr=Usuario::find($emailR);
				if ($CU == 1) //si existe
				{
						$usr = Usuario::where('email','=',$emailR)->get()[0];  //obtengo la tupla del usuario con ese mail.	
						//return $usr;
						if ($usr->username=='')
						{								
							$idinvitado=$usr->id;			
							$emailobtenido=$usr->email;			
							$datosR = array('emailobtenido'=>$emailobtenido,  'idInvitado'=>$usr->id);		
							//return 'ENTRO';					
							Mail::send('emails.invitaregRECORDATORIO', $datosR, function($message) use ($datosR) //se envia el mail
							{
								$message->from('eventualesweb@gmail.com', 'Eventuales');
								$message->to($datosR['emailobtenido'])->subject('Eventuales-Recordatorio registro por invitacion');
							});
							return Redirect::back()->withErrors($validator)->withInput()-> with('registro', 'Le enviamos un mail. Por favor revise su casilla de correo.');
						}
						else 
						{
						return Redirect::back()->withErrors($validator)->withInput()-> with('registro', 'Revise los datos ingresados');
						}
				}
				if ($CU == 0)			
				{
				return Redirect::back()->withErrors($validator)->withInput()-> with('registro', 'Revise los datos ingresados');
				}
			}
			else
			{ 
			
			
				$usuario = new Usuario;
				$usuario->username = Input::get('username');
				$usuario->apellido =Input::get('apellido');
				$usuario->password = Input::get('password');
				$usuario->nacimiento = Input::get('nacimiento');
				$usuario->sexo = Input::get('sexo');
				$usuario->email = Input::get('email');
				$usuario->provincia = Input::get('provincia');
				$usuario->ciudad = Input::get('ciudad');
				
				$usuario->save();
				
				$datos = array(
				'nombre' => Input::get('username'),
				'email' => Input::get('email'),				
				'password' => Input::get('password')				
				);
					
				Mail::send('emails.reg', $datos, function($message) //se envia el mail
				{
					$message->from('eventualesweb@gmail.com', 'Eventuales');
					$message->to(Input::get('email'))->subject('Bienvenido a Eventuales');//('eventualesweb@gmail.com', 'EventualesWeb')->subject('Welcome!');//
				});
				
				
				
			return Redirect::to('/registro')->with('registro', 'Registro completado. Se envió un mail con sus datos. Ahora puede acceder a su cuenta.');
			
				
					
			}
	}
	


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
	/*
        $usuario = Usuario::find($id);

        return View::make('usuario.profile', array('usuario' => $usuario));
    
		 return 'aca mostramos la info del usuario:' . $id;*/
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// return ' aca editamos el usuario:' . $id;
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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
	public function destroy($id)
	{
		//
	}
	
	//--------------------------------------------------------------------------------------------
	
	
	
	//--------------------------------------------PARTE DE LOS LOGUEOS----------------------------------------------------------
	
	public function bienvenida()
	{
		return View::make('usuarios.bienvenida');
	}

	
	public function get_login()
	{
		if(Usuario::isLogged())
			return Redirect::to('/bienvenida');
		else
			return View::make('usuarios.login');
	}
	
	public function post_login()
	{
		$input = Input::all();
		$rules = array(
			'username' => 'required|exists:usuarios,username',
			'password' => 'required',
		);
		$validator = Validator::make($input, $rules);
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$username = Input::get('username');
			$password = Input::get('password');
			if($usuario = Usuario::where('username', '=', $username)->first())
			{
				if($password = Usuario::where('password', '=', $password)->first())
				{
					Session::put('usuario_id', $usuario->id);
					Session::put('usuario_username', $usuario->username);
					
					return Redirect::to('/bienvenida');
				}
				else
				{
					return Redirect::to('/login');
				}
			}
			else
			{
				return Redirect::to('/login');
			}
		}
	}
	public function logout()
	{
		Session::flush();
		return Redirect::to('/');
	}

	
/***********************PERFIL***********	*/
public function get_perfil()
	{
		return View::make('usuarios.perfil');
	}
	
/* ***********************************************/

public function modificarperfil_get()
	{
		
		return View::make('usuarios.modifperfil');
	}
	
public function modificarperfil_post()
	{
			$iduser=Input::get('capturauser');
			
			$NUsuario=Usuario::find($iduser);
			
			$NUsuario->provincia = Input::get('provincia');
			$NUsuario->ciudad = Input::get('ciudad');
						
			$NUsuario-> save();
			return Redirect::to("/perfil"); //deberia mostrar el ver evento con los nuevos valores
	}
	
/* ***********************************************/

	
public function get_recordarpass()
{
	return View::make('usuarios.recordarpass');	
}

public function post_recordarpass()
	{// ME FALTA CAPTURAR BIEN EL PASSWORD PARA MANDAR
		$input = Input::all();
		$email = Input::get('email');
		$listaDeUsuario= Usuario::where('email','=',$email)->get();
		foreach ($listaDeUsuario as $lis)
		{
			$nombre=$lis->username;
			$pass=$lis->password;
		}
		$rules = array(
			'nombre' => 'required',
			'email' => 'required|email'			
		);
		$validator = Validator::make($input, $rules); //aca se compara el input con las reglas
		if($validator->fails()) //si la validacion falla
		{
			return Redirect::back()->withErrors($validator)->with('estado', 'No enviado. Comprueba los datos que has ingresado');
		}
		else
		{
			$datos = array(
				
				'email' => Input::get('email'),
				'password' => $pass,
				'nombre' => $nombre,
				);
					
				Mail::send('emails.recordatorio', $datos, function($message) use ($datos)//se envia el mail
				{
					$message->from('eventualesweb@gmail.com', 'Eventuales');
					$message->to(Input::get('email'))->subject('Eventuales-Recordatorio');//('eventualesweb@gmail.com', 'EventualesWeb')->subject('Welcome!');//
				});
			return Redirect::to('/recordarpass')->with('estado', 'Mensaje enviado correctamente');
		}
	}
	
	
	
	
	
//////////////////////////////////////////////////////////
	public function getAuthIdentifier()
{
return $this->getKey();
}

public function getAuthPassword()
{
return $this->password;
} 

public function getRememberToken()
{
return $this->remember_token;
}

public function setRememberToken($value)
{
$this->remember_token = $value;
}

public function getRememberTokenName()
{
return "remember_token";
}

public function getReminderEmail()
{
return $this->email;
}
	
	
	
	

}