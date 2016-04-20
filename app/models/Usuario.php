<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuarios';
	protected $fillable=array('username','password');
	protected $hidden = array('password', 'remember_token');
	
	
	
	public static function isLogged()
	{
		if (Session::has('usuario_id'))
			return true; //si esta logueado devuelve verdadero
			else
			return false;
	}
	
	/*public static function isAdmin()
	{
		if(Session::get('user_type') > 1)
			return true;
		else
			return false;
	}*/
	
	
	
	
	
	
	
	
	
	
	
	//este metodo se debe implementar para la interfaz
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	
	
	//este metodo se debe implementar por la interfaz
	//y sirve para obtener la clave al momento de validar el inicio de sesion
	
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	
	
	/*
	public static function isAdmin()  //este debe ser relacionado con el admin_controller.. o sea... para manejar todo debemos tener creado un admin y darle las rutas a las que pueda acceder.
	{
		if (Session::get('usuario_type')>1)
			return true; // si es administrador devuelve verdadero
		else
			return false;
	}*/
	
	public function itemsoks() 
	{
		return $this->hasMany('ItemsOk'); //un usuario puede llevar muchos itemsconfirmados
		
	}
	
	public function eventos()
	{
		return $this->hasMany('Evento'); // un usuario puede tener muchos eventos
	}
}
