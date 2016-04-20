<?php 
class Evento extends Eloquent { 

    protected $table = 'eventos';
	protected $PrimaryKey='id';
	public $timesstamps=false;
	
	
	
	
//-------CON QUE TABLAS SE RELACIONA------	
	/*
	public function usuarios()
	{	
		return $this->BelongsTo('Usuario','creador'); //un evento puede ser creado por un usuario
			
	}
	
	public function items()
	{
		return $this->hasMany('Item');//ver de agregar en table de evento clave foranea a item
	
	}
	
	public function fotos()
	{
		return $this->hasMany('Foto');
	}
	
	public function invitados()
	{
		return $this->hasMany('Invitado');
	}
	*/
	//habria que agregar el del chat despues
	
	
//------------FUNCIONES DEL EVENTO-------


	
}
?>